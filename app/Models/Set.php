<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Set extends Model
{
    use SoftDeletes;
    protected $fillable = ['category_id', 'visible_to', 'user_id', 'recommended', 'name', 'description', 'image','aggregate'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'studies', 'set_id', 'user_id');
    }

    public function study()
    {
        return $this->belongsTo(Study::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function words()
    {
        return $this->hasMany(Word::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function lessonWords()
    {
        return $this->hasManyThrough(LessonWord::class, Lesson::class);
    }

    public function scopeUserFollowedSets($query, $user)
    {
        return $query->whereIn('id', $user->getSetsFollowed());
    }

    public function scopeUserUnfollowedSets($query, $user)
    {
        return $query->whereNotIn('id', $user->getSetsFollowed());
    }

    public function scopePublicSets($query)
    {
        return $query->where('visible_to', 'public');
    }

    public function scopeLastUserInsert($query)
    {
        return $query->orderBy('id', 'desc')->first();
    }

    public function assignValues($values)
    {
        $data = [
            'category_id' => $values->input('set_category'),
            'visible_to' => $values->input('set_visibility'),
            'user_id' => $values->user_id,
            'name' => $values->input('set_name'),
            'description' => $values->input('set_desc'),
            'image' => $this->saveImage($values)
        ];

        if(!empty($values->input('owned_by'))) {
            $data['user_id'] = $values->input('owned_by');
        }
        if($values->input('set_id') == null) {
            $this->firstOrCreate($data);
        } else {
            $this->update($data);
        }
    }

    public function saveImage($values)
    {
        $path = 'images/uploads/sets/';
        if ($values->hasFile('set_image')) {
            $file = $values->file('set_image');
            $filename = $path . md5(date('Y-m-d H:i:s:u')) . $file->getClientOriginalName();
            if(!file_exists($path)){
                mkdir($path, 0777, true);
            }
            move_uploaded_file($file, $filename);
            return $filename;
        } else {
            return '';
        }
    }

    public function scopeAvailableSets($query, $followerIds, $followeeIds, $id)
    {
        $mergedIds = $followerIds->merge($followeeIds)->unique();

        return $query->Where('visible_to', '=', 'public')
            ->orWhere(function ($query2) use ($followerIds) {
                $query2->whereIn('sets.user_id', $followerIds)
                    ->where('visible_to', 'followers');
            })
            ->orWhere(function ($query3) use ($id) {
                $query3->where('sets.user_id', $id)
                    ->where('visible_to', 'me');
            })
            ->orWhere(function ($query4) use ($followeeIds) {
                $query4->whereIn('sets.user_id', $followeeIds)
                    ->where('visible_to', 'following');
            })
            ->orWhere(function ($query5) use ($mergedIds) {
                $query5->whereIn('sets.user_id', $mergedIds)
                    ->where('visible_to', 'following_followers');
            });
    }

    public function scopeOnlyMeSets($query, $id)
    {
        return $query->orwhere('sets.user_id', $id)
            ->where('visible_to', 'me');
    }

    public function getSetPopular()
    {
        $query = "SELECT *, COUNT(st.set_id) AS cnt
            FROM sets s
            LEFT JOIN studies st
            ON s.id = st.set_id
            LEFT JOIN users u
            ON u.id = s.user_id
            GROUP BY set_id";

        return DB::raw($query);
    }

    public function scopeUserFolloweeSets($query, $user)
    {
        return $query->whereIn('user_id', $user->followees()->notAdmin());
    }

    public function scopeUserFollowerSets($query, $user)
    {
        return $query->whereIn('user_id', $user->followers()->notAdmin());
    }

}

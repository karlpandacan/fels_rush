<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Set extends Model
{
    use SoftDeletes;
    protected $fillable = ['category_id', 'visible_to', 'user_id', 'recommended', 'name', 'description', 'image'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'studies', 'set_id', 'user_id');
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

    public function assignValues($values)
    {
        $data = [
            'category_id' => $values->input('set_category'),
            'visible_to' => $values->input('set_visibility'),
            'user_id' => $values->user_id,
            'name' => $values->input('set_name'),
            'description' => $values->input('set_desc')
        ];

        if(!empty($values->input('owned_by'))) {
            $data['user_id'] = $values->input('owned_by');
        }

        if(!empty($values->file('set_image'))) {
            $data['image'] = $this->saveImage($data, $values);
        }

        if($values->input('set_id') == null) {
            $this->firstOrCreate($data);
        } else {
            $this->update($data);
        }
    }

    public function saveImage($data, $values)
    {
        $imageName = $this->image;
        if(empty($imageName)) {
            $imageName = uniqid() . '.' . $values->file('set_image')->getClientOriginalExtension(); // Create new name;
        }

        $values->file('set_image')->move(base_path() . '/public/images/sets/', $imageName);
        return $imageName;
    }

    public function scopeAvailableSets($query, $ids, $id)
    {
        return $query->Where('visible_to', '=', 'public')
            ->orWhere(function ($query2) use ($ids){
                $query2->whereIn('sets.user_id', $ids)
                    ->where('visible_to', 'followers');
            })
            ->orWhere(function ($query3) use ($id) {
                $query3->where('sets.user_id', $id)
                    ->where('visible_to', 'me');
            });
    }

    public function scopeOnlyMeSets($query, $id)
    {
        return $query->orwhere('sets.user_id', $id)
            ->where('visible_to', 'me');
    }

}

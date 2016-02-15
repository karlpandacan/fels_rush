<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'follower_id',
        'followee_id',
        'type'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin()
    {
        /*
         * USER TYPES
         * 0 = Non-admin
         * 1 = Admin
         */
        return $this->type == 1;
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followee_id',
            'follower_id');
    }

    public function followees()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id',
            'followee_id');
    }

    public function sets()
    {
        return $this->hasMany(Set::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function learnedWords()
    {
        return $this->hasMany(LearnedWord::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function studies(){
        return $this->belongsToMany(Set::class, 'studies', 'user_id', 'set_id')->withTimestamps();
    }

    public function uploadImage($request)
    {
        $path = 'images/uploads/profile_picture/';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
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

    public function scopeFindUser($query, $wildcard)
    {
        return $query->where('name', 'like', '%' . $wildcard . '%')
            ->orwhere('email', 'like', '%' . $wildcard . '%');
    }

    public function scopeOfNotIds($query, $ids)
    {
        return $query->whereNotIn('id', $ids);
    }

    public function getLearnedWordsIds()
    {
        return $this->learnedWords->lists('word_id');
    }

    public function getUserIds()
    {
        return $this->all()->lists('name', 'id');
    }

    public function getSetsFollowed()
    {
        return $this->studies()->lists('set_id');
    }

    public function scopeNotAdmin($query)
    {
        return $query->where('type', '!=', '1');
    }

    public function getStudyProgress()
    {
        return $this->studies()
            ->leftJoin('words', 'words.set_id', '=', 'sets.id')
            ->leftJoin('learned_words', 'learned_words.word_id', '=', 'words.id')
            ->selectRaw('sets.*, count(words.id) as total_words, count(learned_words.id) as learned_words')
            ->groupBy('id')
            ->orderBy('learned_words', 'desc');
    }
}

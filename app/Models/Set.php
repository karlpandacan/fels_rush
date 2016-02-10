<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $fillable = ['category_id', 'used_id', 'name', 'description', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function lesson_words()
    {
        return $this->hasManyThrough(LessonWord::class, Lesson::class);
    }

    public function assignValues($values)
    {
        $data = [
            'name' => $values->input('set_name'),
            'description' => $values->input('set_desc')
        ];

        if(!empty($values->file('set_image'))) {
            $data = $this->saveImage($data, $values);
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
        if(empty($this->image)) {
            $imageName = uniqid() . '.' . $values->file('set_image')->getClientOriginalExtension(); // Create new name;
        }

        $values->file('set_image')->move(base_path() . '/public/images/sets/', $imageName);
        $data['image'] = $imageName;

        return $data;
    }
}

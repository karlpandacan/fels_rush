<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = ['category_id', 'word_original', 'word_translated', 'sound_file'];

    public function set()
    {
        return $this->belongsTo(Set::class);
    }

    public function learnedWords()
    {
        return $this->hasMany(LearnedWord::class);
    }

    public function lessonWords()
    {
        return $this->hasMany(LessonWord::class);
    }

    public static function storeWords($values, $setId)
    {
        $wordsToInsert = [];

        // Do not include empty values
        foreach($values->word_original as $index => $value) {
            if(!empty($value)) {
                $wordsToInsert[] = [
                    'set_id' => $setId,
                    'word_original' => $values->word_original[$index],
                    'word_translated' => $values->word_translated[$index]
                ];
            }
        }

        Word::insert($wordsToInsert);
    }

    public function assignValues($values)
    {
        $data = [
            'category_id' => $values->input('word_category'),
            'word_original' => $values->input('word_original'),
            'word_translated' => $values->input('word_translated')
        ];

        if(!empty($values->file('sound_file'))) {
            $data = $this->saveSound($data, $values);
        }

        if($values->input('word_id') == null) {
            $this->firstOrCreate($data);
        } else {
            $this->update($data);
        }
    }

    public function scopeUserLearnedWords($query, $user)
    {
        return $query->whereIn('id', $user->getLearnedWordsIds());
    }

    public function scopeUserUnlearnedWords($query, $user)
    {
        return $query->whereNotIn('id', $user->getLearnedWordsIds());
    }

    public function scopeSelectWords($query)
    {
        return $query->select('id', 'word_original', 'word_translated');
    }

    private function saveSound($data, $values)
    {
        $soundFileName = $this->sound_file;
        if(empty($this->sound_file)) {
            $soundFileName = $this->generateName($values); // Create new name;
        }

        $values->file('sound_file')->move(base_path() . '/public/audio/', $soundFileName);
        $data['sound_file'] = $soundFileName;

        return $data;
    }

    private function generateName($values)
    {
        return uniqid() . '.' . $values->file('sound_file')->getClientOriginalExtension();
    }
}

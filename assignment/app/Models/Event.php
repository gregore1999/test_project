<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;



    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'event_topic_lesson_instructor')
            ->withPivot(['lesson_id', 'instructor_id']);
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'event_topic_lesson_instructor')
            ->withPivot(['topic_id', 'instructor_id']);
    }

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'event_topic_lesson_instructor')
            ->withPivot(['topic_id', 'lesson_id']);
    }
}

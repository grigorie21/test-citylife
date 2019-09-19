<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    public $timestamps = false;

    protected
        $table = 'chapter',
        $fillable = [
        'serial_title_ru',
        'serial_title_en',
        'chapter_title_ru',
        'chapter_title_en',
        'url',
        'date'
    ];

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::createFromFormat("d.m.Y", $value)->format("Y-m-d");
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'info' => 'object'
    ];

    public function tag()
    {
        return $this->morphOne(Tag::class, 'taggable');
    }

    protected function quality(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => json_decode($attributes['info'])->height,
        );
    }

    protected function codec(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => strtoupper(json_decode($attributes['info'])->codec_name),
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Imtigger\LaravelJobStatus\JobStatus;
use Str;


class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function taggable(){
        return $this->morphTo();
    }

    public static function findByTag($tag)
    {
        return self::where('tag', $tag)->firstOrFail();
    }

    public static function create(array $attributes = []): Model|\Illuminate\Database\Eloquent\Builder
    {
        // TODO: improve
        $attributes['tag'] = Str::random(4);

        $model = static::query()->create($attributes);

        return $model;
    }

    public function job(){
        return $this->hasOne(JobStatus::class)->latest();
    }

}

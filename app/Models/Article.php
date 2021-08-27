<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'image',
        'description',
        'is_active',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'is_active' => 'boolean'
    ];

    //Uuid generator
    public static function boot() 
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) \Illuminate\Support\Str::uuid();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    //Relationships
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}

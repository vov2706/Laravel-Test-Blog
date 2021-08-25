<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'article_id'
    ];

    protected $casts =[
        'name' => 'string',
        'article_id' => 'string'
    ];

    public $timestamps = false;

    //Relationships
    public function article() 
    {
        return $this->belongsTo(Article::class);
    }
}

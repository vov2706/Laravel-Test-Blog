<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name'
    ];

    protected $casts = [
        'name' => 'string'
    ];

    public const IS_USER = 1;
    public const IS_ADMIN = 2; 

    //Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

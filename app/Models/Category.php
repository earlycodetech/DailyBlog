<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $fillable = [
        'title',
        'slug'
    ];

    // protected $casts = [
    //     'status' => 'boolean',
    //     'id' => "integer"
    // ];

    // protected $hidden = [
    //     'id'
    // ];


    public function posts ()
    {
        // return $this->hasMany(related: Post::class, foreignKey: 'category_id', localKey:  "id");
        return $this->hasMany(Post::class,'category_id');
    }
}

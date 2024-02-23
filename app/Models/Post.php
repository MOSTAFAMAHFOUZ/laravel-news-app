<?php

namespace App\Models;

use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


    public function image()
    {
        // dd($this->image);
        if (file_exists(public_path($this->image))) {
            return asset($this->image);
        }
        return asset('default.png');
    }


    protected $hidden = [
        'created_at', 'updated_at',
    ];
}

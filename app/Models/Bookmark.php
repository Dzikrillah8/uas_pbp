<?php

namespace App\Models;

use App\Models\Isibookmark;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;

class Bookmark extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function user() {
     return $this->belongsTo(User::class);
    }

    public function isibookmarks() {
        return $this->hasMany(Isibookmark::class, 'bookmark_id');
    }
}

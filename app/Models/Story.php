<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;

class Story extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function getRouteKeyName() {
        return 'slug';
    }

    public function scopeSearch($query, array $search) {
        $query->when($search['search'] ?? false, function ($query, $search) {
            return $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                ->orWhere('sinopsis', 'like', '%' . $search . '%')

                ->orWhereHas('user', function($u) use ($search) {
                    $u->where('username', 'like', '%' . $search . '%');
                });
            });
        });
    }

    public function scopeGenre($query, array $genres) {
        if (!empty($genres['genre'])) {
            $query->whereHas('genre', function ($q) use ($genres) {
                $q->where('slug', $genres['genre']);
            });
        }

        return $query;
    }

    public function scopeStatus($query, array $status) {
        if (!empty($status['status'])) {
            $query->where('status', $status['status']);
        }
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function chapters() {
        return $this->hasMany(Chapter::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function isibookmarks() {
        return $this->hasMany(Isibookmark::class);
    }

}

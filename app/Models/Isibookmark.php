<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Isibookmark extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function story() {
        return $this->belongsTo(Story::class);
    }

    public function bookmark() {
        return $this->belongsTo(Bookmark::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'badge_image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // Tutti i campi che vogliamo siano abilitati al mass update
    // protected $fillable = ['title', 'content', 'slug'];

    // Tutti i campi che non vogliamo siano abilitati al mass update
    protected $guarded = ['id', 'cover_image'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}

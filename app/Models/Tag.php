<?php

namespace App\Models;

use App\Models\Mading;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function madings()
    {
        return $this->belongsToMany(Mading::class, 'madings_tags');
    }
}

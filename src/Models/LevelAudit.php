<?php

namespace HammamZarefa\RapidRanker\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelAudit extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'level_to', 'points', 'duration'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}

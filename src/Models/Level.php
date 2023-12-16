<?php

namespace HammamZarefa\RapidRanker\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = ['level','next_level_points','points_reach_duration','percent_profit','image'];
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}

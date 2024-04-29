<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model
{
    use HasFactory;

    protected $guarded = [];

    function skill(): HasMany
    {
        return $this->hasMany(CandidateSkill::class, 'candidate_id', 'id');
    }

    function language(): HasMany
    {
        return $this->hasMany(CandidateLanguage::class, 'candidate_id', 'id');
    }
}

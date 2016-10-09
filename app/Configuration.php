<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    /** Attributes assignable */
    protected $fillable = [
        'nbdefG', 'nbattG', 'nbquartG', 'nbpassG',
        'nbdefC', 'nbattC', 'nbquartC', 'nbpassC',
        'nbdefD', 'nbattD', 'nbquartD', 'nbpassD',
        'phase2', 'phase3', 'phase4',
        'sfm1', 'sfm2', 'sfm3', 'sfm4'
    ];

    /** Relationships */
}

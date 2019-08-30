<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'module';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'initials', 'status'];

    public $timestamps = false;
}

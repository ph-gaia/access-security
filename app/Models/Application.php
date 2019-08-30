<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'application';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name'];

    public $timestamps = false;
}

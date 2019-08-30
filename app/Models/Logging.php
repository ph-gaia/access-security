<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Logging extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'logging';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['ip', 'description', 'users_id', 'permission_id', 'created_at'];

    public $timestamps = false;

}

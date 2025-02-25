<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupAccess extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'group_access';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public $timestamps = false;

}

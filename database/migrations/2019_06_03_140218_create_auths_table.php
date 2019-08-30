<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('auths', function(Blueprint $table) {
                $table->increments('id');
                $table->string('username');
$table->string('password');
$table->dateTime('validate');
$table->integer('active');
$table->dateTime('created_at');
$table->dateTime('updated_at');
$table->integer('users_id');

                $table->timestamps();
                $table->softDeletes();
            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('auths');
    }

}

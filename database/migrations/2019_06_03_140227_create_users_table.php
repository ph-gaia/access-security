<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('users', function(Blueprint $table) {
                $table->increments('id');
                $table->string('name');
$table->string('email');
$table->string('phone');
$table->string('area');
$table->dateTime('created_at');
$table->dateTime('updated_at');

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
        Schema::drop('users');
    }

}

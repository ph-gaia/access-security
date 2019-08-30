<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLoggingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('loggings', function(Blueprint $table) {
                $table->increments('id');
                $table->string('ip');
$table->text('description');
$table->integer('users_id');
$table->integer('permission_id');
$table->dateTime('created_at');

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
        Schema::drop('loggings');
    }

}

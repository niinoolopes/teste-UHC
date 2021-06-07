<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testeUHC_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->boolean('enable');
            $table->foreignId('id_user')->constrained('testeUHC_users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testeUHC_tasks');
    }
}

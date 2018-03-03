<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('slug')->unique();
            $table->integer('level')->default(1);
            $table->timestamps();
        });

        Schema::create('role_translations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('locale')->index();
            $table->unique(['role_id','locale']);
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_translations');
        Schema::dropIfExists('roles');
    }
}
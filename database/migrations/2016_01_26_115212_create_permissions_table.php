<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('slug')->unique();
            $table->string('model')->nullable();
            $table->timestamps();
        });

        Schema::create('permission_translations', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('description')->nullable();

            $table->integer('permission_id')->unsigned();
            $table->string('locale')->index();

            $table->unique(['permission_id','locale']);
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions_translations');
        Schema::dropIfExists('permissions');
    }
}
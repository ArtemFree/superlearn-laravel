<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('email');
            $table->string('password');
            
            $table->string('firstName')->default('');
            $table->string('lastName')->default('');
            $table->string('about')->default('');
            $table->integer('age')->nullable();
            $table->string('status')->nullable();
            $table->boolean('is_banned')->default(false);
            $table->boolean('is_verified')->default(false);
            
            $table->integer('money_earned')->default(0);
            $table->string('profile')->nullable();
            $table->boolean('is_reliable')->default(false);
            $table->integer('completed_projects')->default(0);
            $table->integer('failed_projects')->default(0);
            $table->integer('rating')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authors');
    }
};

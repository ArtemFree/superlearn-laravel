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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            $table->string('first_name')->default('');
            $table->string('last_name')->default('');
            $table->string('about')->default('');
            $table->integer('age')->nullable();
            $table->string('status')->nullable();

            $table->boolean('is_author')->default(false);
            $table->boolean('is_banned')->default(false);
            $table->boolean('is_verified')->default(false);
            
            $table->integer('money_earned')->default(0);
            $table->boolean('is_reliable')->default(false);
            $table->integer('rating')->default(0);
            $table->integer('completed_projects')->default(0);
            $table->integer('failed_projects')->default(0);

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};

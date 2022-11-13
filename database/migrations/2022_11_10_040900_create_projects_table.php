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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->string('about');

            $table->boolean('is_archived_manually')->default(false);
            $table->boolean('is_completed')->default(false);
            $table->boolean('is_failed')->default(false);
            $table->boolean('is_in_work')->default(false);
            $table->dateTime('is_in_work_since')->nullable();

            $table->integer('user_id');
            
            $table->integer('award')->default(0);
            $table->string('short_about')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('b_date');
            $table->string('gender');
            $table->text('address');
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('interest')->default(new Expression('(JSON_ARRAY())'));;
            $table->string('batch');
            $table->text('course');
            $table->integer('p_hour');
            $table->string('image')->nullable();
            $table->string('cv');
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
        Schema::dropIfExists('students');
    }
};

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('name');
            $table->text('address')->nullable();
            $table->decimal('latitude')->nullable();
            $table->decimal('longitude')->nullable();
            $table->string('contactnumber')->nullable();
            $table->text('url')->nullable();
            $table->text('summary')->nullable();
            $table->text('photo')->nullable();
            $table->text('map')->nullable();
            $table->string('price_range')->nullable();
            $table->string('pricefrom')->nullable();
            $table->string('priceto')->nullable();
            $table->string('activated')->nullable();
            $table->integer('ratings')->nullable();
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
        Schema::dropIfExists('hotels');
    }
}

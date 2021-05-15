<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->integer('type')->nullable(false);            
            $table->text('content')->nullable();
            $table->integer('radio_1')->nullable(false)->comment('radio-1'); 
            $table->integer('radio_2')->nullable(false)->comment('radio-2'); 
            $table->text('check_1')->nullable()->comment('check_1');
            $table->text('check_2')->nullable()->comment('check_2');             
            $table->date('date_1')->nullable()->comment('date_1');
            $table->date('date_2')->nullable()->comment('date_2');            
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
        Schema::dropIfExists('books');
    }
}

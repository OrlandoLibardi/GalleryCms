<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('alias');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
        
        Schema::create('gallery_items', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('gallery_id')->unsigned();
            $table->string('title');
            $table->string('sub_titile')->nullable(true);
            $table->string('img');
            $table->string('link_href')->nullable(true);
            $table->string('link_target', 20)->nullable(true);
            $table->string('order_at', 2);
            $table->foreign('gallery_id')->references('id')->on('galleries')->onDelete('cascade');
        });

        Schema::create('gallerys_templates', function($table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 90);
            $table->string('template');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
}

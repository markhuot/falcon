<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::dropIfExists('content_types');
    Schema::create('content_types', function($table)
    {
      $table->increments('id');
      $table->string('name');
      $table->string('slug');
      $table->timestamps();
    });

    Schema::dropIfExists('regions');
    Schema::create('regions', function($table)
    {
      $table->increments('id');
      $table->string('name');
      $table->string('slug');
      $table->timestamps();
    });

    Schema::dropIfExists('blocks');
    Schema::create('blocks', function($table)
    {
      $table->increments('id');
      $table->string('name');
      $table->string('slug');
      $table->timestamps();
    });

    Schema::dropIfExists('fields');
    Schema::create('fields', function($table)
    {
      $table->increments('id');
      $table->integer('block_id');
      $table->foreign('block_id')->references('id')->on('blocks');
      $table->string('name');
      $table->string('slug');
      $table->string('type');
      $table->timestamps();
    });

    Schema::dropIfExists('contents');
    Schema::create('contents', function($table)
    {
      $table->increments('id');
      $table->integer('content_type_id');
      $table->foreign('content_type_id')->references('id')->on('content_types');
      $table->timestamps();
    });

    Schema::dropIfExists('block_data');
    Schema::create('block_data', function($table)
    {
      $table->increments('id');
      $table->integer('content_id');
      $table->foreign('content_id')->references('id')->on('contents');
      $table->integer('region_id');
      $table->foreign('region_id')->references('id')->on('regions');
      $table->integer('block_id');
      $table->foreign('block_id')->references('id')->on('blocks');
      $table->integer('order')->default(0);
      $table->timestamps();
    });

    Schema::dropIfExists('content_type_region');
    Schema::create('content_type_region', function($table)
    {
      $table->increments('id');
      $table->integer('content_type_id');
      $table->foreign('content_type_id')->references('id')->on('content_types');
      $table->integer('region_id');
      $table->foreign('region_id')->references('id')->on('regions');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('collections');
    Schema::dropIfExists('content');
    Schema::dropIfExists('fields');
    Schema::dropIfExists('field_components');
  }

}

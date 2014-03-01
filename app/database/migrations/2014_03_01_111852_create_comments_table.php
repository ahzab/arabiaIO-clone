<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('comments', function(Blueprint $table) {
      // These columns are needed for Baum's Nested Set implementation to work.
      // Column names may be changed, but they *must* all exist and be modified
      // in the model.
      // Take a look at the model scaffold comments for details.
      $table->increments('id');
      $table->integer('parent_id')->nullable();
      $table->integer('lft')->nullable();
      $table->integer('rgt')->nullable();
      $table->integer('depth')->nullable();

      // Add needed columns here (f.ex: name, slug, path, etc.)
      // $table->string('name', 255);
      $table->longText('content');
      $table->integer('sumvotes')->default(0);
      $table->integer('user_id')->unsigned()->default(0);
      $table->foreign('user_id')->references('id')->
                    on('users')->onDelete('cascade');
      
      $table->integer('post_id')->unsigned()->default(0);
      $table->foreign('post_id')->references('id')->
                    on('posts')->onDelete('cascade');
      $table->timestamps();

      // Default indexes
      // Add indexes on parent_id, lft, rgt columns by default. Of course,
      // the correct ones will depend on the application and use case.
      $table->index('parent_id');
      $table->index('lft');
      $table->index('rgt');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::drop('comments');
  }

}

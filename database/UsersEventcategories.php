<?php

require __DIR__.'/../config/bootstrap.php';



use Illuminate\Database\Capsule\Manager as Capsule;



Capsule::schema()->create('cms_users_eventcategories', function ($table) {

       $table->engine = 'MyISAM';

       $table->integer('user_id');

       $table->integer('category_id');

       $table->timestamp('created_at')->useCurrent();

       $table->timestamp('updated_at')->useCurrent();

       $table->foreign('user_id')->references('user_id')->on('cms_users')->onDelete('cascade');

       $table->foreign('category_id')->references('category_id')->on('cms_module_cgcalendar_categories')->onDelete('cascade');

       $table->primary(array('user_id', 'category_id'));

   });
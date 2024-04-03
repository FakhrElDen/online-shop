<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brand_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('logo', 255);
            $table->string('favicon', 255);
            $table->string('banner_image', 255);
            $table->string('theme_colour', 255);
            $table->longText('our_story', 255);
            $table->string('phone', 255)->default('NULL')->nullable(true);
            $table->string('email', 255)->default('NULL')->nullable(true);
            $table->longText('social_links', 255);
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
        Schema::dropIfExists('brand_settings');
    }
}

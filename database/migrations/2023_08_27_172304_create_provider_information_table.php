<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderInformationTable extends Migration
{
    public function up()
    {
        Schema::create('provider_information', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('provider_name');
            $table->string('provider_user_id');
            $table->string('provider_user_name');
            $table->string('provider_user_email')->nullable()->default(null);
            $table->string('provider_user_picture')->nullable(); // Provider's unique user ID
            $table->text('access_token');
            $table->string('refresh_token')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('provider_information');
    }
}


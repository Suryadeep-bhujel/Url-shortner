<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlTrackingHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_tracking_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('url_id')->index();
            $table->string('referral_url')->nullable();
            $table->string('ip')->nullable();
            $table->text('params')->nullable();
            $table->string('country_code')->nullable()->index();
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
        Schema::dropIfExists('url_tracking_histories');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortUrlsTable extends Migration
{
    public function up()
    {
        Schema::create('short_urls', function (Blueprint $table) {

		$table->id();
		$table->text('origin_url');
		$table->string('short_code');
		$table->datetime('expiry_date')->nullable();
		$table->integer('total_hits')->default(0);
        $table->timestamps();
        $table->timestamp('deleted_at')->nullable();

        });
    }

    public function down()
    {
        Schema::dropIfExists('short_urls');
    }
}
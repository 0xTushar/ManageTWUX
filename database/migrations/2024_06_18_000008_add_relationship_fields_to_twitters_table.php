<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTwittersTable extends Migration
{
    public function up()
    {
        Schema::table('twitters', function (Blueprint $table) {
            $table->unsignedBigInteger('token_id')->nullable();
            $table->foreign('token_id', 'token_fk_9879102')->references('id')->on('tokens');
        });
    }
}

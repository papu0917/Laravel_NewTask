<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountbookTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountbook_tag', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->unsignedInteger('accountbook_id');
            $table->unsignedInteger('tag_id');
            $table->timestamps();

            $table->index('accountbook_id');
            $table->index('tag_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accountbook_tag');
    }
}

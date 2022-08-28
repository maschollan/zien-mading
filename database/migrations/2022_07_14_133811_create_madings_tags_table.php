<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMadingsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('madings_tags', function (Blueprint $table) {
            $table->foreignId('mading_id');
            $table->foreignId('tag_id');
            $table->primary(['mading_id', 'tag_id']);

            $table->foreign('mading_id')->references('id')->on('madings')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('madings_tags');
    }
}

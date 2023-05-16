<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('question_extraction', function (Blueprint $table) {
            $table->foreign(['id_project'], 'question_extraction_ibfk_1')->references(['id_project'])->on('project')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['type'], 'question_extraction_ibfk_2')->references(['id_type'])->on('types_question')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('question_extraction', function (Blueprint $table) {
            $table->dropForeign('question_extraction_ibfk_1');
            $table->dropForeign('question_extraction_ibfk_2');
        });
    }
};

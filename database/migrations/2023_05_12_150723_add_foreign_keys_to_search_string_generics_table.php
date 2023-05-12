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
        Schema::table('search_string_generics', function (Blueprint $table) {
            $table->foreign(['id_project'], 'search_string_generics_ibfk_1')->references(['id_project'])->on('project')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('search_string_generics', function (Blueprint $table) {
            $table->dropForeign('search_string_generics_ibfk_1');
        });
    }
};

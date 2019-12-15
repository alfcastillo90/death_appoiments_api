<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameColumnsVictimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('victims', function (Blueprint $table) {
            $table->renameColumn('city_id','city_of_residence_id');
            $table->renameColumn('country_id','country_of_birth_id');
            $table->renameColumn('identification_type','identification_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('victims', function (Blueprint $table) {
            $table->renameColumn('city_of_residence_id','city_id');
            $table->renameColumn('country_of_birth_id','country_id');
            $table->renameColumn('identification_type_id','identification_type');
        });
    }
}

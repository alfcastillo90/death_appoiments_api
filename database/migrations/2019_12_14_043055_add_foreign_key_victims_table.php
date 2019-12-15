<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddForeignKeyVictimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('victims', function (Blueprint $table) {
            DB::transaction(function () use ($table) {
                $table->unsignedBigInteger('identification_type_id')->change();
                $table->unsignedBigInteger('city_of_residence_id')->change();
                $table->unsignedBigInteger('country_of_birth_id')->change();
                $table->foreign('city_of_residence_id')->references('id')->on('cities');
                $table->foreign('country_of_birth_id')->references('id')->on('countries');
                $table->foreign('identification_type_id')->references('id')->on('identification_types');
            });
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
            $table->dropForeign('victims_city_of_residence_id_foreign');
            $table->dropForeign('victims_country_of_birth_id_foreign');
            $table->dropForeign('victims_identification_type_id_foreign');
        });
    }
}

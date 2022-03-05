<?php

use App\Models\Specialty;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSpecialtyIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            // $table->foreignId('specialty_id')->after('password');
            // $table->foreign('specialty_id')->on('specialties')->references('id');
            // $table->foreignIdFor(Specialty::class);
            // $table->foreign('specialty_id')->on('specialties')->references('id');
            // $table->foreignId('specialty_id')->constrained();
            $table->foreignIdFor(Specialty::class)->constrained();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropForeign('users_specialty_id_foreign');
            $table->dropColumn('specialty_id');
        });
    }
}

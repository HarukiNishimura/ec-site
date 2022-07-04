<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role')->default(0);
            $table->string('postal_code')->comment('郵便番号');
            $table->integer('pref_id')->comment('都道府県ID');
            $table->string('city')->comment('市区町村');
            $table->string('town')->comment('町名番地等');
            $table->string('building')->nullable()->comment('建物等');
            $table->string('phone_number')->comment('電話番号');
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
            $table->dropColumn('role');
            $table->dropColumn('postal_code');
            $table->dropColumn('pref_id');
            $table->dropColumn('city');
            $table->dropColumn('town');
            $table->dropColumn('building');
            $table->dropColumn('phone_number');
    });
}
}
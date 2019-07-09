<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLegalFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('ogrn')->after('is_verified')->nullable();
            $table->string('phone')->after('ogrn')->nullable();
            $table->string('legal_address')->after('phone')->nullable();
            $table->string('address')->after('legal_address')->nullable();
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
            $table->dropColumn(array(
                'ogrn',
                'phone',
                'legal_address',
                'address'
            ));
        });
    }
}

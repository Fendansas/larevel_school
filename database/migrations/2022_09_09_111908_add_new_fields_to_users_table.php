<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('religion')->nullable();
            $table->string('id_no')->nullable();
            $table->date('dob')->nullable();
            $table->string('code')->nullable();
            $table->string('role')->nullable()->comment('admin=head of software, operator, computer operator, user=employee');
            $table->date('join_date')->nullable();
            $table->integer('designation_id')->nullable();
            $table->double('salary')->nullable();
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
            $table->dropColumn('fname');
            $table->dropColumn('mname');
            $table->dropColumn('religion');
            $table->dropColumn('id_no');
            $table->dropColumn('dob');
            $table->dropColumn('code');
            $table->dropColumn('role');
            $table->dropColumn('join_date');
            $table->dropColumn('designation_id');
            $table->dropColumn('salary');
        });
    }
}

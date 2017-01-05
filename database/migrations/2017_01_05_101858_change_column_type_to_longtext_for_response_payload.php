<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class ChangeColumnTypeToLongtextForResponsePayload extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('routes', function (Blueprint $table) {
            $table->text('payload_swap');
        });

        Schema::table('routes', function (Blueprint $table) {
            foreach(DB::table('routes')->get() as $route) {
                DB::table('routes')->where('id', $route->id)->update('payload_swap', $route->payload);
            }
        });

        Schema::table('routes', function (Blueprint $table) {
            $table->dropColumn('payload');
        });

        Schema::table('routes', function (Blueprint $table) {
            $table->longText('payload');
        });

        Schema::table('routes', function (Blueprint $table) {
            foreach(DB::table('routes')->get() as $route) {
                DB::table('routes')->where('id', $route->id)->update('payload', $route->payload_swap);
            }
        });

        Schema::table('routes', function (Blueprint $table) {
            $table->dropColumn('payload_swap');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // It does not make sense to roll back this migration as data will be lost when going from longtext to text.
        // Therefor it has been left unchanged
    }
}

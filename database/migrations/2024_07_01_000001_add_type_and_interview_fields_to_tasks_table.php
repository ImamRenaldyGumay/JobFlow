<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->string('type')->default('general')->after('status'); // general, interview, followup, etc
            $table->string('location')->nullable()->after('type');      // khusus interview
            $table->string('link')->nullable()->after('location');      // khusus interview
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['type', 'location', 'link']);
        });
    }
};
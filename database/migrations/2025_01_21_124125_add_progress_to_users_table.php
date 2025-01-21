<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddProgressToUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('progress')->default(0);
            $table->integer('total_lessons_completed')->default(0);
            $table->float('average_wpm')->default(0);
            $table->float('average_accuracy')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['progress', 'total_lessons_completed', 'average_wpm', 'average_accuracy']);
        });
    }
};

<?php

use App\Models\UserRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(UserRole::class)->nullable()->default(null)->constrained();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['user_role_id']);
 // Remove the foreign key constraint
            $table->dropColumn('user_role_id'); // Drop the column
        });

        // Drop the entire 'users' table
        Schema::dropIfExists('users');
    }
};

<?php

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
        Schema::table('products', function (Blueprint $table) {
            // add deleted_at for soft deletes
            $table->softDeletes()->after('quantity');

            // if you want to remove the old boolean is_deleted:
            if (Schema::hasColumn('products', 'is_deleted')) {
                $table->dropColumn('is_deleted');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_deleted')->default(false)->after('quantity');
            $table->dropSoftDeletes();
        });
    }
};

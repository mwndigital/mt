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
        Schema::table('bookings', function (Blueprint $table) {
            // Add the coupon_id column
            $table->unsignedBigInteger('coupon_id')->nullable()->after('total');
            // Add total discount column
            $table->decimal('discount', 10, 2)->default(0)->after('coupon_id');

            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['coupon_id']);
            // Drop the coupon_id column
            $table->dropColumn('coupon_id');
            // Drop the discount column
            $table->dropColumn('discount');
        });
    }
};

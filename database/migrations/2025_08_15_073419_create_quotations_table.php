<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    private const TABLE = 'quotations';
    private const FOREIGN_TABLE = 'destinations';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable(self::FOREIGN_TABLE)) {
            Schema::create(self::TABLE, function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('destination_id')->nullable();
                $table->foreign('destination_id')->references('id')->on(self::FOREIGN_TABLE)->onDelete('cascade');
                $table->date('start_date');
                $table->date('end_date');
                $table->integer('total_travelers')->default(0);
                $table->decimal('total_price', 8, 2);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
};

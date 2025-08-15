<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private const TABLE = 'coverage_option_quotation';
    private const FOREIGN_TABLE_COVERAGE = 'coverage_options';
    private const FOREIGN_TABLE_QUOTE = 'quotations';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable(self::FOREIGN_TABLE_COVERAGE) && Schema::hasTable(self::FOREIGN_TABLE_QUOTE)) {
            Schema::create(self::TABLE, function (Blueprint $table) {
                $table->id();
                $table->unsignedInteger('quotation_id')->nullable();
                $table->foreign('quotation_id')->references('id')->on(self::FOREIGN_TABLE_QUOTE)->onDelete('cascade');
                $table->unsignedInteger('coverage_option_id')->nullable();
                $table->foreign('coverage_option_id')->references('id')->on(self::FOREIGN_TABLE_COVERAGE)->onDelete('cascade');
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

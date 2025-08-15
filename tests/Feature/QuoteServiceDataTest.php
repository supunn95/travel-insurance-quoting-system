<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\QuoteService;
use App\Repositories\QuoteRepository;
use App\Models\Destination;
use App\Models\CoverageOption;

class QuoteServiceDataTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_quotation_feature_is_working_correctly(): void
    {
        $service = new QuoteService(new QuoteRepository());

        $destination = Destination::factory()->create(['price' => 100]);
        $coverageOption1 = CoverageOption::factory()->create(['price' => 50]);
        $coverageOption2 = CoverageOption::factory()->create(['price' => 30]);

        $quote = $service->createQuotation([
            'destination_id'     => $destination->id,
            'start_date'         => '2025-08-20',
            'end_date'           => '2025-08-25',
            'total_travelers'      => 2,
            'coverage_options' => [$coverageOption1->id, $coverageOption2->id],
        ]);

        $this->assertDatabaseHas('quotations', [
            'id' => $quote->id,
            'destination_id' => $destination->id,
            'total_price' => 360.0,
        ]);

        $this->assertDatabaseHas('coverage_options', [
            'id' => $coverageOption1->id,
        ]);

        $this->assertDatabaseHas('coverage_options', [
            'id' => $coverageOption2->id,
        ]);

        $this->assertDatabaseHas('coverage_option_quotation', [
            'quotation_id' => $quote->id,
            'coverage_option_id' => $coverageOption1->id,
        ]);

        $this->assertDatabaseHas('coverage_option_quotation', [
            'quotation_id' => $quote->id,
            'coverage_option_id' => $coverageOption2->id,
        ]);
    }
}

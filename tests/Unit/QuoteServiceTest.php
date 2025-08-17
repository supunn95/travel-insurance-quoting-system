<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Mockery;
use App\Repositories\QuoteRepository;
use App\Services\QuoteService;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;


class QuoteServiceTest extends TestCase
{
    use MockeryPHPUnitIntegration;
    /**
     * A basic unit test example.
     */
    public function test_that_quote_price_calculated_correctly(): void
    {

        $destinationId = 1;
        $optionIds = [1, 2];
        $totalTravelers = 2;
        $repo = Mockery::mock(QuoteRepository::class);
        $service = new QuoteService($repo);

        $repo->shouldReceive('getDestinationPrice')
            ->once()->with($destinationId)->andReturn(30);

        $repo->shouldReceive('getSumOfCoverageOptions')
            ->once()->with($optionIds)->andReturn(50);

        $total = $service->calculateQuotation($destinationId, $optionIds, $totalTravelers);

        $this->assertSame(160.0, $total);

    }
}

<?php

namespace App\Services;

use App\Repositories\QuoteRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class QuoteService
{

    public function __construct(private QuoteRepository $quoteRepository)
    {
    }

    public function calculateQuotation(int $destinationId, array $optionIds, int $totalTravelers)
    {

        try {
            $destinationPrice = $this->quoteRepository->getDestinationPrice($destinationId);
            $coverageOptionsPrice = $this->quoteRepository->getSumOfCoverageOptions($optionIds);

            $totalPrice = ($destinationPrice + $coverageOptionsPrice) * $totalTravelers;

            return $totalPrice;
        } catch (Exception $e) {
            Log::error('Error calculating quotation: ' . $e->getMessage());
            throw new Exception('Error calculating quotation.');
        }

    }

    public function createQuotation(array $data)
    {
        try {
            $totalPrice = $this->calculateQuotation(
                $data['destination_id'],
                $data['coverage_options'],
                $data['total_travelers']
            );

            $quote = $this->quoteRepository->createQuotation([
                'destination_id' => $data['destination_id'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'total_travelers' => $data['total_travelers'],
                'total_price' => $totalPrice,
                'coverage_options' => $data['coverage_options']
            ]);

            return $quote;

        } catch (Exception $e) {
            Log::error('Error creating quotation: ' . $e->getMessage());
            throw new Exception('Error creating quotation.');
        }
    }

}

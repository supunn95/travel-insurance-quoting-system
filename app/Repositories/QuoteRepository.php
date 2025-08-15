<?php

namespace App\Repositories;
use App\Models\Quotation;
use App\Models\Destination;
use App\Models\CoverageOption;

class QuoteRepository
{

    public function createQuotation(array $data): Quotation
    {
        $quotation = Quotation::create([
            'destination_id' => $data['destination_id'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'total_travelers' => $data['total_travelers'],
            'total_price' => $data['total_price']
        ]);

        if (isset($data['coverage_options'])) {
            $quotation->coverageOptions()->attach($data['coverage_options']);
        }

        return $quotation;
    }

    public function getDestinationPrice(int $destinationId): float
    {
        return Destination::where('id', $destinationId)->first()->price ?? 0;
    }

    public function getSumOfCoverageOptions(array $optionIds): float
    {
        return CoverageOption::whereIn('id', $optionIds)->sum('price');
    }

}
<?php

namespace App\Repositories;
use App\Models\Quotation;
use App\Models\Destination;
use App\Models\CoverageOption;
use Illuminate\Database\Eloquent\Collection;

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

    public function getAllDestinations(): Collection
    {
        return Destination::get(['id', 'name', 'price']);
    }

    public function getAllCoverageOptions(): Collection
    {
        return CoverageOption::get(['id', 'name', 'price']);
    }

    public function getAllAddedQuotes(): Collection
    {
        return Quotation::with('coverageOptions', 'destination')->get();
    }

    public function removeQuoteById(int $quoteId): bool
    {
        $quotation = Quotation::where('id', $quoteId)->first();
        if ($quotation) {
            $quotation->coverageOptions()->detach();
            return $quotation->delete();
        }
        return false;
    }

}
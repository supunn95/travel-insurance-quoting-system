<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\QuoteService;
use App\Http\Requests\StoreQuotationRequest;

class QuotingForm extends Component
{

    public $addedQuotes;
    public $destinations;
    public $coverageOptions;
    public $destination_id = null;
    public $start_date = null;
    public $end_date = null;
    public $total_travelers = 0;
    public $coverage_options = [];

    public function mount(QuoteService $quoteService)
    {
        $this->addedQuotes = $quoteService->getAddedQuotes();
        $this->destinations = $quoteService->getDestinations();
        $this->coverageOptions = $quoteService->getCoverageOptions();
    }

    public function saveQuote(QuoteService $quoteService)
    {
        $request = new StoreQuotationRequest();
        $validated = $this->validate($request->rules(), $request->messages());

        $quote = $quoteService->createQuotation($validated);

        if ($quote) {
            $this->addedQuotes = $quoteService->getAddedQuotes();
        }

    }

    public function removeQuote(QuoteService $quoteService, $quoteId)
    {
        $removed = $quoteService->removeQuote($quoteId);

        if ($removed) {
            $this->addedQuotes = $quoteService->getAddedQuotes();
        }
    }

    public function render()
    {
        return view('livewire.quoting-form');
    }
}

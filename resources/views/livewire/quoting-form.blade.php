<div class="quoting-form-wrapper">

    <div class="min-h-screen p-6">
        <section>
            <h1 class="text-center mb-3"> Calculate travel insurance quote </h1>

            <div class="quoting-form">
                <form wire:submit.prevent="saveQuote" class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Destination</label>
                        <select wire:model.live="destination_id" class="w-full rounded border p-2">
                            <option value="">Select a destination</option>
                            @foreach ($destinations as $destination)
                                <option value="{{ $destination->id }}">{{ $destination->name }}
                                    (+${{ $destination->price }})
                                </option>
                            @endforeach
                        </select>
                        @error('destination_id')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Start date</label>
                        <input type="date" wire:model.live="start_date" class="w-full border rounded p-2">
                        @error('start_date')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">End date</label>
                        <input type="date" wire:model.live="end_date" class="w-full border rounded p-2">
                        @error('end_date')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Number of travelers</label>
                        <input type="number" min="1" wire:model.live="total_travelers"
                            class="w-full border rounded p-2">
                        @error('total_travelers')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Coverage options</label>
                        <select wire:model.live="coverage_options" multiple class="w-full rounded border p-2">
                            <option value="">Select a destination</option>
                            @foreach ($coverageOptions as $coverageOption)
                                <option value="{{ $coverageOption->id }}">{{ $coverageOption->name }}
                                    (+${{ $coverageOption->price }})
                                </option>
                            @endforeach
                        </select>
                        @error('coverage_options')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="text-black">Get quote</button>
                    </div>
                </form>
            </div>
        </section>
        <section class="text-center">
            <h1> Quoted Prices List</h1>
            <div class="card w-full bg-gray-300 rounded flex justify-center max-h-64 overflow-y-auto p-6">
                <table class="border-collapse border border-gray-400">
                    <thead>
                        <tr>
                            <th class="border border-gray-600 p-3">Destination</th>
                            <th class="border border-gray-600 p-3">Travel start date</th>
                            <th class="border border-gray-600 p-3">Travel end date</th>
                            <th class="border border-gray-600 p-3">Coverage options</th>
                            <th class="border border-gray-600 p-3">Number of travelers</th>
                            <th class="border border-gray-600 p-3">Quoted price</th>
                            <th class="border border-gray-600 p-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($addedQuotes as $quote)
                            <tr>
                                <td class="border border-gray-600 p-3">{{ $quote?->destination?->name }}</td>
                                <td class="border border-gray-600 p-3">{{ $quote?->start_date }}</td>
                                <td class="border border-gray-600 p-3">{{ $quote?->end_date }}</td>
                                <td class="border border-gray-600 p-3">
                                    @foreach ($quote?->coverageOptions as $coverageOption)
                                        <span class="block">{{ $coverageOption->name }}
                                            (+${{ $coverageOption->price }})</span>
                                    @endforeach
                                </td>
                                <td class="border border-gray-600 p-3">{{ $quote?->total_travelers }}</td>
                                <td class="border border-gray-600 p-3">{{ $quote?->total_price }}</td>
                                <td class="border border-gray-600 p-3">
                                    <button wire:click="removeQuote({{ $quote?->id }})"
                                        class="bg-rose-700 text-white rounded border p-2">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>

</div>

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contract;
use Illuminate\Support\Fluent;
use App\Enums\EntityDocumentType;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = filter_var($request?->input('q'));
        $orderBy = filter_var($request?->input('orderBy'));
        $direction = filter_var($request?->input('direction'));

        return view('contracts.index', [
            'records' => Contract::orderBy(
                in_array($orderBy, [
                    'id',
                    'name',
                    'email',
                    'document_type',
                    'document_value',
                    'updated_at',
                ]) ? $orderBy : 'id',
                in_array($direction, ['asc', 'desc']) ? $direction : 'asc'
            )
                    ?->withCount('customers')
                    ?->when($search, fn ($query) => $query->whereRaw('LOWER(name) like ?', '%' . $search . '%'))
                    ?->paginate(20)?->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('contracts.create', [
            'documentTypeOptions' => collect(EntityDocumentType::cases())
                ->map(fn ($item) => new Fluent([
                    'value' => $item?->value,
                    'label' => $item?->label(),
                ])),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request?->validate([
            'name' => 'required|string|min:3',
            'email' => 'nullable|email|unique:' . Contract::class . ',email',
            'document_type' => 'nullable|integer|in:' . collect(EntityDocumentType::cases())->pluck('value')->join(','),
            'document_value' => 'nullable|required_with:document_type|min:5',
        ]);

        $contract = new Contract();

        $storeData = collect([
            'name' => $validated['name'] ?? null,
            'email' => $validated['email'] ?? null,
            'document_type' => $validated['document_type'] ?? null,
            'document_value' => $validated['document_value'] ?? null,
        ])?->filter(fn ($item) => filled($item));

        $storeData?->each(function ($value, $key) use (&$contract) {
            $contract->{$key} = $value;
        });

        $created = $contract->save();

        $to = redirect()?->route('contracts.index', [
            'orderBy' => 'updated_at',
            'direction' => 'desc',
        ]);

        return $to->with($created ? [
            'success' => __('Record created successfully!'),
            'success_message_on' => sprintf('[data-record-id="%s"]', $contract?->id),
        ] : [
            'error' => __('Fail on store record!'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $contract = Contract::where('id', $id)->first();

        if (!$contract) {
            return redirect()?->route('contracts.index')
                    ?->with([
                        'error' => __('Not found :item', [
                            'item' => __('contract'),
                        ])
                    ]);
        }

        dd($contract);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $contract = Contract::where('id', $id)
                ?->with([
                    'customers' => fn ($query) => $query->select([
                        'id',
                        'name',
                    ])
                ])
            ->first();

        if (!$contract) {
            return redirect()?->route('contracts.index')
                    ?->with([
                        'error' => __('Not found :item', [
                            'item' => __('contract'),
                        ])
                    ]);
        }

        return view('contracts.edit', [
            'contract' => $contract,
            'user' => auth()->user(),
            'documentTypeOptions' => collect(EntityDocumentType::cases())
                ->map(fn ($item) => new Fluent([
                    'value' => $item?->value,
                    'label' => $item?->label(),
                ])),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request?->merge(
            array_filter([
                'can_open_tickets' => filter_var(
                    $request?->input('can_open_tickets'),
                    FILTER_VALIDATE_BOOLEAN,
                    FILTER_NULL_ON_FAILURE
                ),
            ], fn ($item) => filled($item))
        );

        $request?->validate([
            'name' => 'nullable|string|min:3',
            'document_type' => 'nullable|integer|in:' . collect(EntityDocumentType::cases())->pluck('value')->join(','),
            'document_value' => 'nullable|required_with:document_type|min:5',
        ]);

        $contract = Contract::where('id', $id)->first();

        if (!$contract) {
            return redirect()?->route('contracts.index')
                    ?->with([
                        'error' => __('Not found :item', [
                            'item' => __('contract'),
                        ])
                    ]);
        }

        $updateData = collect([
            // 'email' => $request?->input('email'), // Cant update email (email is the contract ID)
            'name' => $request?->input('name') ?: null,
            'document_type' => $request?->input('document_type') ?: null,
            'document_value' => $request?->input('document_value') ?: null,
        ])?->filter(fn ($item) => filled($item));

        $updateData?->each(function ($value, $key) use (&$contract) {
            $contract->{$key} = $value;
        });

        $updated = $contract->save();

        $to = back() ? back() : redirect()?->route('contracts.index', [
            'orderBy' => 'updated_at',
            'direction' => 'desc',
        ]);

        return $to->with($updated ? [
            'success' => __('Record updated successfully!'),
            'status' => 'contract-updated',
            'success_message_on' => sprintf('[data-record-id="%s"]', $contract?->id),
        ] : [
            'error' => __('Fail on update record!'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $contract = Contract::where('id', $id)->first();

        if (!$contract) {
            return redirect()?->route('contracts.index')
                    ?->with([
                        'error' => __('Not found :item', [
                            'item' => __('contract'),
                        ])
                    ]);
        }

        $deleted = $contract->delete();

        $to = back() ? back() : redirect()?->route('contracts.index', [
            'orderBy' => 'updated_at',
            'direction' => 'desc',
        ]);

        return $to->with($deleted ? [
            'success' => __('Record deleted successfully!'),
            'success_message_on' => sprintf('[data-record-id="%s"]', $contract?->id),
        ] : [
            'error' => __('Fail on delete record!'),
        ]);
    }
}

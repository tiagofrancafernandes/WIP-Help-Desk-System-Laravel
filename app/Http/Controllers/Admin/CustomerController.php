<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = filter_var($request?->input('q'));
        $orderBy = filter_var($request?->input('orderBy'));
        $direction = filter_var($request?->input('direction'));

        return view('customers.index', [
            'records' => Customer::orderBy(
                in_array($orderBy, [
                    'id',
                    'name',
                    'email',
                    'can_open_tickets',
                    'tickets_count',
                    'updated_at',
                ]) ? $orderBy : 'id',
                in_array($direction, ['asc', 'desc']) ? $direction : 'asc'
            )
                    ?->withCount('tickets')
                    ?->when($search, fn ($query) => $query->whereRaw('LOWER(name) like ?', '%' . $search . '%'))
                    ?->paginate(20)?->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('customers.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        //
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
            'password' => 'nullable|string|password',
            'can_open_tickets' => 'nullable|boolean',
        ]);

        $customer = Customer::where('id', $id)->first();

        if (!$customer) {
            return redirect()?->route('customers.index')
                    ?->with([
                        'error' => __('Not found :item', [
                            'item' => __('customer'),
                        ])
                    ]);
        }

        $updateData = collect([
            'name' => $request?->input('name') ?: null,
            // 'email' => $request?->input('email'),
            'password' => $request?->input('password') ? Hash::make($request?->input('password')) : null,
            'can_open_tickets' => $request?->boolean('can_open_tickets'),
        ])?->filter(fn ($item) => filled($item));

        $updateData?->each(function ($value, $key) use (&$customer) {
            $customer->{$key} = $value;
        });

        $updated = $customer->save();

        $to = back() ? back() : redirect()?->route('customers.index', [
            'orderBy' => 'updated_at',
            'direction' => 'desc',
        ]);

        return $to->with($updated ? [
            'success' => __('Record updated successfully!'),
            'success_message_on' => sprintf('[data-record-id="%s"]', $customer?->id),
        ] : [
            'error' => __('Fail on update record!'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        //
    }
}

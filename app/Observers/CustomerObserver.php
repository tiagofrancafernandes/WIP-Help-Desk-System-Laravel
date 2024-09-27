<?php

namespace App\Observers;

use App\Models\Customer;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewCustomerMail;

class CustomerObserver
{
    /**
     * Handle the Customer "created" event.
     */
    public function created(Customer $customer): void
    {
        if (!filter_var($customer?->email, FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE)) {
            return;
        }

        Mail::to($customer?->email)->send(new NewCustomerMail($customer));
    }

    /**
     * Handle the Customer "updated" event.
     */
    public function updated(Customer $customer): void
    {
        //
    }

    /**
     * Handle the Customer "deleted" event.
     */
    public function deleted(Customer $customer): void
    {
        //
    }

    /**
     * Handle the Customer "restored" event.
     */
    public function restored(Customer $customer): void
    {
        //
    }

    /**
     * Handle the Customer "force deleted" event.
     */
    public function forceDeleted(Customer $customer): void
    {
        //
    }
}

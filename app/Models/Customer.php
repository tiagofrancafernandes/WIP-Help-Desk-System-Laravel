<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    use HasFactory;
    use HasApiTokens;
    use Notifiable;
    use HasUuids;

    protected $connection = 'mysql';
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'password',
        'can_open_tickets',
    ];

    protected $casts = [
        'can_open_tickets' => 'boolean',
    ];

    protected $hidden = [
        'password',
    ];

    public function getConnectionName(): ?string
    {
        return config('database.default');
    }

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array
     */
    public function uniqueIds(): array
    {
        return [
            'uuid',
        ];
    }

    /**
     * Get all of the tickets for the Customer
     *
     * @return HasMany
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'email', 'email');
    }

    public function passwordIsValid(string $password): bool
    {
        return Hash::check($password, $this?->password);
    }

    public function validateWithPassword(string $password): ?static
    {
        return Hash::check($password, $this?->password) ? $this : null;
    }

    public function customerTotalTickets(): int
    {
        // $this->tickets()->count(); // Good way

        $email = $this->{'email'} ?? null;

        if (!$email) {
            return 0;
        }

        return Ticket::totalOfTickets($email); // Alter way
    }
}

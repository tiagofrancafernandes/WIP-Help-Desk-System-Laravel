<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class Customer extends Model
{
    use HasFactory;
    use HasApiTokens;
    use Notifiable;
    use HasUuids;

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

    public function passwordIsValid(string $password): bool
    {
        return Hash::check($password, $this?->password);
    }

    public function validateWithPassword(string $password): ?static
    {
        return Hash::check($password, $this?->password) ? $this : null;
    }
}

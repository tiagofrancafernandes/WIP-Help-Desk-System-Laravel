<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $email
 * @property bool $can_open_tickets
 * @property string $password
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int|null $contract_id
 * @property-read Contract|null $contract
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ticket> $tickets
 * @property-read int|null $tickets_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\CustomerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCanOpenTickets($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereContractId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Customer whereUuid($value)
 * @mixin \Eloquent
 */
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
        'contract_id',
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

    /**
     * Get the contract that owns the Customer
     *
     * @return BelongsTo
     */
    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class, 'contract_id', 'id');
    }
}

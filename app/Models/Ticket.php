<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Ticket extends Model
{
    use HasFactory;

    protected $connection = 'hesk_mysql';
    public $timestamps = false;

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        return implode('', [
            config('database.connections.hesk_mysql.hesk_prefix', ''),
            'tickets',
        ]);
    }

    public function scopeByEmail(Builder $query, string $email): Builder
    {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE) ?? '';

        return $query?->where('email', $email);
    }

    /**
     * Get the customer that owns the Ticket
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'email', 'email');
    }

    public static function emailGroup(): \Illuminate\Database\Query\Builder
    {
        /**
         * @var static $instance
         */
        $instance = app(static::class);

        return DB::connection($instance->getConnectionName())
            ->table($instance->getTable())
            ->select(
                'email',
                DB::raw('COUNT( email ) as total')
            )
            ->groupBy('email')
            ->havingRaw('COUNT( email )>= 1')
            ->orderBy('email');
    }

    public static function totalOfTickets(?string $email = null): int
    {
        return intval(
            static::emailGroup()
                ->when($email, fn (Builder $query, $value) => $query->where('email', $value)->limit(1))
                ->get()->sum('total')
            ?? 0
        );
    }
}

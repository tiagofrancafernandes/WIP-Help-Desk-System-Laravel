<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\EntityDocumentType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Fluent;

class Contract extends Model
{
    use HasFactory;
    use HasUuids;

    protected $connection = 'mysql';
    protected $fillable = [
        'uuid',
        'name',
        'email',
        'document_type',
        'document_value',
    ];

    protected $appends = [
        // 'tickets_count',
        // 'totalOfTickets',
    ];

    protected $casts = [
        'document_type' => EntityDocumentType::class,
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
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::created(function (Contract $user) {
            static::clearAllRelatedCache();
        });

        static::updated(function (Contract $user) {
            static::clearAllRelatedCache();
        });
    }

    /**
     * Get all of the customers for the Contract
     *
     * @return HasMany
     */
    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class, 'contract_id', 'id');
    }

    public function getTicketsCountAttribute()
    {
        return $this->getTotalOfTicketsAttribute();
    }

    public function getTotalOfTicketsAttribute()
    {
        return Customer::select('id', 'email', 'contract_id')
            ->whereNotNull('contract_id')
            ->where('contract_id', $this->id)
                ?->withCount('tickets')
                ?->get()
                ?->sum('tickets_count') ?: 0;
    }

    public static function selectIds(): \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|array
    {
        return cache()->remember(
            static::cacheKeys()['selectIds'] ?? __METHOD__,
            5 * 60,
            fn () => Contract::select('id', 'name', 'document_value')
                ->get()
                    ?->map(fn ($item) => new Fluent([
                        'id' => $item->id,
                        'label' => sprintf('%s %s', $item->name, $item->document_value ? "({$item->document_value})" : '')
                    ])),
        ) ?: [];
    }

    public static function cacheKeys(): array
    {
        return [
            'selectIds' => static::class . '@selectIds',
        ];
    }

    public static function clearAllRelatedCache(array $only = []): void
    {
        collect(static::cacheKeys())
            ->when($only, fn ($collection) => $collection->only($only))
            ->values()
            ->each(fn ($key) => cache()->forget($key));
    }
}

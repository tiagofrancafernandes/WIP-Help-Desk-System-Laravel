<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\EntityDocumentType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

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
}

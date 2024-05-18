<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Query\Builder;

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
            parent::getTable(),
        ]);
    }

    public function scopeByEmail(Builder $query, string $email): Builder
    {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL, FILTER_NULL_ON_FAILURE) ?? '';

        return $query?->where('email', $email);
    }
}

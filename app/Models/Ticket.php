<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

/**
 *
 *
 * @property int $id
 * @property string $trackid
 * @property string $name
 * @property string $email
 * @property int $category
 * @property string $priority
 * @property string $subject
 * @property string $message
 * @property string|null $message_html
 * @property string $dt
 * @property string $lastchange
 * @property string|null $firstreply
 * @property string|null $closedat
 * @property string|null $articles
 * @property string $ip
 * @property string|null $language
 * @property int $status
 * @property int|null $openedby
 * @property int|null $firstreplyby
 * @property int|null $closedby
 * @property int $replies
 * @property int $staffreplies
 * @property int $owner
 * @property int|null $assignedby
 * @property string $time_worked
 * @property string $lastreplier
 * @property int|null $replierid
 * @property string $archive
 * @property string $locked
 * @property string $attachments
 * @property string $merged
 * @property string $history
 * @property string $custom1
 * @property string $custom2
 * @property string $custom3
 * @property string $custom4
 * @property string $custom5
 * @property string $custom6
 * @property string $custom7
 * @property string $custom8
 * @property string $custom9
 * @property string $custom10
 * @property string $custom11
 * @property string $custom12
 * @property string $custom13
 * @property string $custom14
 * @property string $custom15
 * @property string $custom16
 * @property string $custom17
 * @property string $custom18
 * @property string $custom19
 * @property string $custom20
 * @property string $custom21
 * @property string $custom22
 * @property string $custom23
 * @property string $custom24
 * @property string $custom25
 * @property string $custom26
 * @property string $custom27
 * @property string $custom28
 * @property string $custom29
 * @property string $custom30
 * @property string $custom31
 * @property string $custom32
 * @property string $custom33
 * @property string $custom34
 * @property string $custom35
 * @property string $custom36
 * @property string $custom37
 * @property string $custom38
 * @property string $custom39
 * @property string $custom40
 * @property string $custom41
 * @property string $custom42
 * @property string $custom43
 * @property string $custom44
 * @property string $custom45
 * @property string $custom46
 * @property string $custom47
 * @property string $custom48
 * @property string $custom49
 * @property string $custom50
 * @property string|null $due_date
 * @property int|null $overdue_email_sent
 * @property int|null $satisfaction_email_sent
 * @property string|null $satisfaction_email_dt
 * @property-read Customer|null $customer
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket byEmail(string $email)
 * @method static \Database\Factories\TicketFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereArchive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereArticles($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereAssignedby($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereAttachments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereClosedat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereClosedby($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom10($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom11($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom12($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom13($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom14($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom15($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom16($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom17($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom18($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom19($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom20($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom21($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom22($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom23($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom24($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom25($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom26($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom27($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom28($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom29($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom30($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom31($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom32($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom33($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom34($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom35($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom36($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom37($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom38($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom39($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom40($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom41($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom42($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom43($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom44($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom45($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom46($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom47($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom48($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom49($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom50($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom6($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom7($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom8($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereCustom9($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereFirstreply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereFirstreplyby($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereHistory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereLastchange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereLastreplier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereMerged($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereMessageHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereOpenedby($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereOverdueEmailSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereOwner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereReplierid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereReplies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereSatisfactionEmailDt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereSatisfactionEmailSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereStaffreplies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereTimeWorked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ticket whereTrackid($value)
 * @mixin \Eloquent
 */
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

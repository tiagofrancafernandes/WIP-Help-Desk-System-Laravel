<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'trackid' => str(fake()?->bothify('***-*#*-*#*#'))?->upper()?->toString(),
            'name' => "teste",
            'email' => "demo1@mail.com",
            'category' => 1,
            'priority' => "3",
            'subject' => "teste",
            'message' => "teste",
            'message_html' => "teste",
            'dt' => date('Y-m-d H:i:s'),
            'lastchange' => date('Y-m-d H:i:s'),
            'firstreply' => null,
            'closedat' => null,
            'articles' => null,
            'ip' => "192.168.22.184",
            'language' => null,
            'status' => 0,
            'openedby' => 0,
            'firstreplyby' => null,
            'closedby' => null,
            'replies' => 0,
            'staffreplies' => 0,
            'owner' => 1,
            'assignedby' => -1,
            'time_worked' => "00:00:00",
            'lastreplier' => "0",
            'replierid' => null,
            'archive' => "0",
            'locked' => "0",
            'attachments' => "",
            'merged' => "",
            'history' => '<li class="smaller">2024-05-03 23:31:42 | submitted by Customer</li><li class="smaller">2024-05-03 23:31:42 | automatically assigned to Admin (Administrator)</li>',
            'custom1' => '',
            'custom2' => '',
            'custom3' => '',
            'custom4' => '',
            'custom5' => '',
            'custom6' => '',
            'custom7' => '',
            'custom8' => '',
            'custom9' => '',
            'custom10' => '',
            'custom11' => '',
            'custom12' => '',
            'custom13' => '',
            'custom14' => '',
            'custom15' => '',
            'custom16' => '',
            'custom17' => '',
            'custom18' => '',
            'custom19' => '',
            'custom20' => '',
            'custom21' => '',
            'custom22' => '',
            'custom23' => '',
            'custom24' => '',
            'custom25' => '',
            'custom26' => '',
            'custom27' => '',
            'custom28' => '',
            'custom29' => '',
            'custom30' => '',
            'custom31' => '',
            'custom32' => '',
            'custom33' => '',
            'custom34' => '',
            'custom35' => '',
            'custom36' => '',
            'custom37' => '',
            'custom38' => '',
            'custom39' => '',
            'custom40' => '',
            'custom41' => '',
            'custom42' => '',
            'custom43' => '',
            'custom44' => '',
            'custom45' => '',
            'custom46' => '',
            'custom47' => '',
            'custom48' => '',
            'custom49' => '',
            'custom50' => '',
        ];
    }
}

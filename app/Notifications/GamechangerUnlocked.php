<?php

namespace App\Notifications;

use App\Models\Gamechanger;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class GamechangerUnlocked extends Notification
{
    use Queueable;

    protected Gamechanger $gamechanger;

    public function __construct($gamechanger)
    {
        $this->gamechanger = $gamechanger;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => '⚡ Neuer Gamechanger freigeschaltet!',
            'message' => "Du hast den Gamechanger '{$this->gamechanger->name}' freigeschaltet.",
            'url' => route('dashboard'),
        ];
    }
}

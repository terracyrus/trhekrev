<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class GamechangerActivated extends Notification
{
    use Queueable;

    protected $gamechanger;
    protected $requester;

    public function __construct($gamechanger, $requester)
    {
        $this->gamechanger = $gamechanger;
        $this->requester = $requester;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => '🔥 Gamechanger wurde angewendet!',
            'message' => "Die Gruppe '{$this->requester->name}' hat den Gamechanger '{$this->gamechanger->name}' auf dich angewendet!",
            'url' => route('dashboard'),
        ];
    }
}

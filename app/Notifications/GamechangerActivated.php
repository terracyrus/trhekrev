<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class GamechangerActivated extends Notification
{
    use Queueable;

    protected $gamechanger;
    protected $requester;
    protected $is_immune;

    public function __construct($gamechanger, $requester, $is_immune = false)
    {
        $this->gamechanger = $gamechanger;
        $this->requester = $requester;
        $this->is_immune = $is_immune;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        if ($this->is_immune) {
            return [
                'title' => '🛡️ Gamechanger wurde abgewehrt!',
                'message' => "Durch Sicherheit wurde der Gamechanger '{$this->gamechanger->name}' durch die Gruppe '{$this->requester->name}'! abgewehrt.",
                'url' => route('dashboard'),
            ];
        } else {
            return [
                'title' => '🔥 Gamechanger wurde angewendet!',
                'message' => "Die Gruppe '{$this->requester->name}' hat den Gamechanger '{$this->gamechanger->name}' auf dich angewendet!",
                'url' => route('dashboard'),
            ];
        }
    }
}

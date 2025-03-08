<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserQualified extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['database']; // Speichert die Benachrichtigung in der DB
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => '🏆 Du bist jetzt für die Rangliste qualifiziert!',
            'message' => 'Herzlichen Glückwunsch! Du hast in allen Stärnlizacken mindestens einen Posten absolviert.',
            'url' => route('dashboard'),
        ];
    }
}

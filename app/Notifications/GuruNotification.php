<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class GuruNotification extends Notification
{
    public function __construct(
        private string $action,
        private string $namaGuru,
        private string $url,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Data Guru',
            'message' => "Data guru {$this->namaGuru} berhasil di{$this->action}.",
            'url' => $this->url,
        ];
    }
}

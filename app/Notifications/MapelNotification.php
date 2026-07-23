<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class MapelNotification extends Notification
{
    public function __construct(
        private string $action,
        private string $namaMapel,
        private string $url,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Data Mapel',
            'message' => "Data mapel {$this->namaMapel} berhasil di{$this->action}.",
            'url' => $this->url,
        ];
    }
}

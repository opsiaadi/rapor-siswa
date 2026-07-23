<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class EskulNotification extends Notification
{
    public function __construct(
        private string $action,
        private string $namaEskul,
        private string $url,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Data Eskul',
            'message' => "Data eskul {$this->namaEskul} berhasil di{$this->action}.",
            'url' => $this->url,
        ];
    }
}

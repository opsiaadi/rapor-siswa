<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class KelasNotification extends Notification
{
    public function __construct(
        private string $action,
        private string $namaKelas,
        private string $url,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Data Kelas',
            'message' => "Data kelas {$this->namaKelas} berhasil di{$this->action}.",
            'url' => $this->url,
        ];
    }
}

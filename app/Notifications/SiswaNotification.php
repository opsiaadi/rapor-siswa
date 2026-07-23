<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class SiswaNotification extends Notification
{
    public function __construct(
        private string $action,
        private string $namaSiswa,
        private string $url,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Data Siswa',
            'message' => "Data siswa {$this->namaSiswa} berhasil di{$this->action}.",
            'url' => $this->url,
        ];
    }
}

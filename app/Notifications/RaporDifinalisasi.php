<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class RaporDifinalisasi extends Notification
{
    public function __construct(
        private string $waliNama,
        private string $siswaNama,
        private string $kelasNama,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Rapor Difinalisasi',
            'message' => "{$this->waliNama} memfinalisasi rapor {$this->siswaNama} di kelas {$this->kelasNama}.",
            'url' => route('admin.siswa.index'),
        ];
    }
}

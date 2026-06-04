<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class NilaiTerkirim extends Notification
{
    public function __construct(
        private string $mapelNama,
        private string $kelasNama,
        private string $semester,
        private string $url,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Nilai Terkirim',
            'message' => "Nilai {$this->mapelNama} untuk kelas {$this->kelasNama} Semester {$this->semester} berhasil dikirim.",
            'url' => $this->url,
        ];
    }
}

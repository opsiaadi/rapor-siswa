<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class GeneratePasswordHash extends Command
{
    protected $signature = 'hash:generate {password}';
    protected $description = 'Generate bcrypt hash for a password';

    public function handle(): void
    {
        $password = $this->argument('password');
        if (!$password) {
            $this->error('Usage: php artisan hash:generate <password>');
            return;
        }
        $hash = Hash::make($password);
        $this->info("Hash: $hash");
    }
}

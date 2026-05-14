# Fix: Password Hashing di Admin & Guru Model

## Masalah
Model `Admin.php` dan `Guru.php` tidak memiliki `casts()` method untuk `'password' => 'hashed'`, sehingga password disimpan sebagai plain text di database.

## Perubahan

### 1. `app/Models/Admin.php`
Tambahkan method `casts()` setelah `$hidden`:

```php
protected function casts(): array
{
    return [
        'password' => 'hashed',
    ];
}
```

### 2. `app/Models/Guru.php`
Tambahkan method `casts()` yang sama di posisi yang sama.

### 3. Fix data existing
Hash password record yang masih plain text (Guru id=2, password=12345):

```bash
php artisan tinker
>>> \App\Models\Guru::find(2)->update(['password' => '12345']);
>>> \App\Models\Admin::all()->each(fn($a) => $a->save()); // re-hash if needed
```

<?php
declare(strict_types=1);

namespace App\Faker;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FakerImageProvider
{
public function loremFlicker(string $dir = '', int $width = 500, int $height = 300): string
{
    $name = $dir . '/' . Str::random(6) . '.jpg';

    Storage::put($name, file_get_contents("https://loremflickr.com/$width/$height"));

    return '/storage/' . $name;
}
}

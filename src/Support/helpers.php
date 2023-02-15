<?php
declare(strict_types=1);

use vendor\src\Support\Flash\Flash;

if (!function_exists('flash'))
{
    function flash(): Flash
    {
        return app(Flash::class);
    }
}

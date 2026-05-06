<?php
declare(strict_types=1);

namespace App\Views;

class PHPInfoView
{
    public static function render(): void {
        echo phpinfo();
    }
}
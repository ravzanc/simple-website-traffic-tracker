<?php

declare(strict_types=1);

namespace App\Api;

interface Api
{
    public function getData(): array;
    public function postData(): bool;
}

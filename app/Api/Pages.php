<?php

declare(strict_types=1);

namespace App\Api;

use App\Db\Query;

class Pages implements Api
{
    public function getData(): array
    {
        $query = "SELECT DISTINCT page_url FROM visits 
            ORDER BY page_url";

        return Query::select(
            $query,
        );
    }

    public function postData(): bool
    {
        return false;
    }
}

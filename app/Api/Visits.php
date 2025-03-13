<?php

declare(strict_types=1);

namespace App\Api;

use App\Db\Query;
use App\Helper\DateTimeService;

class Visits implements Api
{
    public function getData(): array
    {
        $whereClauses = $queryParams = [];

        if (empty($_GET['pageUrl'])) {
            $query = "SELECT page_url AS context, COUNT(visitor_id) AS value 
                FROM visits %s
                GROUP BY page_url ORDER BY value DESC";
        } else {
            $query = "SELECT DATE_FORMAT(CONVERT_TZ(visit_time, '+00:00', '"
                . DateTimeService::convertUTCTimeZoneOffset($_GET['tzDate'])
                . "'), '%%m/%%d/%%Y %%H:%%i') AS context, 
                    COUNT(visitor_id) AS value 
                    FROM visits %s
                    GROUP BY context ORDER BY context";

            $whereClauses[] = 'page_url = ?';
            $queryParams[]  = $_GET['pageUrl'];
        }

        if (!empty($_GET['startDate'])) {
            $whereClauses[] = 'visit_time >= ?';
            $queryParams[] = DateTimeService::handleTimeZoneOffset(
                $_GET['startDate'],
                $_GET['tzDate'] ?? null
            )->format('Y-m-d H:i:s');
        }
        if (!empty($_GET['endDate'])) {
            $whereClauses[] = 'visit_time <= ?';
            $queryParams[]  = DateTimeService::handleTimeZoneOffset(
                $_GET['endDate'],
                $_GET['tzDate'] ?? null
            )->format('Y-m-d H:i:s');
        }

        if ($whereClauses) {
            $query = sprintf($query, 'WHERE ' . implode(' AND ', $whereClauses));
        } else {
            $query = sprintf($query, '');
        }

        return Query::select(
            $query,
            $queryParams,
        );
    }

    public function postData(): bool
    {
        $inputData = json_decode(file_get_contents('php://input'), true);

        return Query::insert(
            'INSERT INTO visits (visitor_id, page_url, visit_time) VALUES (?, ?, ?)',
            'sss',
            $inputData['visitorId'],
            $inputData['pageUrl'],
            $inputData['visitTime'],
        );
    }
}

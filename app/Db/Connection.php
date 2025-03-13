<?php

declare(strict_types=1);

namespace App\Db;

use Exception;
use mysqli;

class Connection
{
    private static ?Connection $instance = null;

    private string $host;
    private int $port;
    private string $userName;
    private string $password;
    private string $databaseName;

    public function connect(): mysqli
    {
        $db = new mysqli($this->host, $this->userName, $this->password, $this->databaseName, $this->port);

        if ($db->connect_error) {
            http_response_code(500);
            echo json_encode(['error' => 'Database connection failed']);
            exit;
        }

        return $db;
    }
    public static function getInstance(): Connection
    {
        if (self::$instance === null) {
            self::$instance = new self(require  __DIR__ . '/../../config/database.php');
        }

        return self::$instance;
    }

    private function __construct(array $params)
    {
        $this->host = $params['host'];
        $this->port = (int) $params['port'];
        $this->userName = $params['username'];
        $this->password = $params['password'];
        $this->databaseName = $params['database'];
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }
}

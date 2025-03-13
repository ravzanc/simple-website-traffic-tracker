<?php

namespace Integration;

use App\Db\Connection;
use Tests\TestCase;

class DatabaseConnectionTest extends TestCase
{
    public function testConnection(): void
    {
        $this->assertIsObject(Connection::getInstance()->connect());
    }

    public function testConnectionIsUnique(): void
    {
        $connectionFirst = Connection::getInstance();
        $connectionSecond = Connection::getInstance();

        $this->assertInstanceOf(Connection::class, $connectionFirst);
        $this->assertSame($connectionFirst, $connectionSecond);
    }
}

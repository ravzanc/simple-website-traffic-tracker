<?php

namespace Feature;

use Tests\TestCase;

class WebsiteTest extends TestCase
{
    public function testIndexPage(): void
    {
        $response = $this->getWebsitePageUrlResponse('/');

        $this->assertEquals($response['code'], 200);
        $this->assertEquals($response['type'], 'text/html; charset=UTF-8');
        $this->assertStringContainsString('<h1>My Dashboard</h1>', $response['content'],);
    }
}

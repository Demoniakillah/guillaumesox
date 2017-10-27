<?php

namespace SoxleBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{
    public function testGetimagesbyuri()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getImagesByUri');
    }

}

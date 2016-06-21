<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PronosticControllerTest extends WebTestCase
{
    public function testNouveau()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/nouveau');
    }

}

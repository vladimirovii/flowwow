<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomepageControllerTest extends WebTestCase
{
    public function testIndexGet()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('div[class="result"]', 'RUB 0.00');
    }

    public function testIndexPost()
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/', [
            'selection_tour_form' => [
                'amount' => '20000.00',
                'birthdate' => '1996-11-25',
                'tourdate' => '2025-04-25',
                'paymentdate' => '2025-01-03',
            ],
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('div[class="result"]', 'RUB 19,400.00');
    }
}

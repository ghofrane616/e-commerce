<?php
namespace App\Tests;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FunctionTest extends WebTestCase
{

    public function testPageIsAccessible()
    {
        $client = static::createClient();
        $client->request('GET', '/inscription');
        $this->assertResponseIsSuccessful();
    }

    public function testFormIsPresent()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/inscription');
        $this->assertSelectorExists('form[name="registrationForm"]');


    }
}

















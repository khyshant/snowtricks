<?php
/**
 * Created by PhpStorm.
 * User: khysh
 * Date: 22/03/2020
 * Time: 21:36
 */

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FunctionalTest extends WebTestCase
{
    public function testSuccessfullLogin()
    {
        $client = static::createClient();
        $crawler = $client->request(Request::METHOD_GET, "/login");

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $form = $crawler->filter('form[name=login_form]')->form([
           "_username" => "user1_1",
           "_password" => "userpass",
        ]);
        $client->submit($form);
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();
        $this->assertEquals('',$client->getRequest()->attributes->get('route'));
    }

    public function testFailedLogin()
    {
        $client = static::createClient();
        $crawler = $client->request(Request::METHOD_GET, "/login");

        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $form = $crawler->filter('form[name=login_form]')->form([
            "_username" => "user1_1",
            "_password" => "faill",
        ]);
        $client->submit($form);
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $crawler = $client->followRedirect();
        $this->assertEquals('login',$client->getRequest()->attributes->get('_route'));
        $this->assertStringContainsString('Invalid credentials.',$crawler->filter('div.alert-danger')->text());
        dump($crawler->filter('div.alert-danger')->text());   }
}
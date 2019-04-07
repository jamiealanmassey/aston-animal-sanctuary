<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory;

class FakerTests extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $faker = Factory::create();
        $url = 'https://source.unsplash.com/featured/?dog';
        $img = 'public/img/faker/';
        $ext = pathinfo($url, PATHINFO_EXTENSION); //$ext will be gif
        file_put_contents($img . 'dog.jpg', file_get_contents($url));
        $this->assertTrue($img);
        /*$response = $this->get('/');
        $response->assertStatus(200);*/
    }
}

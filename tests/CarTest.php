<?php 

use \PHPUnit\Framework\TestCase;

class CarTest extends TestCase 
{
    protected $client;

    protected function setUp():void {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost:8080'
        ]);
    }

    public function tearDown():void {
        $this->client = null;
    }

    public function testGetSingleCar() {

        $response = $this->client->get('/api/car', [
            'query' => [
                'id' => 1
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertArrayHasKey('id', $data['car'][0]);
    }
}

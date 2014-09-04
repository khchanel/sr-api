<?php

class GpsTest extends TestCase
{

    private $gpsData = array (
        0 => array (
            'BusinessName' => 'David Saad',
            'Did' => 'imei:359710042455312',
            'Id' => 1,
            'Latitude' => -33.938123333333003,
            'Longitude' => 151.15351833333,
            'SubjectCode' => 148,
            'SubjectType' => 1,
            'Time' => '/Date(1409810428350+1000)/',
        ),
        1 => array (
            'BusinessName' => 'Zaya Tiary',
            'Did' => 'imei:359710042419300',
            'Id' => 4,
            'Latitude' => -33.956874999999997,
            'Longitude' => 151.22027666667,
            'SubjectCode' => 19,
            'SubjectType' => 1,
            'Time' => '/Date(1409810478420+1000)/',
        ));


    public function testGpsAll()
    {
        // mock
        $mock = Mockery::mock('GpsStreamRepo[all]'); // partial mock
        $mock->shouldReceive('all')->once()->andReturn($this->gpsData);
        $this->app->instance('IGpsRepo', $mock); // Dependency Injection

        // make request
        $response = $this->call('GET', '/api/v1/gps');

        // verify
        $this->assertTrue($response->isOk());

        $x = json_decode($response->getContent(), $assoc = TRUE);
        $this->assertNotNull($x, $message = 'invalid json data');
        $this->assertTrue($x[1] === $this->gpsData[1], $message = 'Response data incorrect');
    }

    public function testGpsGet()
    {
        // mock
        $mock = Mockery::mock('GpsStreamRepo[get]'); // partial mock
        $mock->shouldReceive('get')->with('4')->once()->andReturn($this->gpsData[1]);
        $this->app->instance('IGpsRepo', $mock); // Dependency Injection

        // make request
        $response = $this->call('GET', '/api/v1/gps/4');

        // verify
        $this->assertTrue($response->isOk());

        $x = json_decode($response->getContent(), $assoc = TRUE);
        $this->assertNotNull($x, $message = 'invalid json data');
        $this->assertTrue($x === $this->gpsData[1], $message = 'Response data incorrect');
    }
}

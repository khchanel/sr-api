<?php

class LocationTest extends TestCase {

    public function testLocationAll()
    {
        $response = $this->call('GET', '/api/v1/location');

        $this->assertTrue($response->isOk());

        $x = json_decode($response->getContent(), $assoc = TRUE);
        $this->assertNotNull($x, $message = 'invalid json data');
    }
}

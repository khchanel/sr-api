<?php

class SorTest extends TestCase {

    private $sorData = array(
            0 => array('SORCode' => 'MIN18350','TradeCode' => '','UomCode' => 'm.','Name' => '(Renew strip flooring up to 6 metres)','LongDescription' => 'Remove and dispose of existing and supply and fix strip flooring up to 6 metres.  Hardwood/Cypress up to 100mm wide.  Staggered joints - Each room.','Status' => 'False','Price201213' => '9.999999999','Price' => '9.999999999','Warranty' => '0','Manual' => '0','Deleted' => '0','Code' => '606','Location' => 'All,BED1 ,HALL, AIRL','Photo' => '~\\Files\\SOR\\1c8dbe4709ae44a388f6dee379a8f0bc.jpg'),
            1 => array('SORCode' => 'MIN18400','TradeCode' => '','UomCode' => 'm2.','Name' => '(Renew Cyprus flooring over 6.0lm ? additional to MIN18350)','LongDescription' => 'Remove and dispose of existing and supply and fix new Cypress flooring over 6 lineal metres per separate room in addition to MIN18350.  Nails to be punched and filled - Staggered joints. Cypress Pine.','Status' => 'False','Price201213' => '9.999999999','Price' => '9.999999999','Warranty' => '0','Manual' => '0','Deleted' => '0','Code' => '607','Location' => 'AIRL','Photo' => ''),
            2 => array('SORCode' => 'MIN18450','TradeCode' => '','UomCode' => 'm2.','Name' => '(Renew hardwood flooring over 6.0lm - additional to MIN18400  MIN18350)','LongDescription' => 'Remove and dispose of existing and supply and fix new hardwood flooring over 6 lineal metres per separate room/deck in addition to MIN18400 MIN18350. Nails to be punched and filled ? staggered joints. Hardwood.','Status' => 'False','Price201213' => '9.999999999','Price' => '9.999999999','Warranty' => '0','Manual' => '0','Deleted' => '0','Code' => '608','Location' => '','Photo' => ''),
        );


    /**
     * Test GET /sor/{code}
     */
    public function testSorByCode()
    {
        // init
        $data = $this->sorData[1];
        $code = 'MIN18400';  // $data['Code'];

        // mock
        $mock = Mockery::mock('SorEloquentRepo'); // partial mock
        $mock->shouldReceive('get')->with($code)->once()->andReturn($data);
        $this->app->instance('ISorRepo', $mock); // Dependency Injection

        // make request
        $response = $this->call('GET', "/api/v1/sor/$code");

        // verify
        $this->assertTrue($response->isOk(), $message='Not OK');

        $x = json_decode($response->getContent(), $assoc = TRUE);
        $this->assertNotNull($x, $message = 'Response is not JSON');
        $this->assertTrue($x === $data, $message = 'Response data incorrect');
        $this->assertTrue($x['Code'] === $data['Code'], $message = 'Response data incorrect (Code)');

    }
}

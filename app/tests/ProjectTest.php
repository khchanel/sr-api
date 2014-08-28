<?php

class ProjectTest extends TestCase {

    private $projectData = array (
            0 => array(
                'Address' => '7/25 Mi Mi Street, OATLEY, NSW, 2223',
                'Client' => 'St George Community Housing',
                'ClientRef' => '0043885',
                'Code' => 71191,
                'ContractorRef' => NULL,
                'Coordinator' => 'Adris Frety',
                'Duration' => NULL,
                'Finish' => '28/08/2014',
                'FinishDate' => NULL,
                'Instructions' => 'After hours emergency: Ceiling leak',
                'MasterCode' => NULL,
                'SLA' => NULL,
                'Start' => '28/08/2014',
                'StartDate' => NULL,
                'Status' => 'New',
                'SubClient' => NULL,
                'TaskType' => NULL,
            ),
            1 => array(
                'Address' => '28-30 Low Street, HURSTVILLE, NSW, 2220',
                'Client' => 'St George Community Housing',
                'ClientRef' => '0043787',
                'Code' => 71008,
                'ContractorRef' => NULL,
                'Coordinator' => 'Adris Frety',
                'Duration' => NULL,
                'Finish' => '09/09/2014',
                'FinishDate' => NULL,
                'Instructions' => 'Bin bay area - Clean up',
                'MasterCode' => NULL,
                'SLA' => NULL,
                'Start' => '26/08/2014',
                'StartDate' => NULL,
                'Status' => 'New',
                'SubClient' => NULL,
                'TaskType' => NULL,
            ),
            2 => array(
                'Address' => '93-99 Lane Street, WENTWORTHVILLE, NSW, 2145',
                'Client' => 'Evolve Housing',
                'ClientRef' => 'RN 16538',
                'Code' => 71281,
                'ContractorRef' => NULL,
                'Coordinator' => 'Reta Wardi',
                'Duration' => NULL,
                'Finish' => '28/08/2014',
                'FinishDate' => NULL,
                'Instructions' => 'E1 TAP RN 16538',
                'MasterCode' => NULL,
                'SLA' => NULL,
                'Start' => '28/08/2014',
                'StartDate' => NULL,
                'Status' => 'New',
                'SubClient' => NULL,
                'TaskType' => NULL,
            )
        );


    public function testProjectWithoutCredentials()
    {
        $response = $this->call('GET', '/api/v1/project');

        $this->assertTrue($response->getStatusCode() === 401);  // http 401 unauthorized
    }


    public function testProjectWithOnlyUser()
    {
        $response = $this->call('GET', '/api/v1/project?user=x');

        $this->assertTrue($response->getStatusCode() === 401);  // http 401 unauthorized
    }


    public function testProjectWithOnlyPassword()
    {
        $response = $this->call('GET', '/api/v1/project?passwd=x');

        $this->assertTrue($response->getStatusCode() === 401);  // http 401 unauthorized
    }


    public function testProjectSuccess()
    {
        // init
        $data = array($this->projectData[0], $this->projectData[1]);

        // mock IProjectRepo
        $mock = Mockery::mock('ProjectStreamRepo[getByCoordinator]'); // partial mock
        $mock->shouldReceive('getByCoordinator')->with('Adris')->once()->andReturn($data);
        $this->app->instance('IProjectRepo', $mock); // Dependency Injection

        // make request
        $response = $this->call('GET', '/api/v1/project?user=Adris&passwd=y');

        // verify status ok
        $this->assertTrue($response->isOk(), $message = 'Cannot access the project api route');

        // verify data
        $x = json_decode($response->getContent());
        $this->assertNotNull($x, $message = 'Response is not JSON');
        $this->assertTrue(sizeof($x) === sizeof($data), $message = 'Response data incorrect');
    }


    public function testProjectAll()
    {
        // mock IProjectRepo
        $mock = Mockery::mock('ProjectStreamRepo[all,getByCoordinator]'); // partial mock
        $mock->shouldReceive('all')->once()->andReturn($this->projectData);
        $mock->shouldReceive('getByCoordinator')->never();
        $this->app->instance('IProjectRepo', $mock); // Dependency Injection

        // make request
        $response = $this->call('GET', '/api/v1/project?user=x&passwd=y&all=1');

        // verify status ok
        $this->assertTrue($response->isOk(), $message = 'Cannot access the project api route');

        // verify data
        $x = json_decode($response->getContent(), $assoc = TRUE);
        $this->assertNotNull($x, $message = 'Response is not JSON');
        $this->assertTrue(sizeof($x) === sizeof($this->projectData), $message = 'Response data incorrect');
    }


    public function testProjectByCode()
    {
        // init
        $code = 71008; //$this->projectData[1]['Code'];

        // mock IProjectRepo
        $mock = Mockery::mock('ProjectStreamRepo[get]'); // partial mock
        $mock->shouldReceive('get')->with($code)->once()->andReturn($this->projectData[1]);
        $this->app->instance('IProjectRepo', $mock); // Dependency Injection

        // make request
        $response = $this->call('GET', '/api/v1/project/' . $code . '?user=x&passwd=y');

        // verify data
        $x = json_decode($response->getContent(), $assoc = TRUE);
        $this->assertNotNull($x, $message = 'Response is not JSON');
        $this->assertTrue($x === $this->projectData[1], $message = 'Response data incorrect');
        $this->assertTrue($x['Code'] === $this->projectData[1]['Code'], $message = 'Response data incorrect (Code)');
    }

}

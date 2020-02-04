<?php

namespace Tests\Feature;

use App\Domain\ElevatorRequest;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    /**
     * Transform Secuence into request
     *
     * @return void
     */
    public function testGEt()
    {
        $this->withoutExceptionHandling();

        $response = $this->put('/api/employees');

        $response->assertStatus(200);
    }

}

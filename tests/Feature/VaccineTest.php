<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VaccineTest extends TestCase
{
    /**
     * Test Application route.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * Test vaccine create  route.
     */
    public function test_the_register_a_successful_response(): void
    {
        $response = $this->get('/vaccine/create');

        $response->assertStatus(200);
    }

    /**
     * Test vaccine search screen  route.
     */
    public function test_the_search_a_successful_response(): void
    {
        $response = $this->get('/vaccine');

        $response->assertStatus(200);
    }
}

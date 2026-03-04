<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoadingTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function website_loading_test(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

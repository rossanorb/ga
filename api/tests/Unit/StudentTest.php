<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
{
    public function testCreateStudent()
    {
        $data = factory(\App\Student::class)->make()->toArray();
        $response = $this->json('POST', 'api/students', $data);
        $response->assertStatus(201)->assertJson($data);
    }
}

<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentTest extends TestCase
{
    public function testCreateStudent()
    {
        // cria um aluno
        $data = factory(\App\Student::class)->make()->toArray();

        // template de resposta da api
        $param = [
            'status' => true,
            'result' =>  $data,
            'errors' => []
        ];

        // envia
        $response = $this->json('POST', 'api/students', $data);

        // compara http status code e json
        $response->assertStatus(201)->assertJson($param);
    }
}

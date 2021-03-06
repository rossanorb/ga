<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Student;

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

        Student::truncate();
    }

    public function testValidationStudent()
    {
        // cria um aluno
        $data = factory(\App\Student::class)->make()->toArray();
        // exclui campo name
        $data = array_except($data, ['name']);
        $response = $this->json('POST', 'api/students', $data);
        // espera erro 422 - validação
        $response->assertStatus(422);
        Student::truncate();
    }

    public function testUpdateStudent()
    {
        $student = factory(\App\Student::class)->create();
        $student->email =  'email_updated@dominio.com.br';
        $param = [
            'status' => true,
            'result' =>  $student->toArray(),
            'errors' => []
        ];
        $toUpdate = ['email' => 'email_updated@dominio.com.br'];
        $response = $this->json('PUT', '/api/students/'.$student->id, $toUpdate);
        $response->assertStatus(201)->assertJson($param);

        Student::truncate();
    }

    public function testDeleteStutend()
    {
        $student = factory(\App\Student::class)->create();
        $response = $this->json('DELETE', '/api/students/'.$student->id);
        $response->assertStatus(204);
    }
}

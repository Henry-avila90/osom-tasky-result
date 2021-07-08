<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LeadsTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * Prueba del API endpoint para guardar los lead
     *
     * 1. Enviar la información de lead a /api/lead
     * 2. Assert que la respuesta es OK
     * 3. Assert que el contenido de la respuesta json es:
     * 4. Assert que en la tabla de leads exista un registro con la información correspondiente
     *
     * @return void
     */
    public function testLeadSaving()
    {
        $data=[
            "name" => "prueba",
            "email"=>"email@gmail.com",
            "phone"=>"3214569874"
        ];
        $response = $this->post('/api/lead', $data);

        $response->assertStatus(200);

        $response->assertJson(
        [
            'message'=>"tus datos se han enviado correctamente.",
            'data'=>$data
        ]);

        $this->assertDatabaseHas('leads',[
            'name'=> 'prueba',
            'email'=>'email@gmail.com',
            'phone'=>'3214569874'
        ]);
        $response->assertOk();
    }
}

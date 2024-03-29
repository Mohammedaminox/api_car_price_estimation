<?php

namespace Tests\Unit;

use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */


    use RefreshDatabase;

    public function testShowCars()
    {

        $car = Car::create([
            'marque' => 'Toyota',
            'modele' => 'Camry',
            'annee' => 2023,
            'kilometrage' => 10000,
            'prix' => 20000,
            'puissance' => 150,
            'motorisation' => 'Essence',
            'carburant' => 'Essence',
            'options' => 'options',
        ]);


        $response = $this->getJson('/api/cars');
        $response->assertStatus(200);
        $cars = Car::all();
        $this->assertNotEmpty($cars);
    }

    public function testEstimationPrix()
    {
        $data = [
            'marque' => 'Toyota',
            'modele' => 'Corolla',
            'kilometrage' => 100000,
            'date_mise_en_circulation' => '2018-01-01',
            'puissance' => 150,
            'carburant' => 'Essence',
            'motorisation' => 'Automatique',
            'options' => 'Climatisation, GPS',
        ];

        $response = $this->json('POST', '/api/estimatePrice', $data);

        $response->assertStatus(200);

        $response->assertJsonStructure(['price_estime']);
    }
}

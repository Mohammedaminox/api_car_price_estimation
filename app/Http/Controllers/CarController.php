<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $car = Car::all();
        return response()->json($car);
    }

    public function estimatePrice(Request $request)
    {
        $request->validate([
            'marque' => 'required|string',
            'modele' => 'required|string',
            'kilometrage' => 'required|numeric',
            'date_mise_en_circulation' => 'required|date',
            'puissance' => 'required|numeric',
            'carburant' => 'required|string',
            'motorisation' => 'required|string',
            'options'=>'required',
        ]);

        $priceEstime = Car::where('marque', $request->marque)
            ->where('modele', $request->modele)
            ->avg('prix');

        return response()->json(['price_estime' => $priceEstime]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendedorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function salvar(Request $request) {
        $vendedores = (array) $request -> all();

        $dataSet = [];
        foreach ($vendedores as $vendedor) {

            $dataSet[] = [
                'nome' => is_null($vendedor['nome']) ? $vendedor['nome'] : null,
                'esquerdo' => is_null($vendedor['esquerdo']) ? $vendedor['esquerdo'] : null,
                'direito' => is_null($vendedor['direito']) ? $vendedor['direito'] : null
            ];
        }

        DB::table('vendedor')->insert($dataSet);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: hugo_
 * Date: 26/02/2019
 * Time: 00:27
 */

namespace App\Http\Controllers;


use App\Http\Template\RedeTemplate;
use App\ValueObject\Arvore;
use App\Vendedor;

class RedeController extends Controller
{
    protected $valorEsquerdo = 0;
    protected $valorDireito = 0;

    public function criarArvore() {

        $vendedor = Vendedor::where('id', 1)->first();

        $arvore = new Arvore();

        $arvore -> vendedor = $vendedor['id'];

        if(!is_null($vendedor['esquerdo'])) {
            $arvore -> esquerdo = $this->buscaEsquerdo($vendedor['esquerdo']);
        }

        if(!is_null($vendedor['direito'])) {
            $arvore -> direito = $this->buscaDireito($vendedor['direito']);
        }

        if(!is_null($arvore -> esquerdo)) {
            $arvore -> totalEsquerdo = $this->somaEsquerdo($arvore -> esquerdo);
        }

        $this->valorEsquerdo = 0;

        if(!is_null($arvore -> direito)) {
            $arvore -> totalDireito = $this->somaDireito($arvore -> direito);
        }

        $redeTemplate = new RedeTemplate();

        return $redeTemplate->gerarHtml($arvore);
    }

    public function buscaEsquerdo($id) {
        $vendedor = Vendedor::where('id', $id)->first();

        $arvore = new Arvore();

        $arvore -> vendedor = $id;

        if(!is_null($vendedor['esquerdo'])) {
            $arvore -> esquerdo = $this->buscaEsquerdo($vendedor['esquerdo']);
        }

        if(!is_null($vendedor['direito'])) {
            $arvore -> direito = $this->buscaDireito($vendedor['direito']);
        }

        return $arvore;
    }

    public function buscaDireito($id) {
        $vendedor = Vendedor::where('id', $id)->first();

        $arvore = new Arvore();

        $arvore -> vendedor = $id;

        if(!is_null($vendedor['esquerdo'])) {
            $arvore -> esquerdo = $this->buscaEsquerdo($vendedor['esquerdo']);
        }

        if(!is_null($vendedor['direito'])) {
            $arvore -> direito = $this->buscaDireito($vendedor['direito']);
        }

        return $arvore;
    }

    protected function somaEsquerdo($arvore) {

        $this->valorEsquerdo += 500;
        $arvore -> totalEsquerdo = 500;

        if(!is_null($arvore -> esquerdo)) {
            $this->somaEsquerdo($arvore->esquerdo);
        }
        if(!is_null($arvore -> direito)) {
            $arvore -> totalDireito = 500;
            $this -> valorEsquerdo += $this->somaDireito($arvore -> direito);
        }

        return $this->valorEsquerdo;
    }

    protected function somaDireito($arvore) {

        $this -> valorDireito += 500;
        $arvore->totalDireito = 500;

        if(!is_null($arvore -> direito)){
            $this->somaDireito($arvore -> direito);
        }

        if(!is_null($arvore -> esquerdo)) {
            $arvore -> totalEsquerdo = 500;
            $this->valorDireito += $this->somaEsquerdo($arvore -> esquerdo);
        }

        return $this->valorDireito;
    }

    public function gerar($arvore) {
        require_once __DIR__ . '/vendor/autoload.php';

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML('<h1>Hello world!</h1>');
        $mpdf->Output();
    }
}
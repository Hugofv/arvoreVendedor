<?php
/**
 * Created by PhpStorm.
 * User: hugo_
 * Date: 26/02/2019
 * Time: 09:55
 */

namespace App\ValueObject;


class Arvore
{
    public $vendedor;
    public $esquerdo;
    public $direito;
    public $totalEsquerdo = 0;
    public $totalDireito = 0;
}
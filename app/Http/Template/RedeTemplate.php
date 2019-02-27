<?php
/**
 * Created by PhpStorm.
 * User: hugo_
 * Date: 26/02/2019
 * Time: 13:40
 */

namespace App\Http\Template;


class RedeTemplate
{

    protected $arrayEsquedo = array();

    public function gerarHtml($arvore) {
        $this->gerarArray($arvore->esquerdo, $arvore->direito);
        $html = '
                    <table>
                    <tr>
                        <th colspan="2">Pts perna esquerda do vendedor '.$arvore->vendedor.'</th>
                        <th colspan="2">Pts perna direita do vendedor '.$arvore->vendedor.'</th>
                    </tr>
                ';

        foreach ($this->arrayEsquedo as $linha) {
            $html .= '<tr>';
            $html .= "<td>{$linha->nome}</td>";
            $html .= "<td>{$linha->pontos}</td>";
            $html .= '</tr>';
        }

        $html .= '</table>';

    return $html;
    }

    public function gerarArray($arvoreEsquerdo, $arvoreDireito) {
        $objeto = new \stdClass();

        if(!is_null($arvoreEsquerdo -> esquerdo)) {
            $objeto->nomeEsquerdo = "Vendedor ".$arvoreEsquerdo->vendedor;
            $objeto->pontosEsquerdo = $arvoreEsquerdo->totalEsquerdo." pts";
        }


        if(!is_null($arvoreDireito -> direito)) {
            $objeto->nomeDireito = "Vendedor ".$arvoreDireito->vendedor;
            $objeto->pontosDireito = $arvoreDireito->totalDireito." pts";
        }

        array_push($this->arrayEsquedo, $objeto);

        if(!is_null($arvoreEsquerdo -> esquerdo) || !is_null($arvoreDireito -> direito)) {
            $this->gerarArrayEsquerdo($arvoreEsquerdo->esquerdo, $arvoreDireito -> direito);
        }
    }
}
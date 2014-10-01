<?php
/**
 * Created by PhpStorm.
 * User: franciscobarrento
 * Date: 01/10/14
 * Time: 15:37
 */

class Pagination {

    // Página actual
    public $currentPage = 1;   //Por defeito iniciamos o site na primeira página

    // Número Total de Páginas
    public  $totalPages;

    // Quantas Páginas Queremos Linkar no ínicio e no Fim
    public $boundaries;

    // Quantas páginas queremos linkar antes e depois da página actual
    public $around;

    // Array para guardar as páginas a serem renderizadas
    public $pages = [];

    // Variável para guardar o HTML gerado
    private $_html;


    /*
     * Definir o valor da página actual
     */
    public function setCurrentPage($currentPage)
    {
      $this->currentPage = $currentPage;
    }

    /*
     * Devolve o valor da página actual
     */
    public function getCurrentPage()
    {
       return $this->currentPage;
    }

    /*
     * Definir o valor do número total de páginas
     */
    public function setTotalPages($totalPages)
    {
        $this->totalPages = $totalPages;
    }

    /*
     * Devolve o número de páginas totais ou devolve falso se não estiver definido
     */
    public function getTotalPages()
    {
        if($this->totalPages) return $this->totalPages;
        return false;
    }

    /*
     * Define o número de paginas a renderizar no início e no fim
     */
    public function setBoundaries($boundaries)
    {
        $this->boundaries = $boundaries;
    }

    /*
     * Devolve o número de páginas a renderizar no início e no fim
     */
    public function getBoundaries()
    {
        if($this->boundaries) return $this->boundaries;
        return false;
    }

    /*
     * Define o número de páginas a renderizar antes e depois da página currente
     */
    public function setAround($around)
    {
        $this->around = $around;
    }

    /*
     * Devolve o número de páginas a renderizar antes e depois da página currente
     */
    public function getAround()
    {
        if($this->around) return $this->around;
    }

    /*
     * Guarda no array as páginas a serem renderizadas antes e depois da página currente e a página currente
     */
    private function setAroundPages()
    {
        $current = $this->currentPage;

        $begin = $current - $this->around;

        if(($current + $this->around) > $this->totalPages) {
            $end = $this->totalPages;
        } else {
            $end = $current + $this->around;
        }

        

        for($i = $begin; $i <= $end; $i++){
            $this->pages[$i] = $i;

        }

    }

    /*
     * Guarda no array as páginas a serem renderizadas no inicício o no fim
     */
    private function setBoundariesPages()
    {
        $last = $this->totalPages;
        $lastBoundary = $last - $this->boundaries + 1;
        $first = 1;
        $firstBoundary = $this->boundaries;

        for($i= $lastBoundary; $i <= $last; $i++) {
            $this->pages[$i] = $i;
        }

        for($i= $first; $i <= $firstBoundary; $i++) {
            $this->pages[$i] = $i;
        }
    }

    /*
     * Devolve o array com as páginas
     */
    private function getPages()
    {
        self::setBoundariesPages();
        self::setAroundPages();
        asort($this->pages);
    }

    /*
     * Gera os Links para a paginação
     */
    private function createlink($page)
    {
        $linkPage = $page;
        $totalPages = $this->totalPages;
        $boundaries = $this->boundaries;
        $around = $this->around;

        $class='';
        if($page==$this->currentPage) $class=' class="active" ';
        

        return '<li '.$class.'><a href="index.php?p='.$linkPage.'&tp='.$totalPages.'&b='.$boundaries.'&a='.$around.'">'.$linkPage.'</a> </li>';
    }

    /*
     * Rederiza a paginação
     */
    public function render()
    {
        self::getPages();
        $html = '';
        $pages = $this->pages;
        foreach($pages as $page){
            if($page >= 1 && $page <= end($pages))
            $html.= self::createlink($page);
            if(!array_key_exists($page+1, $pages) && $page+1 < end($pages)) $html.= ' <li><a href="#">...</a></li> ';
        }

        echo $html;

    }

}
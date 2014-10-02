<?php
/**
 * Pagination class file
 * 
 * @author Francisco Barrento <me@francisco.barrento.com>
 * @copyright 2014 Francisco Barrento
 * @license http://opensource.org/licenses/GPL-3.0
 */

/**
 * Pagination represents information relevant to pagination
 *
 * When data need to be rendered in multiple pages we can use Pagination 
 * represent information such as {@link getTotalPages total pages count}.
 * These information can be passed to {@link render pagers} ro render
 * pagination links.
 *
 * @since 1.0
 *
 * @todo  Comment the sets and gets for the itemTagName and itemHtmlOptions
 *
 * 
 */
class Pagination {

    /**
     * The current page
     * @var integer
     * Defaults to 1, meaning that if no current page is defined the fisrt page will be the active page 
     */
    public $currentPage = 1;   //Por defeito iniciamos o site na primeira página
    /**
     * The total number os pages to be sorted
     * @var integer
     */
    public  $totalPages;
    /**
     * The number of links in the begining and in the end of the pagination
     * @var integer
     */
    public $boundaries; 
    /**
     * The number of links in the right and in the left of the current page
     * @var integer
     */
    public $around;
    /**
     * Array with the pages
     * @var array 
     */
    public $pages = [];
    /**
     * The HTML tag for the pagination items
     * @var string
     * Defaults to <li>;
     */
    public $itemTagName = '<li>';
    /**
     * The HTML item options
     * @var array
     */
    public $itemHtmlOptions = ['class' => 'pagination-item'];
    /**
     * The page separator string when there's a gap in the pagination.
     * @var string
     * Defaults to ...
     */
    public $separator = '...';
    /**
     * The html
     * @var string
     */
    private $_html;


    /**
     * @param integer $currentPage the index of the current page.
     */
    public function setCurrentPage($currentPage)
    {
      $this->currentPage = $currentPage;
    }

    /**
     * @return integer the index of the current page.
     */
    public function getCurrentPage()
    {
       return $this->currentPage;
    }

    /**
     * @param integer $totalPages total number of pages.
     */
    public function setTotalPages($totalPages)
    {
        $this->totalPages = $totalPages;
    }

    /**
     * @return integer the number of pages.
     */
    public function getTotalPages()
    {
        if($this->totalPages) return $this->totalPages;
        return false;
    }

    /**
     * @param integer $boundaries number of pages in the begining and in the end of the pagination including the first and the last.
     */
    public function setBoundaries($boundaries)
    {
        $this->boundaries = $boundaries;
    }

    /**
     * @return integer the number of pages at the begining and in the end of the pagination.
     */
    public function getBoundaries()
    {
        if($this->boundaries) return $this->boundaries;
        return false;
    }

    /**
     * @param integer $around number of pages before and after the current page.
     */
    public function setAround($around)
    {
        $this->around = $around;
    }

    /**
     * @param integer number of pages before and after the current page.
     */
    public function getAround()
    {
        if($this->around) return $this->around;
        return false;
    }

    /**
     * @param string $sepator string to separate the gaps in the pagination
     */
    public function setSeparator($sepator)
    {
      $this->separator = $sepator;
    }

    /**
     * @param string to separate the gaps in the pagination
     */
    public function getSeparator()
    {
      if($this->separator) return $this->separator;
      return false;
    }

    public function setItemTagName($itemTagName)
    {
      $this->itemTagName = $itemTagName;
    }

    public function getItemTagName()
    {
      if($this->itemTagName) return $this->itemTagName;
      return false;
    }

    public function setItemHtmlOptions($htmlOptions = [])
    {
      $this->itemHtmlOptions = $htmlOptions;
    }

    public function getItemHtmlOptions()
    {
      if($this->itemHtmlOptions) return $this->itemHtmlOptions;
      return false;
    }



    /**
     * Populate the pages array with the pages before and after the current page
     * Populate the pages array with the current page
     */
    private function setAroundPages()
    {

        if(($this->currentPage + $this->around) > $this->totalPages) {
            $end = $this->totalPages;
        } else {
            $end = $this->currentPage + $this->around;
        }
        for($i = ($this->currentPage - $this->around); $i <= $end; $i++){
            $this->pages[$i] = $i;
        }

    }

    /**
     * Populate the pages array with the pages in the beginig and in the end of the pagination.
     */
    private function setBoundariesPages()
    {

        for($i = ($this->totalPages - $this->boundaries + 1); $i <= $this->totalPages; $i++) {
            $this->pages[$i] = $i;
        }

        for($i = 1; $i <= $this->boundaries; $i++) {
            $this->pages[$i] = $i;
        }
    }

    private static function createUrl($parameters = [])
    {

      //We have to get the page
      $url = 'index.php?';
      foreach ($parameters as $key => $value) {
        $url .= $key .'=' . $value .'&';
      }
      return $url;

    }

    /**
     * Creates the link to a particular page
     * @param  [type] $page [description]
     * @return string       the html of a pagination link
     */
    private function createPaginationItem($page)
    {
        $parameters = [
                        'p' => $page,
                        'tp' => $this->totalPages,
                        'b' => $this->boundaries,
                        'a' => $this->around
        ];

        if($page==$this->currentPage) 
        $this->itemHtmlOptions['class'] .= ' active ';
          else  $this->itemHtmlOptions['class'] = str_replace(' active ', '', $this->itemHtmlOptions['class']);

        $paginationItem = '';
        $paginationItem .= html::openTag(html::removeBrackets($this->itemTagName), $this->itemHtmlOptions );
        $paginationItem .=  html::link($page, self::createUrl($parameters));
        $paginationItem .= html::closeTag(html::removeBrackets($this->itemTagName));

        return  $paginationItem;
    }

    /**
     * Generates the html for the pagination 
     * @return string the html of the <li> elements to include in the pagination
     */
    public function render()
    {
        
        $pagination = '';
        self::setBoundariesPages();
        self::setAroundPages();
        asort($this->pages);
        
        $pagination = html::openTag('nav', ['class'=>'ink-navigation']);
        $pagination .= html::openTag('ul', ['class'=>'pagination black']);

        foreach($this->pages as $page){
            if($page >= 1 && $page <= end($this->pages))
                $pagination.= self::createPaginationItem($page);
            if(!array_key_exists($page+1, $this->pages) && $page+1 < end($this->pages)) {
                $pagination .= html::openTag(html::removeBrackets($this->itemTagName), $this->itemHtmlOptions );
                $pagination .=  html::link($this->separator);
                $pagination .= html::closeTag(html::removeBrackets($this->itemTagName));
            }
        }
        $pagination .= html::closeTag('ul');
        $pagination .= html::closeTag('nav');
        return $pagination;

    }

}
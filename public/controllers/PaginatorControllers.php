<?

class PaginatorControllers {

    public int $curentPage, $limit, $firstPage, $lastPage, $backPage, $nextPage, $countPages;
    public array $pages;
    public string $link;


    public function __construct($curentPage, $limit, $link)
    {
        $this->curentPage = $curentPage;
        $this->limit = $limit;
        $this->link = $link;
    }

    public function pagination() : array{        
        
        $pages = ['back'=>$this->backPage,
                    'next'=>$this->nextPage,
                    'pages'=> $this->pages,
                    'firstPage'=>$this->firstPage,
                    'lastPage'=>$this->lastPage,
                    'link'=>$this->link,
        ];

        return $pages;

    }
    /**
     * Получим общее количество записей в базе данных и пересчитаем в количество страниц
     */
    public function setCount($count) : void{

        $arr = [];
        
        $countPages = ($count/$this->limit)>1 ? $count/$this->limit : 1;
        $this->countPages = ceil($countPages);
        for($i = 1;  $i <= ceil($countPages); $i++ ){
            $arr[]=$i;
        }
        $this->pages = $arr;
        $this->setFirstPage();
        $this->setLastPage();
        $this->setNextPage();
        $this->setBackPage();
    }
    /**
     * произведем расчеты с какого значеня выводить данные из таблицы
     */
    public function getOffset() :int
    {

        $offset = ($this->curentPage ==1) ? 0 : $this->curentPage * $this->limit - $this->limit;

        return $offset;
    }

    private function setFirstPage() :void
    {
        $this->firstPage = 1;
    }

    private function setLastPage() :void
    {
        $this->lastPage = $this->countPages;
    }

    private function setNextPage() :void
    {
        $this->nextPage = ($this->curentPage  + 1) > $this->countPages ? $this->curentPage : $this->curentPage  + 1;
    }

    private function setBackPage() :void
    {
        $this->backPage = ($this->curentPage  - 1) <= 0 ? $this->curentPage : $this->curentPage  - 1;
    }


}
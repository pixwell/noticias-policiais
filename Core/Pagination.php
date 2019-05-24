<?php
namespace Core;

class Pagination
{
    private $currentPage;
    private $postPerPage = 5;
    private $totalRecords;
    
    public function setCurrentPage($currentPage = null) {
        $this->currentPage = isset($currentPage) ? $currentPage : 1;
        return $this;
    }
    
    public function setPostPerPage($postPerPage = null) {
        $this->postPerPage = $postPerPage;
        return $this;
    }
    
    public function getPostPerPage() {
        return $this->postPerPage;
    }
    
    public function setTotalRecords($totalRecords) {
        $this->totalRecords = $totalRecords;
        return $this;
    }
    
    public function limitStart()
    {
        //Verificacao para o caso de o usuario inserir na URL um numero maior que o total de links
        if( $this->currentPage > $this->totalPaginationLinks() ){
            $this->currentPage = $this->totalPaginationLinks();
        }
        return ($this->currentPage * $this->postPerPage) - $this->postPerPage;
    }
    
    public function totalPaginationLinks()
    {
        return ceil($this->totalRecords / $this->postPerPage);
    }
        
    public function paginationLinks()
    {
        $navHtml = '';
        if( $this->totalPaginationLinks() > 1){
            $navHtml = '<ul class="pagination">';
            for ($i = 1; $i <= $this->totalPaginationLinks(); $i++){
                if( $this->currentPage == $i ){
                    $class = 'page-item active';
                } else {
                    $class = 'page-item';
                }
                
                $navHtml .= '<li class="' . $class . '"><a href="?page=' . $i . '" class="page-link">' . $i . "</a></li>\n";
            }            
            $navHtml .= "</ul>\n";
        }
        return $navHtml;
    }   
}

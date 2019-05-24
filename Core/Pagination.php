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
        return ($this->currentPage * $this->postPerPage) - $this->postPerPage;
    }
        
    public function paginationLinks()
    {
        return '###Paginação###';
    }
    
//    public function paginationLinks($pages = '', $range = 4);
//    {
//        $showitems = ($range * 2)+1;        
//        $paged = $this->currentPage;
//        
//        if( empty($paged) ) {
//            $paged = 1;
//        }
//        
//        if($pages == ''){
//            $pages = $this->postPerPage;
//            if(!$pages){
//                $pages = 1;
//            }
//        }
//        
//        $navHtml = '';        
//        if(1 != $pages){
//            $navHtml = '<ul class="pagination">';
//            if($paged > 2 && $paged > $range+1 && $showitems < $pages){
//                $navHtml .= ' <li class="page-item active"><a href="?page='.($paged - 1).'" class="page-link">&laquo;</a></li>';
//            }
//            if($paged > 6 && $showitems < $pages){
//                $navHtml .= ' <li class="page-item"><a href="?page=1" class="page-link">1</a></li>';
//            }
//            for ($i=1; $i <= $pages; $i++){
//                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
//                    $navHtml .= ($paged == $i)? '<li class="page-item active"> <a class="page-link" href="#">' . $i . '</a></li>' : ' <li class="page-item"><a href="?page=' . $i . '" class="page-link">' . $i . '</a></li>';
//                }
//            }
//            if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) {
//                $navHtml .= '<li class="page-item"><a href="?page=' . $pages . '" class="page-link"> ... ' . $pages . '</a></li>';
//            }
//            if ($paged < $pages && $showitems < $pages) {
//                $navHtml .= '<li class="page-item  active"><a href="?page=' . ($paged + 1) . '" class="page-link">&raquo;</a></li>';
//            }
//            $navHtml .= "</ul>\n";
//        }
//        
//        return $navHtml;
//
//    }
//    
}

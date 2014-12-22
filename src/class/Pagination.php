<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pagination
 *
 * @author dev
 */
class Pagination {
    
    static function getPaging($page, $currentPage, $row, $pageSize) {
        $pages = ceil($row / $pageSize);
        
        $temp = '<ul class="pagination">';
        $temp .= '<li><a>หน้าที่</a></li>';
        $temp .= '<li><a href="' .$page. '.php?page=' .(($currentPage - 1) < 1 ? 1 : ($currentPage - 1)). '"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>';
        for ($i = 1; $i <= $pages; $i++) {
            $temp .= '<li><a href="' .$page. '.php?page=' .$i. '">' .$i. '</a></li>';
        }
        $temp .= '<li><a href="' .$page. '.php?page=' .(($currentPage + 1) > $pages ? $currentPage : ($currentPage + 1)). '"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>';
        $temp .= '</ul>';
        
        echo $temp;
    }
}

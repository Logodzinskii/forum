<?
    echo '<div class="container-pages"><div class="pages">';
    echo '<a href="?page='.$pages['pages']['firstPage'].'&'.$pages['pages']['link'].'" class="page">к первой</a>';
    echo '<a href="?page='.$pages['pages']['back'].'&'.$pages['pages']['link'].'" class="page"><</a>';
        foreach($pages['pages']['pages'] as $page){
            echo '<a href="?page='.$page.'&'.$pages['pages']['link'].'" class="page">'.$page.'</a>';
        } 
    echo '<a href="?page='.$pages['pages']['next'].'&'.$pages['pages']['link'].'" class="page">></a>';    
    echo '<a href="?page='.$pages['pages']['lastPage'].'&'.$pages['pages']['link'].'" class="page">к последней</a>';
    echo '</div></div>';

    
?>
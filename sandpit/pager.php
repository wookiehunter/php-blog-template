<nav aria-label="Page navigation example">
    <ul class="pagination pagination-blog justify-content-center">
        <?php
        for($i =1; $i <= $count; $i++) {


            if($i == $page) {
            
                echo "<li class='page-item' ><a class='page-link active_link' href='index.php?page={$i}'>{$i}</a></li>";
            
            
            }  else {
            
                echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";        
            
            
            }
            
            }
        ?>
    </ul>
</nav>
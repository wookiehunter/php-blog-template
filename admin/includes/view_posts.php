<?php
include("delete_modal.php");

if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $checkBoxValue ) {
        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options) {
            case 'Approved':
                $query = "UPDATE posts set post_status = '{$bulk_options}' WHERE post_id = '{$checkBoxValue}' ";
                $status_query = mysqli_query($connection,$query);
                break;
            case 'Rejected':
                $query = "UPDATE posts set post_status = '{$bulk_options}' WHERE post_id = '{$checkBoxValue}' ";
                $status_query = mysqli_query($connection,$query);
                break;
            case 'Draft':
                $query = "UPDATE posts set post_status = '{$bulk_options}' WHERE post_id = '{$checkBoxValue}' ";
                $status_query = mysqli_query($connection,$query);
                break;
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = '{$checkBoxValue}' ";
                $status_query = mysqli_query($connection,$query);
                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = '{$checkBoxValue}' ";
                $select_post_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_array($select_post_query)) {
                    $post_title         = $row['post_title'];
                    $post_category_id   = $row['post_category_id'];
                    $post_date          = $row['post_date'];
                    $post_author        = $row['post_author'];
                    $post_user        = $row['post_user'];
                    $post_status        = $row['post_status'];
                    $post_image         = $row['post_image'] ;
                    $post_tags          = $row['post_tags'];
                    $post_content       = $row['post_content'];

                    if (empty($post_title)) {
                        $post_title = "Mystery post....";
                    }

                    if (empty($post_tags)) {
                        $post_tags = "General";
                    }

                }
                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_user, post_date,post_image,post_content,post_tags,post_status) ";
                $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}', '{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}', '{$post_status}') ";
                $copy_query = mysqli_query($connection, $query);

                if(!$copy_query ) {

                    die("QUERY FAILED" . mysqli_error($connection));
                }
                break;
            case 'reset':
                $query = "UPDATE posts set post_views_count = 0 WHERE post_id = '{$checkBoxValue}' ";
                $reset_query = mysqli_query($connection, $query);

                if(!$reset_query ) {

                    die("QUERY FAILED" . mysqli_error($connection));
                }
                break;
        }
    }
}

?>

<form method="post" action="">

    <table class="table table-bordered table-hover">

    <div id="bulkOptionsContainer" class="col-xs-4">
    <select class="form-control" name="bulk_options" id="">

    <option value="">Select Options</option>
    <option value="Approved">Approved</option>
    <option value="Rejected">Rejected</option>
    <option value="Draft">Draft</option>
    <option value="delete">Delete</option>
    <option value="clone">Clone Post</option>
    <option value="reset">Reset View Count</option>

    </select>
    </div>

    <div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply" >
    <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
    </div>


    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <!-- <th></th>     -->
            <th>Id</th>    
            <th>User</th>    
            <th>Title</th>    
            <th>Category</th>    
            <th>Status</th>    
            <th>Image</th>    
            <th>Tags</th>    
            <th>Comments</th>    
            <th>Post Views</th>    
            <th>Date</th>    
            <th>Edit</th>    
            <th>Delete</th>    
        </tr>
    </thead>
    <tb>
        
        <?php 
            $query = "SELECT * FROM posts ORDER BY post_id DESC";
            $select_posts = mysqli_query($connection,$query);         
        
            while($row = mysqli_fetch_assoc($select_posts )) {
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_user = $row['post_user'];
                $post_title = $row['post_title'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_comment_count = $row['post_comment_count'];
                $post_views_count = $row['post_views_count'];
                $post_tags = $row['post_tags'];
                $post_status = $row['post_status'];
                $post_category_id = $row['post_category_id'];

                echo "<tr>";
                ?>
                <td><input type='checkbox' class='checkBoxes' name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
                <?php
                echo "<td>{$post_id}</td>";

                if (!empty($post_author)) {
                    echo "<td>{$post_author}</td>";
                } elseif (!empty($post_user)) {
                    echo "<td>{$post_user}</td>";
                }

                echo "<td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>";

                $query = "SELECT * FROM categories WHERE cat_id = $post_category_id ";
                $select_categories_id = mysqli_query($connection,$query);         

                while($row = mysqli_fetch_assoc($select_categories_id )) {
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
                }
                echo "<td>{$cat_title}</td>";

                echo "<td>{$post_status}</td>";
                echo "<td><img width='150px' src='../images/$post_image' alt='image' ></td>";
                echo "<td>{$post_tags}</td>";

                $query = "SELECT * FROM comments WHERE com_post_id = $post_id";
                $send_query = mysqli_query($connection, $query);
                
                $row = mysqli_fetch_array($send_query);
                $comment_count = mysqli_num_rows($send_query);

                if($comment_count > 0){
                    $comment_post_id = $row['com_post_id'];
                    echo "<td><a href='comments.php?id={$post_id}'>$comment_count</a></td>";
                } else {
                    echo "<td>$comment_count</td>";
                }
                
                echo "<td>{$post_views_count}</td>";
                echo "<td>{$post_date}</td>";
                echo "<td><a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>EDIT</a></td>";

                ?>
                <form action="" method="post">
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <?php

                    echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>';

                ?>
                    
                </form>
                <?php

                // echo "<td><a rel='$post_id' class='delete_link' href='javascript:void(0)' >DELETE</a></td>";
                // echo "</tr>";
        
            }   

        ?>

    </tb>
</table>

</form>

<?php 

if (isset($_POST['delete'])) {
    $post_id = $_POST['post_id'];

    $query = "DELETE FROM posts WHERE post_id = {$post_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");
}


?>

<script>
$(document).ready(function(){

    $(".delete_link").on('click', function(){
        var id = $(this).attr("rel");

        var delete_url = "posts.php?delete="+ id +" ";
        
        $(".modal_delete_link").attr("href", delete_url);
        
        $("#myModal").modal('show');
    });
});


</script>
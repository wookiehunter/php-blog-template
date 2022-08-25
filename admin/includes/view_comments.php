<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>    
            <th>Author</th>    
            <th>Comments</th>    
            <th>Email</th>    
            <th>Status</th>    
            <th>In Response To</th>
            <th>Date</th>  
            <th>Approved</th>    
            <th>Reject</th>    
            <th>Delete</th>    
        </tr>
    </thead>
    <tb>
        
        <?php 
            $query = "SELECT * FROM comments ORDER BY com_id DESC";
            $select_comments = mysqli_query($connection,$query);         
        
            while($row = mysqli_fetch_assoc($select_comments )) {
                $com_id = $row['com_id'];
                $com_author = $row['com_author'];
                $com_content = $row['com_content'];
                $com_email = $row['com_email'];
                $com_status = $row['com_status'];
                $com_post_id = $row['com_post_id'];
                $com_date = $row['com_date'];
                $com_author = $row['com_author'];
                $com_author = $row['com_author'];


                echo "<tr>";
                echo "<td>{$com_id}</td>";
                echo "<td>{$com_author}</td>";
                echo "<td>{$com_content}</td>";
                echo "<td>{$com_email}</td>";
                echo "<td>{$com_status}</td>";

                $query = "SELECT * FROM posts WHERE post_id = $com_post_id";
                $select_post_id_query = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($select_post_id_query)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];

                    echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                }

                echo "<td>{$com_date}</td>";

                echo "<td><a class='btn btn-success' href='comments.php?approve=$com_id'>APPROVE</a></td>";
                echo "<td><a class='btn btn-info' href='comments.php?reject=$com_id'>REJECT</a></td>";
                ?>
                <form action="" method="post">
                    <input type="hidden" name="com_id" value="<?php echo $com_id; ?>">
                <?php

                    echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>';

                ?>
                    
                </form>
                <?php

                // echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete?') \" href='comments.php?delete=$com_id'>DELETE</a></td>";

                echo "</tr>";
            }    

        ?>

    </tb>
</table>

<?php 

if (isset($_GET['approve'])) {
    $com_id = $_GET['approve'];

    $query = "UPDATE comments SET com_status = 'APPROVED' WHERE com_id = {$com_id}  ";
    $approve_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}

if (isset($_GET['reject'])) {
    $com_id = $_GET['reject'];

    $query = "UPDATE comments SET com_status = 'REJECTED' WHERE com_id = {$com_id} ";
    $reject_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}

if (isset($_POST['delete'])) {
    $com_id = $_POST['com_id'];

    $query = "DELETE FROM comments WHERE com_id = {$com_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: comments.php");
}


?>
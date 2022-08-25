    <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>    
            <th>Name</th>    
            <th>Firstname</th>    
            <th>Lastname</th>    
            <th>Email</th>    
            <th>Role</th>
            <th>Set Admin</th>    
            <th>Set Subscriber</th>    
            <th>Edit</th>    
            <th>Delete</th>    
        </tr>
    </thead>
    <tb>
        
        <?php 
            $query = "SELECT * FROM users ORDER BY u_id DESC ";
            $select_users = mysqli_query($connection,$query);         
        
            while($row = mysqli_fetch_assoc($select_users)) {
                $u_id = $row['u_id'];
                $u_name = $row['u_name'];
                $u_firstname = $row['u_firstname'];
                $u_lastname = $row['u_lastname'];
                $u_email = $row['u_email'];
                $u_image = $row['u_image'];
                $u_role = $row['u_role'];

                echo "<tr>";
                echo "<td>{$u_id}</td>";
                echo "<td>{$u_name}</td>";
                echo "<td>{$u_firstname}</td>";
                echo "<td>{$u_lastname}</td>";
                echo "<td>{$u_email}</td>";
                echo "<td>{$u_role}</td>";

                echo "<td><a class='btn btn-danger' href='users.php?change_to_admin={$u_id}'>ADMIN</a></td>";
                echo "<td><a class='btn btn-success' href='users.php?change_to_sub={$u_id}'>SUBSCRIBER</a></td>";
                echo "<td><a class='btn btn-info' href='users.php?source=edit_users&edit_users=$u_id'>EDIT</a></td>";

                ?>
                <form action="" method="post">
                    <input type="hidden" name="u_id" value="<?php echo $u_id; ?>">
                <?php

                    echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>';

                ?>
                    
                </form>
                <?php
                // echo "<td><a onClick=\" javascript: return confirm('Are you sure you want to delete?') \" href='users.php?delete=$u_id'>DELETE</a></td>";
                // echo "</tr>";
            }    

        ?>

        </tb>
    </table>




<?php 


if (isset($_GET['change_to_admin'])) {
    $u_id = $_GET['change_to_admin'];

    $query = "UPDATE users SET u_role = 'Admin' WHERE u_id = {$u_id} ";
    $admin_role_query = mysqli_query($connection, $query);
    header("Location: users.php");
}

if (isset($_GET['change_to_sub'])) {
    $u_id = $_GET['change_to_sub'];

    $query = "UPDATE users SET u_role = 'Subscriber' WHERE u_id = $u_id ";
    $sub_role_query = mysqli_query($connection, $query);
    header("Location: users.php");
}

if (isset($_POST['delete'])) {
    $u_id = $_POST['u_id'];

    $query = "DELETE FROM users WHERE u_id = {$u_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: users.php");
}

?>

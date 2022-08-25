<?php

function imagePlaceHolder($image = ''){
    if (!$image) {
        return 'image_1.jpg';
    } else {
        return $image;
    }
}

function confirmQuery($result) {
    global $connection;
    
    if (!$result) {
        die("Query Failed " . mysqli_error($connection));
    }
}

function display_categories() {
    global $connection;

    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection,$query);         

    while($row = mysqli_fetch_assoc($select_categories )) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];

        echo "<tr><td>{$cat_id}</td><td>{$cat_title}</td><td><a class='btn btn-danger' href='categories.php?delete={$cat_id}'>DELETE</a></td><td><a class='btn btn-info' href='categories.php?edit={$cat_id}'>EDIT</a></td></tr>";

    }

}

function insert_categories() {
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if ($cat_title === '' || empty($cat_title)) {
            echo "This field must be filled out";
        } else {
            $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUE(?)");

            mysqli_stmt_bind_param($stmt, 's', $cat_title);

            mysqli_stmt_execute($stmt);

            if (!$stmt) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        } mysqli_stmt_close($stmt);
    } 
}

function delete_category() {
    global $connection;

    if (isset($_GET['delete'])) {
        $cat_id_delete = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$cat_id_delete} ";

        $delete_query = mysqli_query($connection,$query);

        header("Location: categories.php");
    }
}

?>

<?php
function users_online() {

if (isset($_GET['onlineusers'])) {

    global $connection;

    if (!$connection) {
    session_start();

    include("../includes/db.php");

    $session = session_id();
    $time = time();
    $time_out_in_seconds = 60;
    $time_out = $time - $time_out_in_seconds;

    $query = "SELECT * FROM usersonline WHERE session = '$session'";
    $send_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query);

        if ($count == null) {
        mysqli_query($connection, "INSERT INTO usersonline(session, time) VALUES('$session', '$time')");
        } else {
        mysqli_query($connection, "UPDATE usersonline SET time = '$time' WHERE session = '$session'");
        }

    $usersonline = mysqli_query($connection, "SELECT * FROM usersonline WHERE time > '$time_out'");
    echo $count_user = mysqli_num_rows($usersonline);    

}


} // get request

}

users_online();

function recordCount($table){
    global $connection;

    $query = "SELECT * FROM ". $table;
    $send_query = mysqli_query($connection, $query);
    $result = mysqli_num_rows($send_query);

    confirmQuery($result);

    return $result;
}


function rowCountByField($table, $column, $status){
    global $connection;

    $query = "SELECT * FROM  $table WHERE $column = '$status'";
    $select_posts = mysqli_query($connection, $query);
    return $result = mysqli_num_rows($select_posts);

}

function query($query) {
    global $connection;
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    return $result;
}

function fetchRecords($result) {
    return mysqli_fetch_array($result);
}

function isAdmin(){
    if (isLoggedIn()) {
        $result = query("SELECT u_role FROM users WHERE u_id =".$_SESSION['user_id']."") ;

        $row = fetchRecords($result);

        if ($row['u_role'] == 'Admin') {
            return true;
        } else {
            return false;
        }
    }

}

// general helpers

function getUsername() {
    return isset($_SESSION['username']) ? $_SESSION['username'] : null;
}


function user_exists($u_name) {
    global $connection;

    $query = "SELECT u_name FROM users WHERE u_name = '$u_name'";
    $result = mysqli_query($connection,$query);

    confirmQuery($result);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
    
}

function email_exists($u_email) {
    global $connection;

    $query = "SELECT u_email FROM users WHERE u_email = '$u_email'";
    $result = mysqli_query($connection,$query);

    confirmQuery($result);

    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
    
}

function redirect($location){
    return header("Location:" . $location);
    exit;
}

function ifItIsMethod($method=null){
    if ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {
        return true;
    } else {
        return false;
    }
}

function isLoggedIn(){
    if (isset($_SESSION['role'])) {
        return true;
    } else {
        return false;
    }
}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null) {
if (isLoggedIn()) {
    redirect($redirectLocation);
}
}


function registerUser($u_name, $u_email, $u_password){
    global $connection;

    $u_name = mysqli_real_escape_string($connection, $u_name);
    $u_email = mysqli_real_escape_string($connection, $u_email);
    $u_password = mysqli_real_escape_string($connection, $u_password);

    $u_password = password_hash($u_password, PASSWORD_BCRYPT, array('cost' => 15));


    $query = "INSERT INTO users (u_name, u_email, u_password, u_role) VALUES('{$u_name}', '{$u_email}', '{$u_password}', 'Subscriber' ) ";

    $register_user_query = mysqli_query($connection, $query);

    confirmQuery($register_user_query);

}

function loginUser($u_name, $u_password){
    global $connection;

    $u_name = trim($u_name);
    $u_password = trim($u_password);

    $u_name = mysqli_real_escape_string($connection, $u_name);
    $u_password = mysqli_real_escape_string($connection, $u_password);
   
    $query = "SELECT * FROM users WHERE u_name = '{$u_name}'";

    $select_user_query = mysqli_query($connection,$query);

    if (!$select_user_query) {
        die('Query Failed' . mysqli_error($connection));
    }

    while ($row = mysqli_fetch_assoc($select_user_query)) {
         $db_id = $row['u_id'];
         $db_name = $row['u_name'];
         $db_password = $row['u_password'];
         $db_firstname = $row['u_firstname'];
         $db_lastname = $row['u_lastname'];
         $db_role = $row['u_role'];
    
         // $u_password = crypt($u_password, $db_password);

        if (password_verify($u_password, $db_password)) {

            $_SESSION['user_id'] = $db_id;
            $_SESSION['username'] = $db_name;
            $_SESSION['lastname'] = $db_lastname;
            $_SESSION['firstname'] = $db_firstname;
            $_SESSION['role'] = $db_role;

            redirect("/blog/index.php");
        } else {
            return false;
        }

    }

    return true;


}

?>
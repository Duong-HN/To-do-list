<?php 
    include('database.php');
    include('default.html');

    if (!loggedin()) {
        header("Location: login.php");
        exit();
    }

    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' && isset($_GET['username'])) {
        $targetUser = $_GET['username'];
    } else {
        $targetUser = $_SESSION['username'];
    }

    echo '<br> <a href="logout.php" align="right" title="Logout" style="color: red; text-decoration: none">&nbsp; Logout </a>';
    echo '<a href="changepassword.php" align="right" title="change password" style="color: blue; text-decoration: none">&nbsp; Change Password </a>';
    echo '<a href="deleteaccount.php" align="right" title="delete account" style="color: blue; text-decoration: none">&nbsp; Delete Account </a> <br>';

    error();

    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' && $targetUser !== $_SESSION['username']) {
        echo "<br> <center id='user'> Viewing Todo list for user: " . ucwords($targetUser) . "</center> <br>";
    } else {
        echo "<div style='margin: 0; padding: 0; background: transparent; text-align: center;'>Welcome " . ucwords($targetUser) . "</div>";

    }

    if (isset($_POST['addtask'])) {
        if (!empty($_POST['description'])) {
            addTodoItem($targetUser, $_POST['description']);
            header("Refresh:0");
            exit();
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>TODO for <?php echo htmlspecialchars($targetUser); ?></title>
</head>
<body>
    <br>
    <form action="todo.php<?php echo (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' && isset($_GET['username'])) ? '?username=' . urlencode($_GET['username']) : ''; ?>" method="POST">
        <?php spaces(30); ?>
        <input type="text" size="50" placeholder=" Title" name="description" autocomplete="off" required/>  
        <input type="submit" name="addtask" value="Add"/>
    </form>
</body>
</html>

<?php
    getTodoItems($targetUser);
?>

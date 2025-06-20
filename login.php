<?php
session_start();
ob_start();


include('database.php');

if (loggedin()) {
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: todo.php");
    }
    exit();
}
ob_end_flush();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style type="text/css" media="screen">
        * {
            font-size: 21pt;
        }
        .unselectable { 
            -webkit-user-select: none; 
            -moz-user-select: none; 
            -ms-user-select: none; 
            user-select: none;    
            color: #cc0000;
        }
        input[type='submit'], input[type='reset'] {
            padding:5px 30px;
            background: #cce6ff;
            border: none;
            border-radius: 30px;
        }
        input[type='text'], input[type='password'] {
            padding: 10px;
            border: none;
            border-radius: 25px;
            outline: none;
        }
    </style>
</head>
<body>
    <?php include('default.html'); ?>
    
    <p style="white-space:pre">  Don't have an account? <a href="newuser.php" style="color: red; text-decoration: none">Create New Account</a> </p> 
    
    <?php error(); ?>

    <center>
        <form action="valid.php" method="POST">
            <fieldset>
                <legend style="color: blue;">Login</legend>
                <table>
                    <tbody>
                        <tr>
                            <td><pre>Name </pre></td>
                            <td>
                                <input size="25" type="text" name="username" placeholder="22010164" autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            <td><pre>Password </pre></td>
                            <td>
                                <input size="25" type="password" name="password" placeholder="********" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php                            
                                    $capcode = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
                                    $capcode = substr(str_shuffle($capcode), 0, 6);
                                    $_SESSION['captcha'] = $capcode;
                                    echo '<div class="unselectable">'.$capcode.'</div>';
                                ?>
                            </td>
                            <td>
                                <input size="25" type="text" name="captcha" placeholder="Enter captcha" autocomplete="off" required>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="reset" value="Reset"></td>
                            <td><input type="submit" value="Submit"></td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </form>
    </center>
</body>
</html>
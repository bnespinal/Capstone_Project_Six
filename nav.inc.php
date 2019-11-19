<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 11/15/2019
 * Time: 6:00 PM
 */
?>
<ul id="nav">
    <?php
    if(isset($_COOKIE)) {
        echo ($currentfile == "index.php") ? "<li>Home</li>" : "<li><a href='index.php'>Home</a></li>";
        echo ($currentfile == "memberinsert.php") ? "<li>Register</li>" : "<li><a href='memberinsert.php'>Register</a></li>";
        if (isset($_SESSION['ID'])) {
            echo ($currentfile == "membermanage.php") ? "<li>Meet Your Peers</li>" : "<li><a href='membermanage.php'>Meet Your Peers</a></li>";
            echo ($currentfile == "bloginsert.php") ? "<li>Write a Blog</li>" : "<li><a href='bloginsert.php'>Write a Blog</a></li>";
            echo "<li><a href='logout.php'>Log Out</a></li>";
            echo "Welcome back, " . $_SESSION['username'];
        } else {
            echo "<li><a href='login.php'>Log In</a></li>";
        }
    }
    ?>
</ul>


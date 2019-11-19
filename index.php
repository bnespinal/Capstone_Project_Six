<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 11/14/2019
 * Time: 11:00 AM
 */
$pagename = "Welcome";
require_once "header.inc.php";
?>
<section id="showcase">
    <div class="container">
        <h1>Project for Information System Capstone</h1>
        <p>Here, I will be demonstrating some additions made to a previous project.</p>
    </div>
</section>
<section id="search">
    <div class="container">
        <?php
        $showform = 1;
        $errmsg = 0;
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {

            echo "<p id='statement'>Searching for:  " .  $_POST['term'] . "</p>";
            echo "<hr />";

            $formdata['term'] = trim($_POST['term']);


            if (empty($formdata['term'])){
                $errterm = "The term is missing.";
                $errmsg = 1;
            }

            if($errmsg == 1)
            {
                echo "<p class='error'>There are errors.  Please make corrections and resubmit.</p>";
            }
            else {
                try {
                    //query the data
                    $sql = "SELECT * FROM Blog WHERE title LIKE '%{$formdata['term']}%'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($stmt->rowCount() == 0) {
                        echo "<p class='error' id='statement'>There are no results.  Please try a different search term.</p>";
                    } else {
                        echo "<p class='success' id='statement'>The following results matched your search:</p>";
                        echo "<table align='center'><tr><th>Username</th><th>Title</th><th>Post</th></tr>";
                        foreach ($result as $row)
                        {
                            echo "<tr><td>" . $row['username'] . "</td>";
                            echo "<td>".$row['title']."</td>";
                            echo "<td>" . $row['blog'];
                            echo "</td></tr>";
                        }
                        echo "</table>";
                        $showform = 1;
                    }
                }//try
                catch (PDOException $e) {
                    die($e->getMessage());
                }
            }
        }
        if($showform ==1) {
            ?>
            <h1>Search For Posts</h1>
            <form name="searchform" id="searchform" method="post" action="searchblog.php">
                <input name="term" id="term" type="text" />
                <span class="error"><?php if(isset($errterm)){echo $errterm;}?></span>
                <input type="submit" name="submit" id="submit" value="submit" />
            </form>
            <?php
        }
        ?>
    </div>
</section>
<div class="row">
    <div class="side">
    </div>
    <div class="main">
        <div class="message">
            <p>Welcome to CSCI 495's Blog, User. This is a capstone project acting as a free blog site, where you can join and post anything that you want, so long as it is appropriate.
            While exploring this page, you will find a number of functions that can be implemented and explored. Without being a member, you can look at the media feed, register, and access the home and log-in pages.
            Next, when registered, you have access to numerous other functions. You can write an article, search through existing articles (posts) and users, you can view limited user information, and you can
            view see a list of existing users if you do not with to use this search function.</p>
        </div>
        <div class="list">
        <?php
        try{
            $sql = "SELECT * FROM Blog ORDER BY inputdate DESC";
            $result = $pdo->query($sql);

            echo "<table align='center'><tr><th>Title</th><th>Post</th><th>Date Posted</th></tr>";

            foreach ($result as $row){
                echo "<tr><td>". $row['title']. "</td><td>";
                echo $row['blog'];
                echo "</td><td>";
                echo date("l, F j, Y", $row['inputdate']);
                echo "</td></tr>\n";
            }
            echo "</table>";
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
        ?>
    </div>
    </div>
    <div class="side">
    </div>
</div>
<?php

require_once "footer.inc.php";
?>

<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 11/17/2019
 * Time: 9:50 AM
 */

$pagename = "Manage Members";
require_once "header.inc.php";
checkLogin();
?>
    <section id="showcase4">
        <div class="container">
        </div>
    </section>
    <section id="search2">
        <div class="container">
            <?php
            $showform = 1;
            $errmsg = 0;
            if($_SERVER['REQUEST_METHOD'] == "POST")
            {
                // We are just echoing out the search term for the user's benefit
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
                        $sql = "SELECT * FROM blogmember WHERE username LIKE '%{$formdata['term']}%' ORDER BY username";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($stmt->rowCount() == 0) {
                            echo "<p class='error' id='statement'>There are no results.  Please try a different user.</p>";
                        } else {
                            echo "<table align='center'><tr><th>Username</th><th>Member Since</th></tr>";
                            foreach ($result as $row) {
                                echo "<tr><td><a href='memberdetails.php?ID=" . $row['ID'] . "'>". $row['username']. "</a></td><td>";
                                echo date("F d, Y", $row['inputdate']);
                                echo "</td></tr>";
                            }
                            echo "</table>";
                            $showform = 0;
                        }
                    }//try
                    catch (PDOException $e) {
                        die($e->getMessage());
                    }
                } // if errors
            }//if post
            if($showform ==1) {
                ?>
                <h1>Search For Users</h1>
                <form name="searchform" id="searchform" method="post" action="searchuser.php">
                    <input name="term" id="term" type="text" />
                    <span class="error"><?php if(isset($errterm)){echo $errterm;}?></span>
                    <input type="submit" name="submit" id="submit" value="submit" />
                </form>


                <?php
            }//showform
            ?>
        </div>
    </section>
    <div class="row">
        <div class="side">
        </div>
        <div class="main">
<?php

try{
    //query the data
    $sql = "SELECT * FROM blogmember";
    //executes a query.
    $result = $pdo->query($sql);

    ?>
    <?php
    echo "<table align='center'>
            <tr><th>Username</th><th>Joined</th></tr>";
    //loop through the results and display to the screen
    foreach ($result as $row){
        echo "<tr>
        <td><a href='memberdetails.php?ID=" . $row['ID'] . "'>". $row['username']. "</a></td>
        <td> ";
        echo date("l, F j, Y", $row['inputdate']);
        echo "</td></tr>\n";
    }
    echo "</table>";
}
catch (PDOException $e)
{
    die( $e->getMessage() );
}
?>
        </div>
        <div class="side">
        </div>
    </div>
<?php
require_once "footer.inc.php";









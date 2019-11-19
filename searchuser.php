<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 11/14/2019
 * Time: 11:00 AM
 */
$pagename = "Search-User";
require_once "header.inc.php";
require_once "functions.inc.php";
checkLogin();

?>
<section id="showcase">
    <div class="container">
    </div>
</section>
<div class="row">
    <div class="side">
    </div>
    <div class="main">
        <?php
        $showform = 1;
        $errmsg = 0;
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            if($showform ==1) {
                ?>
                <form name="searchform" id="searchform" method="post" action="searchuser.php">
                    <input name="term" id="term" type="text" />
                    <span class="error"><?php if(isset($errterm)){echo $errterm;}?></span>
                    <input type="submit" name="submit" id="submit" value="submit" />
                </form>
                <?php
            }
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
        }
        catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
?>
    </div>
    <div class="side">
    </div>
</div>
<?php
require_once "footer.inc.php";
?>









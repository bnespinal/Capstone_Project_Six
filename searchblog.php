<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 11/17/2019
 * Time: 10:20 AM
 */
$pagename = "Search-Blog";
require_once "header.inc.php";
require_once "functions.inc.php";
$showform = 1;
$errmsg = 0;
?>
<section id="showcase2">
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
        <form name="searchform" id="searchform" method="post" action="searchblog.php">
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
            $sql = "SELECT * FROM Blog WHERE title LIKE '%{$formdata['term']}%'";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() == 0) {
                echo "<p class='error' id='statement'>There are no results.  Please try a different search term.</p>";
            } else {
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









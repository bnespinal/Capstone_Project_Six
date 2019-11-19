<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 11/20/2019
 * Time: 8:40 AM
 */

$pagename = "Member - Details";
require_once "header.inc.php";

?>
    <section id="showcase3">
        <div class="container">
        </div>
    </section>
    <div class="row">
        <div class="side">
        </div>
        <div class="main">
<?php
try{
    //query the data
    $sql = "SELECT * FROM blogmember WHERE ID = :ID";
    //prepares a statement for execution
    $stmt = $pdo->prepare($sql);
    //binds the actual value of $_GET['ID'] to
    $stmt->bindValue(':ID', $_GET['ID']);
    //executes a prepared statement
    $stmt->execute();
    //fetches the next row from a result set / returns an array
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //display to the screen
    echo "<table align='center'>
                <tr><th>Username:</th><td>{$row['username']}</td></tr>
                <tr><th>Bio:</th><td>{$row['bio']}</td></tr>
                <tr><th>Joined:</th><td>";
    echo date("l, F j, Y", $row['inputdate']);
    echo "</td></tr></table>";

    if($row['ID'] == $_SESSION['ID']){
        echo "<p id='statement'><button class='button_1'><a href='memberupdate.php?ID=" . $_SESSION['ID'] . "'>Update My Membership Information</a></button> | <button class='button_1'><a href='memberpwd.php?ID=" . $_SESSION['ID'] ."'>Update My Password</a></button></b></p>";
    }
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

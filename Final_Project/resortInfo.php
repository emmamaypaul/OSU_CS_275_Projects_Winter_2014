<?php

ini_set('display_errors', 'On');//checks errors, given on piazza

error_reporting(E_ALL); //I believe reports errors, idk the difference from line above





//reference: http://stackoverflow.com/questions/14149088/how-to-pass-value-from-optionselect-to-form-action
if(isset($_POST['resortList'])&& !empty($_POST["resortList"]))
{  
$resort = $_POST['resortList'];

$resortQuery = ("SELECT DISTINCT runs.name AS 'Run',
experience.name AS 'Skill',
lift.name AS 'Lift',
lodge.name AS 'Lodge'
FROM runs
INNER JOIN lift_to_runs ON lift_to_runs.rid = runs.id
INNER JOIN lift ON lift.lftid = lift_to_runs.lftid
INNER JOIN experience ON experience.eid = runs.eid
INNER JOIN lodge ON lift.lid = lodge.lid
INNER JOIN resort ON resort.rid = lodge.rid
WHERE resort.rid = '$resort'");  

}

$mysqli = new mysqli("oniddb.cws.oregonstate.edu","pauli-db","XXXXXXXXXXXXXXX,"pauli-db");

if (mysqli_connect_errno())
{
echo "Connection error ".$mysqli->connect_errno." ".$mysqli->connect_error;
}

if($result = $mysqli->query($resortQuery))
{
$table = "<table><style>table , th, td
{
border-collapse:collapse;
border: 1px solid black;
}
</style>";


$table=$table."<tr><td><h2>Runs</h2></td><td><h2>Skill</h2></td><td><h2>Lift</h2></td><td><h2>Lodge</h2></td></tr>";


while($row = $result->fetch_assoc())
{
$table = $table."<tr><td>".$row['Run']."</td><td>".$row['Skill']."</td><td>".$row['Lift']."</td><td>".$row['Lodge']."</td></tr>";
}


$table = $table."</table>";

echo "<h1>Based on the Resort you chose, here are all the runs: </h1>";
echo $table;
$result->free();
}

$mysqli->close();

?>

<br>
<form action="http://web.engr.oregonstate.edu/~paule/CS%20275/Project_275.php" method="POST">
<div><input type="submit" value="Home Page"></div>
</form>

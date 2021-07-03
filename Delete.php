<html>
<body>

<h1>INSERT DATA TO DATABASE</h1>

<?php

echo "Insert database!";
?>
<ul>
    <form name="DeleteData" action="DeleteData.php" method="POST" >
<li>toyID:</li><li><input type="text" name="toyid" /></li>
<li><button type="submit" value="Submit">Delete</button></li>
<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-54-225-72-238.compute-1.amazonaws.com;port=5432;user=zyspzjwbrlxfnk;password=95402f2fcd09500f7ad877a328cb24cb0ac00800666b42159462534ac9619b11
        ;dbname=d7f8iof0djq8lo",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

$sql = "DELETE FROM toy WHERE toyid = '$_POST[toyid]'";
$stmt = $pdo->prepare($sql);

if(is_null ($_POST[toyid])== FALSE)  {    
    if($stmt->execute() == TRUE){
        echo "Record updated successfully.";
    } else {
        echo "Error updating record. ";
    }}
?>
</body>
</html>
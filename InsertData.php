<html>
    <head>
<title>Insert data to PostgreSQL</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {
list-style: none;
}
</style>
</head>
<body>
<h1>INSERT DATA TO DATABASE</h1>
<h2>Enter data into table</h2>
<ul>
    <form name="InsertData" action="InsertData.php" method="POST" >
<li>toyID:</li><li><input type="text" name="toyid" /></li>
<li>Toy Name:</li><li><input type="text" name="toyname" /></li>

<li><input type="submit" /></li>
</form>
</ul>

<?php

if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=asm2vinhquan', 'postgres', 'quanmvgcd18594');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-52-5-1-20.compute-1.amazonaws.com;port=5432;user=nonxcmjvtrwbpr;password=6f7e1c5b591ec787a8119866ae9fb7393222f4c109d00992c4bdbdd2fef32090
        ;dbname=d2von46qv4joto",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

if($pdo === false){
     echo "ERROR: Could not connect Database";
}

$sql = "INSERT INTO toy(toyid, toyname)"
        . " VALUES('$_POST[toyid]','$_POST[toyname]')";
$stmt = $pdo->prepare($sql);
//$stmt->execute();
 if (is_null($_POST[toyid])) {
   echo "toyid must be not null";
 }
 else
 {
    if($stmt->execute() == TRUE){
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: ";
    }
 }
?>
</body>
</html>
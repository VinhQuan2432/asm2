ConnectToDB
<html>
<body>

<h1>DATABASE CONNECTION</h1>

<?php
ini_set('display_errors', 1);
echo "Hello, this is ATN toy shop";
?>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     echo '<p>The DB exists</p>';
     echo getenv("dbname");
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

$sql = "SELECT * FROM toy";
$stmt = $pdo->prepare($sql);
//Thiết lập kiểu dữ liệu trả về
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$resultSet = $stmt->fetchAll();


?>
<div id="container">
<table class="table table-bordered table-condensed">
    <thead>
      <tr>
        <th>Toy ID</th>
        <th>Toy Name</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // tạo vòng lặp 
         //while($r = mysql_fetch_array($result)){
             foreach ($resultSet as $row) {
      ?>
      <tr>
        <td scope="row"><?php echo $row['toyid'] ?></td>
        <td><?php echo $row['toyname'] ?></td>  
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
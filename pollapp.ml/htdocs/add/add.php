<?php
include("../cred.php");
// $db = file_get_contents("../database/polls.json");
// $db = json_decode($db);

// // echo $db[0];
$opList = explode(PHP_EOL, $_POST['options']);

// $options = "";
// foreach($opList as $option) {
// 	$options .= '
// 	{
// 		"name": '.json_encode(strval($option)).',
// 		"votes": 0
// 	},';
// }
// // print ( $options );
// $db[] = json_decode('

// {
// 	"title": '.json_encode($_POST['name']).',
// 	"date": '.json_encode(date("D, M d, Y")).',
// 	"options": ['.substr($options, 0, -1).']
// }
// ');


// //  Remove json_pretty_print for production!
// file_put_contents("../database/polls.json", json_encode($db, JSON_PRETTY_PRINT));
// $v = count($db) - 1;
// header("Location: ../vote/?id=".strval($v))

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO polls (title, date)
  VALUES (".json_encode($_POST['name']).", ".json_encode(date("D, M d, Y")).")";
  // use exec() because no results are returned
  $conn->exec($sql);
  $last_id = $conn->lastInsertId();
//   echo "New record created successfully \n";
  foreach($opList as $option) {
        $sql = "INSERT INTO options (parent, votes, name)
            VALUES (".$last_id.", 0, ".json_encode($option).")";
        // use exec() because no results are returned
        $conn->exec($sql);
        // echo "New option created successfully \n";
}
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;

header("Location: https://pollapp.ml/present/".strval($last_id))

?>
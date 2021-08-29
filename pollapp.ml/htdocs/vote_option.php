<?php
// $db = file_get_contents("./database/polls.json");
// $db = json_decode($db);

// // echo $db[0];
// $db[intval($_GET['id'])]->options[intval($_GET['option'])]->votes += 1;
// //  Remove json_pretty_print for production!
// file_put_contents("./database/polls.json", json_encode($db, JSON_PRETTY_PRINT));
include('cred.php');
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "
UPDATE options
SET votes = votes + 1
WHERE id = ".$_GET['option']."
  ";

  // Prepare statement
  $stmt = $conn->prepare($sql);

  // execute the query
  $stmt->execute();

  // echo a message to say the UPDATE succeeded
  echo $stmt->rowCount() . " records UPDATED successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
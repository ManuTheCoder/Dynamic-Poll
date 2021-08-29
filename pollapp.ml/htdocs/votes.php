<?php 
include("cred.php");
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM `options` where `parent`=".$_GET['id']);
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  $total = 0;
  $s = $stmt->fetchAll();
  foreach($s as $row1) {$total += ($row1['votes']);}
  ?>
  <div class="row"><div class="col s12 m8"><?php
  foreach($s as $row) {
    //   echo '{"name": '.json_encode($row['name']).'},';
    
    $percent = ($row['votes']/$total)*100;
?>

<div class="card voteOption" style="width: 100%">
	<div class="card-content">
		<span style="vertical-align: middle"><?=strval($row['name']);?></span>
		<span class="right green-text" style="vertical-align: middle">
			<b><?=strval(round($percent));?>%</b> | <?=strval($row['votes']);?>
		</span>
	</div>
	<div id="progress" class="progress">
		<div class="determinate" style="width:<?=$percent; ?>%"></div>
	</div>
</div>
<?php } 
?></div><?php
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;

?>
<div class="col s12 m4">
<div class="card"><div class="card-content"><h5><b><?=$total;?></b></h5><p>Total votes</p><br><hr><img class="right materialboxed" src="https://api.qrserver.com/v1/create-qr-code/?size=900x900&data=https%3A%2F%2Fpollapp.ml%2Fv%2F<?=$_GET['id'];?>" style="position: relative;top: 5px;" width="30px"><h5>Share</h5><br>
               <a href="mailto:example@example.net?subject=Today's%20Poll&body=Hi%2C%0D%0AHere's%20the%20link%20for%20today's%20poll%3A%20https%3A%2F%2Fpollapp.ml%2Fv%2F<?=$_GET['id'];?>%0D%0A%0D%0AThanks!%0D%0ASincerely%2C%0D%0A_____" data-position="bottom" data-tooltip="Generate email template with link" class="tooltipped fa fa-envelope"></a>
        <a href="https://classroom.google.com/share?url=https%3A%2F%2Fpollapp.ml%2Fv%2F<?=$_GET['id'];?>" data-position="bottom" data-tooltip="Share to classroom" class="tooltipped fa fa-book"></a>

		<a href="http://www.facebook.com/sharer.php?u=https%3A%2F%2Fpollapp.ml%2Fv%2F<?=$_GET['id'];?>" data-position="bottom" data-tooltip="Facebook" class="tooltipped fa fa-facebook"></a>
<a href="http://twitter.com/share?text=QuickPoll - Poll&url=https%3A%2F%2Fpollapp.ml%2Fv%2F<?=$_GET['id'];?>&hashtags=#QuickPoll, #Poll" data-position="bottom" data-tooltip="Copy Link" class="fa fa-twitter"></a>
<a href="http://pinterest.com/pin/create/button/?pin=https%3A%2F%2Fpollapp.ml%2Fv%2F<?=$_GET['id'];?>" data-position="bottom" data-tooltip="Pinterest" class="tooltipped fa fa-pinterest"></a>

<br></div></div>
</div>
</div>
<style>
.progress {
    background-color: #a5d6a7;
}


.progress .determinate {
    background-color: #2e7d32;
}</style>
<script>
 $('.tooltipped').tooltip({
      // specify options here
});
  $('.materialboxed').materialbox({
            // inDuration: 0,
            // outDuration: 0
        });
</script>
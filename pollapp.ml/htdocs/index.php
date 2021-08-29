<?php 
include('cred.php');
?>
<?php 
function max_attribute_in_array($array, $prop) {
    return max(array_map(function($o) use($prop) {
                            return $o->$prop;
                         },
                         $array));
}
/*<div class="chip">
						<?php
						max_attribute_in_array($db[$key]->options, 'votes')
						?>
						</div>
						*/
?>
<!DOCTYPE html>
<html>
	<head>
	<?php include("./include/head.html");?>
	</head>
	<body style="margin-top: 60px !important">
   
		<?php include("./include/nav.html");?>
        <div class="hero-image" style="height: 80vh;background:linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url(https://wallpaperaccess.com/full/3480785.jpg);background-size: cover;background-repeat: no-repeat;background-attachment: fixed;backdrop-filter: blur(1px)">
  <div class="container white-text center" style="padding-top: 24vh">
    <h2 style="font-size:50px;color:white !important;">Smart &amp; easy group decision making</h2>
    <p>An immersive polling experience for both schools and offices! </p>
    <a class=" waves-effect waves-light" style="color:white;min-width: 200px;backdrop-filter: blur(5px);background: transparent;padding: 10px;border: 2px solid #0d47a1; border-radius: 10px;" href="https://pollapp.ml/add">Create your own poll!</a>

  </div>
</div>
		<div class="container">
			<br>
			<h3>
				<b>Recent</b>
			</h3>
			<div class="row">
			<?php 

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM `polls`");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach($stmt->fetchAll() as $value) {
				?>
				<div class="col s12 m4">
					<div class="card waves-effect" onclick="window.location = './v/<?=$value['id']?>'">
						<div class="card-content">
						<b><h5><?=$value['title'];?></h5></b>
						<p><?=$value['date']?></p>
						
						<br>
						</div>
					</div>
				</div>
				<?php
			}
            } catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;

			?>
		</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/@materializecss/materialize@1.0.0/dist/js/materialize.min.js" type="text/javascript"></script>
                <?php include("./include/footer.php"); ?>

	</body>
</html>

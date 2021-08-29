<?php 
include('../cred.php');
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT * FROM `polls` WHERE id=".$_GET['id']);
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach($stmt->fetchAll() as $value) {
      $name = $value['title'];
      $date = $value['date'];
   }
            } catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}

$totalVotes = 0;
try {
  $stmt = $conn->prepare("SELECT * FROM `options` WHERE parent=".$_GET['id']);
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach($stmt->fetchAll() as $value) {
      $totalVotes += intval($value['votes']);
   }
            } catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
	<head>
	<?php include("../include/head.html");?>
    <base href="https://pollapp.ml/vote/">
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="comments.css" rel="stylesheet" type="text/css">
	<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.browser.min.js"></script>
    <style>hr {
    border: 0;
    height: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 1);
}
</style><style>.fa { display: inline-block; padding-left: 10px; padding-top: 10px; cursor: unset;border-radius: 2px;padding-right: 13px; padding-bottom: 10px; font-size: 30px !important; width: 50px; text-align: center; text-decoration: none; margin: 5px 2px; } * { font-family: 'Poppins', sans-serif ; } .fa:hover { transform: scale(1.05) }.fa:active { transform: scale(.97) } .fa-facebook { background: #3B5998; color: white; } .fa-twitter { background: #55ACEE; color: white; } .fa-google { background: #dd4b39; color: white; } .fa-linkedin { background: #007bb5; color: white; } .fa-youtube { background: #bb0000; color: white; } .fa-instagram { background: #125688; color: white; } .fa-pinterest { background: #cb2027; color: white; } .fa-trash { background: #f54245; color: white; } .fa-snapchat-ghost { background: #fffc00; color: white; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black; } .fa-id-card { background: #00aff0; color: white; } .fa-skype { background: #00aff0; color: white; } .fa-android { background: #a4c639; color: white; } .fa-dribbble { background: #ea4c89; color: white; } .fa-vimeo { background: #45bbff; color: white; } .fa-tumblr { background: #2c4762; color: white; } .fa-book { background: #00b489; color: white; } .fa-address-book { background: #45bbff; color: white; } .fa-stumbleupon { background: #eb4924; color: white; } button[disabled] {background:#ccc !important} .fa-link { background: #f40083; color: white; } .fa-yahoo { background: #430297; color: white; } .fa-soundcloud { background: #ff5500; color: white; } .fa-reddit { background: #ff5700; color: white; } .fa-envelope { background: #ff6600; color: white; }
        .new {content: "New" !important}
        </style>
	</head>
	<body class="loading">
		<?php include("../include/nav.html");?>
		<div class="container">
			<br>
			<h3>
				<b id="title"></b>
			</h3>
			<h6 id="date"></h6>
			<br>
			
			<div id="questions">
			<div class="cardLoading"></div>
			<div class="cardLoading"></div>
			<div class="cardLoading"></div>
			<div class="cardLoading"></div>
			<div class="cardLoading"></div>
			<div class="cardLoading"></div>
			<div class="cardLoading"></div>			
			</div>
			
			<button id="skip" class="btn blue darken-3 waves-effect waves-light right" onclick="getVotes();setInterval(getVotes, 2000);this.remove()">Skip to results <i class="material-icons right">arrow_right</i></button>
<br>
<br>
			<div id="comments"></div>
            <div class="comments">
			<div class="boxLoading cardLoading" style="height: 400px !important"></div>		</div>

<script>
const comments_page_id = <?=$_GET['id'];?>; // This number should be unique on every page
fetch("comments.php?page_id=" + comments_page_id).then(response => response.text()).then(data => {
	document.querySelector(".comments").innerHTML = data;
	document.querySelectorAll(".comments .write_comment_btn, .comments .reply_comment_btn").forEach(element => {
		element.onclick = event => {
			event.preventDefault();
			document.querySelectorAll(".comments .write_comment").forEach(element => element.style.display = 'none');
			document.querySelector("div[data-comment-id='" + element.getAttribute("data-comment-id") + "']").style.display = 'block';
			document.querySelector("div[data-comment-id='" + element.getAttribute("data-comment-id") + "'] input[name='name']").focus();
		};
	});
	document.querySelectorAll(".comments .write_comment form").forEach(element => {
		element.onsubmit = event => {
			event.preventDefault();
			fetch("comments.php?page_id=" + comments_page_id, {
				method: 'POST',
				body: new FormData(element)
			}).then(response => response.text()).then(data => {
				element.parentElement.innerHTML = data;
			});
		};
	});
});
</script>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/@materializecss/materialize@1.0.0/dist/js/materialize.min.js" type="text/javascript"></script>
		<script>const poll = {
	id: <?= $_GET['id'];?>,
	title: "<?=$name?>",
	date: "<?=$date?>",
	totalVotes: "<?=$totalVotes?>",
	answers: [<?php try {

  $stmt = $conn->prepare("SELECT * FROM `options` where `parent`=".$_GET['id']);
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach($stmt->fetchAll() as $row) {
      echo '{"name": '.json_encode($row['name']).', "id": '.$row['id'].'},';
  }
            } catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
    ?>],
			}

            window.onerror = function(msg, url, linenumber) {
    alert('Error message: '+msg+'\nURL: '+url+'\nLine Number: '+linenumber);
    return true;
}
			</script>
		<script src="../js/app.js"></script>
        <?php include("../include/footer.php"); ?>
	</body>
</html>
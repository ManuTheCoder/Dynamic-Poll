<!DOCTYPE html>
<html>
	<head>
	    <?php include("../include/head.html");?>
        <style>.fa { display: inline-block; padding-left: 10px; padding-top: 10px; cursor: unset;border-radius: 2px;padding-right: 13px; padding-bottom: 10px; font-size: 30px !important; width: 50px; text-align: center; text-decoration: none; margin: 5px 2px; } * { font-family: 'Poppins', sans-serif ; } .fa:hover { transform: scale(1.05) }.fa:active { transform: scale(.97) } .fa-facebook { background: #3B5998; color: white; } .fa-twitter { background: #55ACEE; color: white; } .fa-google { background: #dd4b39; color: white; } .fa-linkedin { background: #007bb5; color: white; } .fa-youtube { background: #bb0000; color: white; } .fa-instagram { background: #125688; color: white; } .fa-pinterest { background: #cb2027; color: white; } .fa-trash { background: #f54245; color: white; } .fa-snapchat-ghost { background: #fffc00; color: white; text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black; } .fa-id-card { background: #00aff0; color: white; } .fa-skype { background: #00aff0; color: white; } .fa-android { background: #a4c639; color: white; } .fa-dribbble { background: #ea4c89; color: white; } .fa-vimeo { background: #45bbff; color: white; } .fa-tumblr { background: #2c4762; color: white; } .fa-book { background: #00b489; color: white; } .fa-address-book { background: #45bbff; color: white; } .fa-stumbleupon { background: #eb4924; color: white; } button[disabled] {background:#ccc !important} .fa-link { background: #f40083; color: white; } .fa-yahoo { background: #430297; color: white; } .fa-soundcloud { background: #ff5500; color: white; } .fa-reddit { background: #ff5700; color: white; } .fa-envelope { background: #ff6600; color: white; }
        .new {content: "New" !important}
        * {caret-color: transparent !important}
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	</head>
	<body>
		<?php include("../include/nav.html");?>
		<br><br>
		<div class="container center">
		<h1><b><textarea class="js-copytextarea center" style="overflow: visible;border: 0;outline: 0;height: 100px !important">pollapp.ml/v/<?=intval($_GET['id']);?></textarea></b></h1>
        <a href="#" class="tooltipped fa fa-link js-textareacopybtn" data-position="bottom" data-tooltip="Copy Link"></a>
        <a href="mailto:example@example.net?subject=Today's%20Poll&body=Hi%2C%0D%0AHere's%20the%20link%20for%20today's%20poll%3A%20https%3A%2F%2Fpollapp.ml%2Fv%2F<?=intval($_GET['id']);?>%0D%0A%0D%0AThanks!%0D%0ASincerely%2C%0D%0A_____" data-position="bottom" data-tooltip="Generate email template with link" class="tooltipped fa fa-envelope"></a>
        <a href="https://classroom.google.com/share?url=https%3A%2F%2Fpollapp.ml%2Fvote%2F<?=intval($_GET['id']);?>" data-position="bottom" data-tooltip="Share to classroom" class="tooltipped fa fa-book"></a>

		<a href="http://www.facebook.com/sharer.php?u=https%3A%2F%2Fpollapp.ml%2Fvote%2F<?=intval($_GET['id']);?>" data-position="bottom" data-tooltip="Facebook" class="tooltipped fa fa-facebook"></a>
<a href="http://twitter.com/share?text=QuickPoll - Poll&url=https%3A%2F%2Fpollapp.ml%2Fvote%2F<?=intval($_GET['id']);?>&hashtags=#QuickPoll, #Poll" data-position="bottom" data-tooltip="Copy Link" class="fa fa-twitter"></a>
<a href="http://pinterest.com/pin/create/button/?pin=https%3A%2F%2Fpollapp.ml%2Fvote%2F<?=intval($_GET['id']);?>" data-position="bottom" data-tooltip="Pinterest" class="tooltipped fa fa-pinterest"></a>

<br><br>
<br>
<h5>QR Code</h5>
<p>Click to enlarge</p>
<center><img class="materialboxed" src="https://api.qrserver.com/v1/create-qr-code/?size=900x900&data=https%3A%2F%2Fpollapp.ml%2Fvote%2F<?=$_GET['id'];?>" width="200"></center>
		<br><br>

		</div>
	
		<script src="https://cdn.jsdelivr.net/npm/@materializecss/materialize@1.0.0/dist/js/materialize.min.js" type="text/javascript"></script>

        <script>
        
var copyTextareaBtn = document.querySelector('.js-textareacopybtn');

copyTextareaBtn.addEventListener('click', function(event) {
  var copyTextarea = document.querySelector('.js-copytextarea');
  var e  = copyTextarea.value;
  copyTextarea.value = "https://"+copyTextarea.value
  copyTextarea.focus();
  copyTextarea.select();

  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    console.log('Copying text command was ' + msg);
    M.toast({html: "Copied!"})
    copyTextarea.value = e
  } catch (err) {
    console.log('Oops, unable to copy');
  }
});
        $('.materialboxed').materialbox({
            // inDuration: 0,
            // outDuration: 0
        });
 $('.tooltipped').tooltip({
      // specify options here
    });
        </script>                <?php include("../include/footer.php"); ?>

	</body>
</html>
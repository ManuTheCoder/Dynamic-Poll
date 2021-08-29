var parts = window.location.search.substr(1).split("&");
var $_GET = {};
for (var i = 0; i < parts.length; i++) {
	var temp = parts[i].split("=");
	$_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
}

var colors = ['red', 'blue'];
window.addEventListener('load', () => {
    document.title = `${poll.title} - Poll`
	document.getElementById('title').innerHTML = poll.title
	document.getElementById('date').innerHTML = poll.date
document.getElementById("questions").innerHTML = `<div class="row"><div class="col s12 m8"></div><div class="col s12 m4"></div>`;
	poll.answers.forEach((a) => {
		document.getElementById("questions").getElementsByClassName("s12")[0].innerHTML += `<div class="card waves-effect voteOption" style="width: 100%" onclick="vote(this, ${a.id})">
<div class="card-content">
${a.name}
			</div>
			<div class='progress fake' style='background: transparent !important'></div>
			</div>`
	})
    document.getElementById("questions").getElementsByClassName("s12")[1].innerHTML += `<div class="card"><div class="card-content"><h5><b>${poll.totalVotes}</b></h5><p>Total votes</p><br><hr><img class="right materialboxed" src="https://api.qrserver.com/v1/create-qr-code/?size=900x900&data=https%3A%2F%2Fpollapp.ml%2Fv%2F${poll.id}" style="position: relative;top: 5px;" width="30px"><h5>Share</h5><br>
               <a href="mailto:example@example.net?subject=Today's%20Poll&body=Hi%2C%0D%0AHere's%20the%20link%20for%20today's%20poll%3A%20https%3A%2F%2Fpollapp.ml%2Fv%2F${poll.id}%0D%0A%0D%0AThanks!%0D%0ASincerely%2C%0D%0A_____" data-position="bottom" data-tooltip="Generate email template with link" class="tooltipped fa fa-envelope"></a>
        <a href="https://classroom.google.com/share?url=https%3A%2F%2Fpollapp.ml%2Fv%2F${poll.id}" data-position="bottom" data-tooltip="Share to classroom" class="tooltipped fa fa-book"></a>

		<a href="http://www.facebook.com/sharer.php?u=https%3A%2F%2Fpollapp.ml%2Fv%2F${poll.id}" data-position="bottom" data-tooltip="Facebook" class="tooltipped fa fa-facebook"></a>
<a href="http://twitter.com/share?text=QuickPoll - Poll&url=https%3A%2F%2Fpollapp.ml%2Fv%2F${poll.id}&hashtags=#QuickPoll, #Poll" data-position="bottom" data-tooltip="Copy Link" class="fa fa-twitter"></a>
<a href="http://pinterest.com/pin/create/button/?pin=https%3A%2F%2Fpollapp.ml%2Fv%2F${poll.id}" data-position="bottom" data-tooltip="Pinterest" class="tooltipped fa fa-pinterest"></a>

<br></div></div>`;
 $('.tooltipped').tooltip({
      // specify options here
});
  $('.materialboxed').materialbox({
            // inDuration: 0,
            // outDuration: 0
        });
$("body").removeClass("loading")
})

Array.prototype.random = function () {
	return this[Math.floor((Math.random() * this.length))];
}
function vote(el, index) {
    if(!localStorage.getItem("al")) {
        var al = [];
    }
    else {
        var al = JSON.parse(localStorage.getItem("al"))
    }
    al.push(poll.id)
    localStorage.setItem("al", JSON.stringify(al))
	$(".voteOption").addClass('disabled')
	$(el).removeClass('disabled')
	$('.fake').remove()
	$("#skip").remove()
	$("body").addClass("loading")
	el.style.pointerEvents = "none";
	
	history.pushState(null, null, "https://pollapp.ml/vote/?id="+poll.id+"&results")

	var http1 = new XMLHttpRequest();
	http1.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			getVotes(cf);
			setInterval(getVotes, 8000);
			$("body").removeClass("loading");
            setTimeout(() => document.getElementById("title").insertAdjacentHTML("beforebegin", `<button onclick="confetti({ angle: 125, spread: 70, particleCount: 100, origin: { y: 0.2, x: .85 } });" class="waves-effect waves-light right btn btn-floating btn-large blue-grey"><i class="material-icons">celebration</i></button>`), 200)
    setTimeout(() => document.getElementById("title").insertAdjacentHTML("beforebegin", `<button onclick="var x = setInterval(function() {confetti({ angle: 125, spread: 100, particleCount: 150, origin: { y: 0.2, x: .8 } });}, 1000); window.onscroll = function() {clearInterval(x)}" class="waves-effect waves-light right btn btn-floating btn-large blue-grey" style="margin-right: 5px"><i class="material-icons">timer</i></button>`), 200)
		}
	};
	http1.open("GET", "https://pollapp.ml/vote_option.php?option=" + index + "&id="+poll.id, true);
	http1.send();
}
function getVotes(callback = function() {}) {
	$("#questions").load("https://pollapp.ml/votes.php?id=" +poll.id, callback)
}

if ($_GET['results']) {
	getVotes();
	$("#skip").remove()
	setInterval(getVotes, 8000)
	cf();
    setTimeout(() => document.getElementById("title").insertAdjacentHTML("beforebegin", `<button onclick="confetti({ angle: 125, spread: 70, particleCount: 100, origin: { y: 0.2, x: .85 } });" class="waves-effect waves-light right btn btn-floating btn-large blue-grey"><i class="material-icons">celebration</i></button>`), 200)
    setTimeout(() => document.getElementById("title").insertAdjacentHTML("beforebegin", `<button onclick="var x = setInterval(function() {confetti({ angle: 125, spread: 100, particleCount: 150, origin: { y: 0.2, x: .8 } });}, 1000); window.onscroll = function() {clearInterval(x)}" class="waves-effect waves-light right btn btn-floating btn-large blue-grey" style="margin-right: 5px"><i class="material-icons">timer</i></button>`), 200)
} 

function cf() {
	var count = 200;
var defaults = {
  origin: { y: 0.7 }
};

function fire(particleRatio, opts) {
  confetti(Object.assign({}, defaults, opts, {
    particleCount: Math.floor(count * particleRatio)
  }));
}

fire(0.25, {
  spread: 26,
  startVelocity: 55,
});
fire(0.2, {
  spread: 60,
});
fire(0.35, {
  spread: 100,
  decay: 0.91,
  scalar: 0.8
});
fire(0.1, {
  spread: 120,
  startVelocity: 25,
  decay: 0.92,
  scalar: 1.2
});
fire(0.1, {
  spread: 120,
  startVelocity: 45,
});
}
window.addEventListener("load", () => {
    if(localStorage.getItem("al") && JSON.parse(localStorage.getItem("al")).includes(parseInt(poll.id)) && !$_GET['results']) {
        document.getElementById('title').innerHTML = ""
	document.getElementById('date').innerHTML = ""
        document.getElementById("questions").innerHTML = `<center><div class="container"><div class="container"><img src="https://i.ibb.co/t40j0qg/Clip-Financial-report-transparent-by-Icons8.gif" style="width: 100%"><br><b>You've already answered!</b><br><a href="https://icons8.com/l/animations/#clip">Image credits</a></div></div></center>`;
        if(document.getElementById("skip")) {
            document.getElementById("skip").insertAdjacentHTML('beforebegin', "<br><br>")
            document.getElementById("skip").onclick = function() {
                window.location = "https://pollapp.ml/vote?id="+poll.id + "&results"
            }
            document.getElementById("skip").innerHTML = `Jump to Results <i class="material-icons right">arrow_right</i>`
            document.getElementById("skip").classList.remove("blue");
            document.getElementById("skip").classList.add("red")
        }
    }
})
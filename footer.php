</div>
</div>
<div class="extra">
	<div class="container">
		<div class="row">

			<div class="span3">

				<h4>About</h4>

				<ul>
					<li><a href="javascript:;">About Us</a></li>
					<li><a href="javascript:;">Twitter</a></li>
					<li><a href="javascript:;">Facebook</a></li>
					<li><a href="javascript:;">Google+</a></li>
				</ul>

			</div>
			<div class="span3">
				<h4>Info</h4>
				<ul>
					<li><a href="javascript:;">How To Find Us</a></li>
					<li><a href="javascript:;">Our History</a></li>
					<li><a href="javascript:;">Golfing Links</a></li>
					<li><a href="javascript:;">Become A Member</a></li>
				</ul>

			</div>
			<div class="span3">
				<h4>Fixtures</h4>
				<ul>
				    <li><a href="javascript:;">Gents</a></li>
				    <li><a href="javascript:;">Ladies</a></li>
				    <li><a href="javascript:;">Juniors</a></li>
				    <li><a href="javascript:;">Open</a></li>
				</ul>
			</div>
			<div class="span3">
			    <ul>
				<li>The Alyth Golf Club Pitcrocknie</li>
				<li>Perthshire</li>
				<li>Scotland</li>
				<li>PH11 8HF</li>
				<li>Tel: 01828 632268</li>
				<li>Fax: 01828 633491</li>
				<li>Pro: 01828 632411</li>
			    </ul>
			</div>
		</div>
	</div>
</div>
<div class="footer">
	<div class="container">
		<div class="row">
			<div id="footer-copyright" class="span6">
			    &copy; 2013 Alyth Golfclub
			</div>
			<div id="footer-terms" class="span6">
			    <a href="mailto:info@alythgolfclub.co.uk">info@alythgolfclub.co.uk</a>
			</div>
		</div>
	</div>
</div>
</div>     
    <script src="js/jquery/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
    <script>
		$('#myModal').on('show', function () {
		  $('#myModalBody').height(800);
		  $('#myModal').width(650);
		  $("#myModalLabel").text("Scorecard");
		})
		$( document ).ready(function() {
			function GetURLParameter(sParam){
		var sPageURL = window.location.search.substring(1);
		var sURLVariables = sPageURL.split('&');
			for (var i = 0; i < sURLVariables.length; i++) {
			var sParameterName = sURLVariables[i].split('=');
			if (sParameterName[0] == sParam) {
		return sParameterName[1];
			}
		}
			}
			var isgents=GetURLParameter('g');
			if (isgents==1) {
				$('#gentsFixtures').show();
		   } else {
				$('#ladiesFixtures').show();	   
		   }			
			$("#btMembers").click(function(){
				window.open("http://www.brsgolf.com/alyth/members_home.php");
			})			
			$("#btVisitors").click(function(){
				window.open("http://www.brsgolf.com/alyth/visitor_home.php");
			})
			$("#btOpen").click(function(){
				window.open("http://www.brsgolf.com/alyth/opens_home.php");
			})
			$("#holedivs a").click(function(){
			var $elemId = $(this).attr("id");
		    $("#holeimg").attr("src",'img/holes/holemap'+$elemId);
		    $("#holesModalLabel").text("Hole "+$elemId);
		    })
		});
	</script>  
 </body>
</html>

<div class="row-fluid">
	<div class="span11 offset1" bgcolor="#660000">
		<P>THE ALYTH GOLF CLUB PITCROCKNIE, ALYTH, PERTHSHIRE, SCOTLAND, PH11 8HF TEL: 01828 632268 FAX: 01828 633491</p>	
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

<!DOCTYPE html>
<html>
  <head>
    <title>Alyth Golf Club</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once('lib/settings.class.php');
    ?>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/bootstrap-responsive.css" rel="stylesheet"> 
    <link href="css/custom.css" rel="stylesheet" media="screen">
  </head>
  <body>
    <div class="container-fluid">
    	<div class="row-fluid">
    	   <div class="span12">
    			<img class="span12" id="mainbanner" src="img/agcbanner.jpg" >
    			<div class="navbar">
		  			<div class="navbar-inner">
		    			<ul class="nav">
			    			<li><a href="index.php">Home</a></li>
			  				<li class="dropdown">
	  							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Book Times <b class="caret"></b></a>
	  							<ul id="bookTimes" class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	    							<li role="presentation">
	      						<a id="btMembers" role="menuitem" href="#">Members</a>
	    							</li>
	    							<li role="presentation">
	      						<a id="btVisitors" role="menuitem" href="#">Visitors</a>
	    							</li>
	    							<li role="presentation">
	      						<a id="btOpen" role="menuitem" href="#">Opens</a>
	    							</li>
	    						</ul>
	    					<li class="dropdown">
	  							<a class="dropdown-toggle" data-toggle="dropdown" href="#">The Course<b class="caret"></b></a>
	  							<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	    							<li role="presentation">
	      							<a role="menuitem" href="coursemap.php">Course Guide</a>
	    							</li>
	    							<li role="presentation">
	      							<a data-toggle="modal" href="scorecard.html" data-target="#myModal" role="menuitem">Scorecard</a>
	      							<!--<a href="#myModal" role="menuitem" data-toggle="modal">Launch demo modal</a>-->
	    							</li>
	  							</ul>
							</li>
							<li class="dropdown">
	  							<a class="dropdown-toggle" data-toggle="dropdown" href="#">General Information<b class="caret"></b></a>
	  							<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	    							<li role="presentation">
	      							<a data-toggle="modal" href="committee.html" data-target="#myModal" role="menuitem">Committee/Club Officials</a>
	    							</li>
	    							<li role="presentation">
	      							<a data-toggle="modal" href="scorecard.html" data-target="#scModal" role="menuitem">Other Option</a>
	      							<!--<a href="#myModal" role="menuitem" data-toggle="modal">Launch demo modal</a>-->
	    							</li>
	  							</ul>
							</li>
							<li><a href="membership.php">Membership</a></li>
							<li class="dropdown">
	  							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Fixtures<b class="caret"></b></a>
	  							<ul id="fixtures" class="dropdown-menu" role="menu" aria-labelledby="dLabel">
	    							<li role="presentation">
	      							<a id="gents" role="menuitem" href="fixtures.php?g=1">Gents</a>
	    							</li>
	    							<li role="presentation">
	      							<a id="ladies" role="menuitem" href="fixtures.php?g=0">Ladies</a>
	      							<!--<a href="#myModal" role="menuitem" data-toggle="modal">Launch demo modal</a>-->
	    							</li>
	  							</ul>
							</li>
		    		</div>
	  			</div>
	  
<!--Nav bar Modals-->	  
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <h3 id="myModalLabel">Scorecard</h3>
  </div>
  <div id="myModalBody" class="modal-body"></div>
  <div class="modal-footer">
    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>



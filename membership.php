<?php
require_once('header.php');
?>
<div class="row-fluid">
<div class="span8"><P>
Becoming a member to this well established golf club has never been so easy.  In addition to our very competitive pricing structure the club also has a policy 
of <b>NO JOINING FEE</b>.<br><br>At a small fee We also offer the opportunity to pay on a monthly basis with fairway credit.
</p></div> 
<div class="span4">
    <table class="table table-bordered table-condensed table-hover">
		<thead>  
			<tr>  
				<th span=2>Subscriptions for <?php echo date('Y')?></th>  
		   </tr>  
		</thead>
<tbody>
<?
$link = mysql_connect('localhost', 'root', 'development');
$rv = mysql_select_db('alythgc', $link);
$sql="select * from membership where year='".date('Y')."'";
$rowset=mysql_query($sql);
while($row=mysql_fetch_array($rowset)) {
	echo "<tr>";
	echo "<td>".$row['description']."</td>";
	echo "<td>&pound".$row['price']."</td>";
	echo "</tr>";
	}
?>
  
		<!--<tbody>  
		  <tr> 
		    <td>Full Membership</td>
		    <td>&pound;475</td>
		  </tr>
		  <tr> 
		    <td>Restricted Membership</td>
		    <td>&pound;400</td>
		  </tr>
		  <tr> 
		    <td>Intermediate Membership(18-25 Years)</td>
		    <td>&pound;240</td>
		  </tr>
		  <tr> 
		    <td>Country Membership<br>(Reside 50 Miles from Club)</td>
		    <td>&pound;390</td>
		  </tr>
		  <tr> 
		    <td>Juniors (Over 15)</td>
		    <td>&pound;60</td>
		  </tr>
		  <tr> 
		    <td>Juniors (Under 15)</td>
		    <td>&pound;50</td>
		  </tr>
		  <tr> 
		    <td>Juniors (Under 12)</td>
		    <td>Free</td>
		  </tr>-->
		</tbody>  
		</table>
 </div>
</div>
<?php
require_once('footer.php');
?>
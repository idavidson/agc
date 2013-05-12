<?php
require_once('header.php');
echo "<div class='row-fluid'>";
echo "<div id='test' class='span12'>";
echo "<ul id='holedivs' class='thumbnails'>";
for ($i=1;$i<19;$i++) {
    $modulus=$i % 4;
    echo "<li class='span3'>";
    echo "<div class='thumbnail'>";
    echo "<img src='img/holes/holemap$i.jpg' alt=''>";
    echo "<h3>Hole $i  ";
    echo "<a id='$i' href='#holesViewModal' role='button' class='btn btn-primary' data-toggle='modal'>View Large</a>";   
    echo "</h3>";
    echo "<p>Here we go!   A slight dog-leg left, up and over the hill. If you miss the fairway and semi-rough - you have had a really wild tee shot. No excuses! A large green   awaits, but with borrows to make you ponder.</p>";
    echo "</div>";
    echo "</li>";
    if($modulus == 0) {
        echo "</ul>";
        echo "</div>";
        echo "</div>";
        echo "<div class='row-fluid'>";
        echo "<div id='test' class='span12'>";
        echo "<ul id='holedivs' class='thumbnails'>";
    }
}
?>
<div id="holesViewModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="holesModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 id="holesModalLabel">Hole</h3>
    </div>
    <div id="holesModalBody" class="modal-body">
    <ul class="thumbnails">
        <li class="span6">
            <a href="#" class="thumbnail">
                <img id='holeimg' src="img/holes/holemap1.jpg" width="240" height="120" alt="">
            </a>
        </li>
    </ul>  
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>
<?php
require_once('footer.php');
?>
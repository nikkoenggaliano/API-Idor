<?php 

if(isset($_GET['name'])){
	$open = fopen("solver.txt", "a+");
	fwrite($open, $_GET['name']."\n");
	fclose($open);
}

show_source(__FILE__);
exit;
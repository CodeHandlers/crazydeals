<?php 
if( !isset( $_SESSION['MM_Username'] ) )
		echo "<script>window.location.replace('index.php?noLogin=true')</script>";
?>
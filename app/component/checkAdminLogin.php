<?php 
	if(!isset($_SESSION['admin'])){
		header('location: /techadmin/admin/login/index');
		exit();
	}
?>
<?php

session_start();


// Making some redirects
if(!isset($_SESSION['admin_id'])) {
    echo "<script>window.location='../admin/login'</script>";
} else {
	echo "<script>window.location='../admin/dashboard'</script>"; 
}

?>
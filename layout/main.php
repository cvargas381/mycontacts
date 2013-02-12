<?php
// Display message if there is one in session data
if(isset($_SESSION['message'])) {
	// Display message
	echo $_SESSION['message'];
	// Remove message from session
	unset($_SESSION['message']);
}
// Store the 'p' paramater from the QS into a variable

if(isset($_GET['p'])) {
	$p = $_GET['p'];	
} else {
	$p = DEFAULT_PAGE;
}


include("pages/$p.php");
?>
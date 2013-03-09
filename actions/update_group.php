<?php session_start() ?>
<?php
// Extract POST data to variables
extract($_POST);

// At this point, as ar esult of 'extract', we can
// refer to, for example, the submitted last name as
// $contact_lastname instead of $_POST['contact_lastname']

// Connect to the DB
$conn = new mysqli('localhost','mycontacts_user','UwLnmjBZPKfVaGMA','mycontacts');

// Execute query
$sql = "UPDATE groups SET group_name='$group_name' WHERE group_id={$_POST['id']} ";
$conn->query($sql);

if($conn->errno >0) {
	echo $conn->error;
}

// clsoe DB connection 
$conn->close();
$_SESSION['message'] = array(
		'text' => 'Your group has been edited.',
		'type' => 'info'
		);
// Redirect to list
header('Location:../?p=list_groups');
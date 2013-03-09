<?php session_start() ?>
<?php
// Connect to the DB
$conn = new mysqli('localhost','mycontacts_user','UwLnmjBZPKfVaGMA','mycontacts');

// Execute the query
$sql = "DELETE FROM groups WHERE group_id={$_POST['id']}";
$conn->query($sql);

// Close the connection
$conn->close();
$_SESSION['message'] = array(
		'text' => 'Your group has been deleted.',
		'type' => 'danger'
		);
// Redirect
header('Location:../?p=list_groups');
<?php session_start() ?>
<?php
require('../config/db.php');
require('../config/app.php');
require('../lib/functions.php');

$required = array(
	'contact_firstname',
	'contact_lastname',
	'contact_email',
	'contact_phone1',
	'contact_phone2',
	'contact_phone3'
);

// Extract form data
extract($_POST);

// Validate form data
foreach($required as $r) {
	// If invalid, redirect with message
	if(!isset($_POST[$r]) || $_POST[$r] == '') {
		// Set message
		$_SESSION['message'] = array(
			'type' => 'danger',
			'text' => 'Please provide all required information.'
			);
		// Store form data into session data
		$_SESSION['POST'] = $_POST;
		// Set location header
		header('Location:../?p=form_add_contact');
		// Kill script
		die();
	}
}
$contact_phone = "$contact_phone1"."$contact_phone2"."$contact_phone3";
// Add contact to DB
$sql = "INSERT INTO contacts (contact_firstname,contact_lastname,contact_email,contact_phone) VALUES ('$contact_firstname','$contact_lastname','$contact_email',$contact_phone)";
// connect to DB
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
// Query DB
$conn->query($sql);
// Close connection
$conn->close();
// Set message
$_SESSION['message'] = array(
		'text' => 'Your contact has been added.',
		'type' => 'success'
		);
// Set location header
header('Location:../?p=list_contacts');
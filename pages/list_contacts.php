<h2>Contacts</h2>
<?php
// Connect to the database
// new mysqli (host,user,password,db name)
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

// Read (SELECT) contacts from the database
if(isset($_GET['q']) && $_GET['q'] != '') {
	$where = "WHERE contact_lastname LIKE '%{$_GET['q']}%'";
	$search_message = "<p>Contacts with last name containing '{$_GET['q']}'<p>";
	$show_all = '<a href="read.php">Show all contacts</a>';
} else {
	$where = '';
	$search_message = '';
	$show_all = '';
}
if(isset($_GET['sort']) && $_GET['sort'] != '') {
	$orderby = "ORDER BY contact_{$_GET['sort']}";
} else {
	$orderby = "ORDER BY contact_lastname, contact_firstname";
}
$sql = "SELECT * FROM contacts $where $orderby";
$results = $conn->query($sql);

// If there was a MySQL error on the last query,
// display error and kill the current script
if($conn->errno > 0) {
	echo $conn->error;
	die();
}
echo "$search_message";
echo "$show_all";
// Loop over the contacts & display them
// Fetch_assoc fetches the next row from the result set as associate array, *returns null when there are no more results
echo'<table class="table"><tr><th><a href="./?sort=firstname">First Name</th><th><a href="./?sort=lastname">Last Name</th><th>Email</th><th>Phone Number</th><th></th></tr>';
while(($contact = $results->fetch_assoc()) != null) {
	extract($contact);
	echo "<tr>";
	echo"	<td>$contact_firstname</td>";
	echo"	<td>$contact_lastname</td>";
	echo"	<td><a href=\"mailto:$contact_email\">$contact_email</td>";
	echo "<td>".format_phone($contact_phone)."</td>";
	echo '<form style="display:inline;" method="post" action="delete.php">';
	echo	"<input type=\"hidden\" name=\"id\" value=\"$contact_id\" />";
	echo "<td class=\"button\"><a href=\"?p=form_edit_contact&id=$contact_id\" class=\"btn btn-warning\"><i class=\"icon-edit icon-white\"></i></a> <a href=\"?p=delete&id=$contact_id\" class=\"btn btn-danger\"><i class=\"icon-trash icon-white\"></i></a></td>";
	echo 	"</form>";
	echo 	"</td>";
	echo"</tr>";
}
echo '</table>';

// close the DB connection
$conn->close();	
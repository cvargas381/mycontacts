<h2>Contacts</h2>
<?php
// Connect to the database
// new mysqli (host,user,password,db name)
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

// Read (SELECT) contacts from the database
if(isset($_GET['q']) && $_GET['q'] != '') {
	$where = "WHERE contact_lastname LIKE '%{$_GET['q']}%' OR contact_firstname LIKE '%{$_GET['q']}%'";
	$search_message = "<p>Contacts with a first or last name containing '{$_GET['q']}'<p>";
	$show_all = '<a href="./">Show all contacts</a>';
	$sort_f = "./?plist_contacts&q={$_GET['q']}&sort=firstname";
	$sort_l = "./?plist_contacts&q={$_GET['q']}&sort=lastname";
} else {
	$where = '';
	$search_message = '';
	$show_all = '';
	$sort_f = './';
	$sort_l = './';
}
if(isset($_GET['sort']) && $_GET['sort'] != '') {
	$orderby = "ORDER BY contact_{$_GET['sort']}";
} else {
	$orderby = "ORDER BY contact_lastname, contact_firstname";
}
$sql = "SELECT * FROM contacts LEFT JOIN groups ON contacts.group_id=groups.group_id $where $orderby";
$results = $conn->query($sql);

// If there was a MySQL error on the last query,
// display error and kill the current script
if($conn->errno > 0) {
	echo $conn->error;
	die();
}
echo "$search_message";
echo "$show_all";
// Fetch_assoc fetches the next row from the result set as associate array, *returns null when there are no more results
echo"<table class=\"table\"><tr><th><a href=\"$sort_f\">First Name</th><th><a href=\"$sort_l\">Last Name</th><th>Email</th><th>Phone Number</th><th>Groups</th><th></th></tr>";
while(($contact = $results->fetch_assoc()) != null) {
	extract($contact);
	echo "<tr>";
	echo"	<td>$contact_firstname</td>";
	echo"	<td>$contact_lastname</td>";
	echo"	<td><a href=\"mailto:$contact_email\">$contact_email</td>";
	echo "<td>".format_phone($contact_phone)."</td>";
	echo "<td><a href=\"?p=groups&id=$group_id\"><span class=\"label label-info\">$group_name</span></a></td>";
	echo "<td class=\"button\"><a href=\"?p=form_edit_contact&id=$contact_id\" class=\"btn btn-warning\"><i class=\"icon-edit icon-white\"></i></a>";
	echo '<form style="display:inline;" method="post" action="actions/delete.php">';
	echo	"<input type=\"hidden\" name=\"id\" value=\"$contact_id\" />";
	$onclick = "return confirm('Are you sure you want to delete $contact_firstname $contact_lastname?')";
	echo	" <button onclick=\"$onclick\" class =\"btn btn-danger\" type=\"submit\"><i class=\"icon-trash icon-white\"</button>";
	echo 	"</form>";
	echo 	"</td>";
	echo"</tr>";
}
echo '</table>';

// close the DB connection
$conn->close();	
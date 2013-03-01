<?php 
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$sql = "SELECT group_name FROM groups WHERE group_id={$_GET['id']}";
$results = $conn->query($sql);
$group = $results->fetch_assoc();
extract($group);
$sql = "SELECT * FROM contacts WHERE group_id={$_GET['id']}";
$results = $conn->query($sql);

?>
<h2><?php echo $group_name ?></h2>
<?php
// Connect to the database
// new mysqli (host,user,password,db name)

// If there was a MySQL error on the last query,
// display error and kill the current script
if($conn->errno > 0) {
	echo $conn->error;
	die();
}
// Loop over the contacts & display them
// Fetch_assoc fetches the next row from the result set as associate array, *returns null when there are no more results
echo'<table class="table"><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone Number</th><th></th></tr>';
while(($contact = $results->fetch_assoc()) != null) {
	extract($contact);
	echo "<tr>";
	echo"	<td>$contact_firstname</td>";
	echo"	<td>$contact_lastname</td>";
	echo"	<td><a href=\"mailto:$contact_email\">$contact_email</td>";
	echo "<td>".format_phone($contact_phone)."</td>";
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
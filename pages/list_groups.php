<?php
// Connect to the database
// new mysqli (host,user,password,db name)
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
// If there was a MySQL error on the last query,
$sql = "SELECT groups.*, COUNT(contact_id) AS num_contacts FROM groups LEFT JOIN contacts ON groups.group_id=contacts.group_id GROUP BY groups.group_id ORDER BY group_name";
$results = $conn->query($sql);
// display error and kill the current script
if($conn->errno > 0) {
	echo $conn->error;
	die();
}
echo"<table class='table'><tr><th>Groups</th><th>Members</th></tr>";
while(($group = $results->fetch_assoc()) != null) {
extract($group);
$onclick = "return confirm('Are you sure you want to delete ')";
echo"<tr><td><a href='?p=groups&id=$group_id'>$group_name</a></td><td><span class=\"badge badge-info\">$num_contacts</span></td><td class=\"button\"><a href=\"#\" class=\"btn btn-warning\"><i class=\"icon-edit icon-white\"></i></a><button onclick=\"$onclick\" class =\"btn btn-danger\" type=\"submit\"><i class=\"icon-trash icon-white\"</button></td></tr>";
}
echo"</table>";

// close the DB connection
$conn->close();	
<h2>Groups</h2>
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
while(($group = $results->fetch_assoc()) != null) {
extract($group);
echo"<ul><a href='?p=groups&id=$group_id'>$group_name</a><li><span class=\"badge badge-info pull-right\">$num_contacts</span></li></ul>";
}

// close the DB connection
$conn->close();	
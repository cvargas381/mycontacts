<?php
// Connect to the DB
$conn = new mysqli('localhost','mycontacts_user','UwLnmjBZPKfVaGMA','mycontacts');

// Execute SELECT query
$sql = "SELECT * FROM groups WHERE group_id={$_GET['id']}";
$results = $conn->query($sql);

// Store the contact data into the variables
$contact = $results->fetch_assoc();
extract($contact);

// Close the connection
$conn->close();

?>
<h2>Edit Group</h2>
<form class="form-horizontal" action="./actions/update_group.php" method="post">
	<div class="control-group">
	  <label class="control-label" for="group_name">Name</label>
	  <div class="controls">
	    <input type="text" name="group_name" value="<?php echo $group_name ?>"/>
	  </div>
	</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-warning"><i class="icon-edit icon-white"></i>Edit Group</button>
		<a href="./"><button type="button" class="btn">Cancel</button></a>
	</div> 
	<?php echo "<input type=\"hidden\" name=\"id\" value=\"$group_id\" />";?>
</form>
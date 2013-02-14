<?php
// Connect to the DB
$conn = new mysqli('localhost','mycontacts_user','UwLnmjBZPKfVaGMA','mycontacts');

// Execute SELECT query
$sql = "SELECT * FROM contacts WHERE contact_id={$_GET['id']}";
$results = $conn->query($sql);

// Store the contact data into the variables
$contact = $results->fetch_assoc();
extract($contact);

// Close the connection
$conn->close();

?>
<h2>Edit Contact</h2>
<form class="form-horizontal" action="./actions/update.php" method="post">
	<div class="control-group">
	  <label class="control-label" for="contact_firstname">Name</label>
	  <div class="controls">
	    <input type="text" name="contact_firstname" value="<?php echo $contact_firstname ?>"/>
	  </div>
	</div>
	<div class="control-group">
	  <label class="control-label" for="contact_lastname"></label>
	  <div class="controls">
	   <input type="text" name="contact_lastname" value="<?php echo $contact_lastname ?>" />
	  </div>
	</div>
	<div class="control-group">
	  <label class="control-label" for="contact_email">Email</label>
	  <div class="controls">
	    <input type="text" name="contact_email" value="<?php echo $contact_email ?>" />
	  </div>
	</div>
	<div class="control-group">
	  <label class="control-label" for="contact_phone">Phone Number</label>
	  <div class="controls">
	  	{<input class="phone" type="text" name="contact_phone1" value="<?php echo substr($contact_phone,0,3) ?>" />}
	  	<input class="phone" type="text" name="contact_phone2" value="<?php echo substr($contact_phone,3,3) ?>" />
	  	<input class="phone2" type="text" name="contact_phone3" value="<?php echo substr($contact_phone,-4) ?>" />
	  </div>
	</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-warning"><i class="icon-edit icon-white"></i>Edit Contact</button>
		<a href="./"><button type="button" class="btn">Cancel</button></a>
	</div> 
	<?php echo "<input type=\"hidden\" name=\"id\" value=\"$contact_id\" />";?>
</form>
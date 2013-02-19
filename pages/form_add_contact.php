<h2>New Contact</h2>
<form class="form-horizontal" action="./actions/create.php" method="post">
	<div class="control-group">
	  <label class="control-label" for="contact_firstname">Name</label>
	  <div class="controls">
	    <?php echo input('contact_firstname','first name') ?>
	  </div>
	</div>
	<div class="control-group">
	  <label class="control-label" for="contact_lastname"></label>
	  <div class="controls">
	    <?php echo input('contact_lastname','last name') ?>
	  </div>
	</div>
	<div class="control-group">
	  <label class="control-label" for="contact_email">Email</label>
	  <div class="controls">
	    <?php echo input('contact_email','you@example.com') ?>
	  </div>
	</div>
	<div class="control-group">
	  <label class="control-label" for="contact_phone">Phone Number</label>
	  <div class="controls">
	    {<?php echo input('contact_phone1','999',null,'phone span1') ?>}
	    <?php echo input('contact_phone2','888',null,'phone span1') ?>
	    <?php echo input('contact_phone3','7777',null,'phone span2') ?>
	  </div>
	</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-success"><i class="icon-plus-sign icon-white"></i>Add Contact</button>
		<a href="./"><button type="button" class="btn">Cancel</button></a>
	</div> 
</form>
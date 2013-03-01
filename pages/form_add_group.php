<h2>New Group</h2>
<form class="form-horizontal" action="./actions/create_group.php" method="post">
	<div class="control-group">
	  <label class="control-label" for="contact_firstname">Name</label>
	  <div class="controls">
	    <?php echo input('group_name','group name') ?>
	  </div>
	</div>
	<div class="form-actions">
		<button type="submit" class="btn btn-success"><i class="icon-plus-sign icon-white"></i>Add Group</button>
		<a href="./"><button type="button" class="btn">Cancel</button></a>
	</div> 
</form>
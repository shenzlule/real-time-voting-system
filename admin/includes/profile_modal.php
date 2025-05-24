<!-- Add -->
<div class="modal fade" id="profile">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Admin Profile</b></h4>
          	</div>
          	<div class="modal-body">
            <form class="form-horizontal" method="POST" action="profile_update.php?return=<?php echo basename($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
  <div class="form-group row">
    <label for="username" class="col-sm-3 col-form-label text-muted font-weight-bold">Username</label>
    <div class="col-sm-9">
      <input type="text" class="form-control rounded-pill shadow-sm" id="username" name="username" value="<?php echo $user['username']; ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="firstname" class="col-sm-3 col-form-label text-muted font-weight-bold">Firstname</label>
    <div class="col-sm-9">
      <input type="text" class="form-control rounded-pill shadow-sm" id="firstname" name="firstname" value="<?php echo $user['firstname']; ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="lastname" class="col-sm-3 col-form-label text-muted font-weight-bold">Lastname</label>
    <div class="col-sm-9">
      <input type="text" class="form-control rounded-pill shadow-sm" id="lastname" name="lastname" value="<?php echo $user['lastname']; ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="photo" class="col-sm-3 col-form-label text-muted font-weight-bold">Photo</label>
    <div class="col-sm-9">
      <input type="file" class="form-control-file" id="photo" name="photo">
    </div>
  </div>

  <hr class="my-4">

  
  <div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary btn-flat" data-dismiss="modal">
      <i class="fa fa-close"></i> Close
    </button>
    <button type="submit" class="btn btn-success btn-flat" name="save">
      <i class="fa fa-check-square-o"></i> Save
    </button>
  </div>
</form>

              
  <!-- Change Password Section -->
  <div>
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Change Password</h3>
    <form class="space-y-4" method="POST" action="profile_update_password.php" enctype="multipart/form-data" >
      <div>
        <label for="current" class="block text-gray-700 font-medium mb-1">Current Password</label>
        <input type="password" name="current"   required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
      </div>
      <div>
        <label for="new" class="block text-gray-700 font-medium mb-1">New Password</label>
        <input type="password"  name="new"  required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
      </div>
      <div>
        <label for="retype" class="block text-gray-700 font-medium mb-1">Confirm New Password</label>
        <input type="password"  name="retype" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
      </div>
      <button type="submit" name="change" class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition">Update Password</button>
    </form>
  </div>
</div>


          	</div>
        </div>
    </div>
</div>
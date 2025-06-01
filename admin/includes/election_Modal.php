

<!-- Add -->
<div class="modal fade" id="addElectionModal" tabindex="-1" role="dialog" aria-labelledby="addElectionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form action="election_add.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New Election</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Election Name</label>
            <input type="text" name="election_name" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Election Date</label>
            <input type="date" name="election_date" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Start Time</label>
            <input type="time" name="start_time" class="form-control" required>
          </div>
          <div class="form-group">
            <label>End Time</label>
            <input type="time" name="end_time" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
              <option value="upcoming">Upcoming</option>
              <option value="ongoing">Ongoing</option>
              <option value="completed">Completed</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="add" class="btn btn-primary">Add Election</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- edit -->
<div class="modal fade" id="editElectionModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="edit_election.php">
        <div class="modal-header">
          <h4 class="modal-title">Edit Election</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Hidden ID -->
          <input type="hidden" name="id" id="edit_election_id">

          <div class="form-group">
            <label for="edit_election_name">Election Name</label>
            <input type="text" class="form-control" id="edit_election_name" name="election_name" required>
          </div>

          <div class="form-group">
            <label for="edit_election_date">Election Date</label>
            <input type="date" class="form-control" id="edit_election_date" name="election_date" required>
          </div>

          <div class="form-group">
            <label for="edit_start_time">Start Time</label>
            <input type="time" class="form-control" id="edit_start_time" name="start_time" required>
          </div>

          <div class="form-group">
            <label for="edit_end_time">End Time</label>
            <input type="time" class="form-control" id="edit_end_time" name="end_time" required>
          </div>

          <div class="form-group">
            <label for="edit_status">Status</label>
            <select class="form-control" id="edit_status" name="status" required>
              <option value="upcoming">Upcoming</option>
              <option value="ongoing">Ongoing</option>
              <option value="completed">Completed</option>
            </select>
          </div>




          <div class="form-group">
  <label for="edit_release_results">Release Results</label>
  <select class="form-control" id="edit_release_results" name="release_results" required>
    <option value="0">No</option>
    <option value="1">Yes</option>
  </select>
</div>

<div class="form-group">
  <label for="edit_release_voting_guide">Release Voting Guide</label>
  <select class="form-control" id="edit_release_voting_guide" name="release_voting_guide" required>
    <option value="0">No</option>
    <option value="1">Yes</option>
  </select>
</div>



        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" name="edit" class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- delete -->
<!-- Delete -->
<div class="modal fade" id="deleteElection">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
            <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="election_delete.php">
  <input type="hidden" name="id" id="edit_election_id_del">

  <div class="modal-body">
    <div class="callout callout-danger text-center" style="margin-bottom: 0;">
      <h4 class="text-danger" style="font-weight: bold; font-size: 20px;">
        <i class="fa fa-exclamation-triangle"></i> Confirm Deletion
      </h4>
      <p class="text-muted" style="margin-top: 10px; font-size: 16px;">
        Are you sure you want to delete the election:
      </p>
      <h3 class="text-bold fullname text-danger" style="margin-top: 5px;"></h3>
    </div>
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal">
      <i class="fa fa-close"></i> Cancel
    </button>
    <button type="submit" class="btn btn-danger btn-flat" name="delete">
      <i class="fa fa-trash"></i> Yes, Delete
    </button>
  </div>
</form>

            </div>
        </div>
    </div>
</div>




<!-- reset -->
<!-- Reset Election Modal -->
<div class="modal fade" id="resetElectionModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="reset_election.php">
        <div class="modal-header bg-danger">
          <h4 class="modal-title text-white">Reset Election</h4>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Hidden ID -->
          <input type="hidden" name="id" id="edit_election_id_reset">
          <!-- Hidden flag to trigger reset -->

          <p>Are you sure you want to <strong>reset this election</strong>? This will delete all associated votes.</p>

          <div class="alert alert-warning">
            <strong>Warning:</strong> This action cannot be undone.
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="reset" class="btn btn-danger">Yes, Reset</button>
        </div>
      </form>
    </div>
  </div>
</div>

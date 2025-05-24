
<!-- Modal -->
<div class="modal fade " id="selectElectionModal2">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" class=" h-[400px]" action="set_election2.php">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="selectElectionModalLabel">Select Election</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body ">
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" name="set_election" class="btn btn-primary">Set Election</button>
        </div>
          <div class="form-group">
            <label for="election_id">Elections</label>
            <select id="election_id" name="election_id" class="form-control" required>
              <option value="" disabled selected>Select an election</option>

              <?php
                $sql = "SELECT id , election_name FROM elections ORDER BY election_name ASC";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                  echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['election_name']) . "</option>";
                }
              ?>
            </select>
          </div>
         
        </div>
       
      
      </form>
    </div>
  </div>
</div>

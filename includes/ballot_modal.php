<!-- Preview Modal -->
<div class="modal fade" id="preview_modal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="previewModalLabel"><i class="fa fa-eye mr-1"></i> Vote Preview</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="preview_body">
        <!-- Dynamic vote preview content goes here -->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
          <i class="fa fa-times mr-1"></i> Close
        </button>
      </div>
    </div>
  </div>
</div>


<!-- View Ballot Modal -->
<div class="modal fade" id="view" tabindex="-1" role="dialog" aria-labelledby="viewBallotLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="viewBallotLabel"><i class="fa fa-list-alt mr-1"></i> Your Votes</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
          $id = $voter['id'];
          $sql = "SELECT *, candidates.firstname AS canfirst, candidates.lastname AS canlast FROM votes 
                  LEFT JOIN candidates ON candidates.id = votes.candidate_id 
                  LEFT JOIN positions ON positions.id = votes.position_id 
                  WHERE voters_id = '$id' 
                  ORDER BY positions.priority ASC";
          $query = $conn->query($sql);
          while($row = $query->fetch_assoc()){
            echo "
              <div class='d-flex justify-content-between align-items-center border-bottom py-2'>
                <strong class='text-muted'>".$row['description']." :</strong>
                <span class='text-dark font-weight-semibold'>".$row['canfirst']." ".$row['canlast']."</span>
              </div>
            ";
          }
        ?>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">
          <i class="fa fa-times mr-1"></i> Close
        </button>
      </div>
    </div>
  </div>
</div>

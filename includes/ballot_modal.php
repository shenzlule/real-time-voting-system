<!-- Preview -->
<div class="modal fade" id="preview_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Vote Preview</h4>
            </div>
            <div class="modal-body">
              <div id="preview_body"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Platform -->
<div class="modal fade" id="platform">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="candidate"></b></h4>
            </div>
            <div class="modal-body">
              <p id="plat_view"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<!-- View Ballot -->
<div class="modal fade" id="view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Your Votes</h4>
            </div>
            <div class="modal-body">
              <?php
                $id = $voter['id'];
                $sql = "SELECT *, candidates.firstname AS canfirst, candidates.lastname AS canlast FROM votes LEFT JOIN candidates ON candidates.id=votes.candidate_id LEFT JOIN positions ON positions.id=votes.position_id WHERE voters_id = '$id'  ORDER BY positions.priority ASC";
                $query = $conn->query($sql);
                while($row = $query->fetch_assoc()){
                  echo "
                    <div class='row votelist'>
                      <span class='col-sm-4'><span class='pull-right'><b>".$row['description']." :</b></span></span> 
                      <span class='col-sm-8'>".$row['canfirst']." ".$row['canlast']."</span>
                    </div>
                  ";
                }
              ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>



<!-- Preview Modal -->
<div class="fixed z-50 inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" id="preview_modal">
  <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
    <div class="flex justify-between items-center border-b px-4 py-2">
      <h2 class="text-lg font-bold text-gray-800">Vote Preview</h2>
      <button class="text-gray-500 hover:text-gray-800" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="p-4" id="preview_body">
      <!-- Preview content goes here -->
    </div>
    <div class="flex justify-end px-4 py-2 border-t">
      <button class="bg-gray-200 hover:bg-gray-300 text-sm font-semibold px-4 py-1 rounded" data-dismiss="modal">
        <i class="fa fa-close mr-1"></i> Close
      </button>
    </div>
  </div>
</div>

<!-- Platform Modal -->
<div class="fixed z-50 inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" id="platform">
  <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
    <div class="flex justify-between items-center border-b px-4 py-2">
      <h2 class="text-lg font-bold text-gray-800"><span class="candidate"></span></h2>
      <button class="text-gray-500 hover:text-gray-800" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="p-4 text-gray-700" id="plat_view">
      <!-- Platform content -->
    </div>
    <div class="flex justify-end px-4 py-2 border-t">
      <button class="bg-gray-200 hover:bg-gray-300 text-sm font-semibold px-4 py-1 rounded" data-dismiss="modal">
        <i class="fa fa-close mr-1"></i> Close
      </button>
    </div>
  </div>
</div>

<!-- View Ballot Modal -->
<div class="fixed z-50 inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" id="view">
  <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
    <div class="flex justify-between items-center border-b px-4 py-2">
      <h2 class="text-lg font-bold text-gray-800">Your Votes</h2>
      <button class="text-gray-500 hover:text-gray-800" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="p-4 space-y-3 text-gray-700">
      <?php
        $id = $voter['id'];
        $sql = "SELECT *, candidates.firstname AS canfirst, candidates.lastname AS canlast FROM votes 
                LEFT JOIN candidates ON candidates.id=votes.candidate_id 
                LEFT JOIN positions ON positions.id=votes.position_id 
                WHERE voters_id = '$id' ORDER BY positions.priority ASC";
        $query = $conn->query($sql);
        while($row = $query->fetch_assoc()){
          echo "
            <div class='flex justify-between items-center border-b pb-1'>
              <span class='font-medium'>".$row['description']."</span>
              <span>".$row['canfirst']." ".$row['canlast']."</span>
            </div>
          ";
        }
      ?>
    </div>
    <div class="flex justify-end px-4 py-2 border-t">
      <button class="bg-gray-200 hover:bg-gray-300 text-sm font-semibold px-4 py-1 rounded" data-dismiss="modal">
        <i class="fa fa-close mr-1"></i> Close
      </button>
    </div>
  </div>
</div>

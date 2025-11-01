<div class="content-page">
  <div class="content">
    <div class="container-fluid py-4">

  <div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0 text-primary"><i class="fas fa-school me-2"></i>Fathu-Rahman School — Weekly Timetable (Morning)</h3>
    <div>
      <button id="refreshBtn" class="btn btn-outline-primary me-2"><i class="fas fa-sync-alt"></i> Refresh</button>
      <button id="printTimetable" class="btn btn-gradient"><i class="fas fa-print"></i> Print</button>
    </div>
  </div>

  <div id="loadingSpinner" class="text-center py-5 d-none">
    <div class="spinner-border" role="status"></div>
    <div class="mt-2 text-muted">Loading timetable...</div>
  </div>

  <!-- Group 1 Table: Class 1–7 -->
  <div class="table-responsive mb-4">
    <table class="table table-bordered align-middle mb-0" id="timetableTableGroup1">
      <thead class="table-primary">
        <tr>
          <th>Day</th>
          <th>Period</th>
          <th>Class 1</th>
          <th>Class 2</th>
          <th>Class 3</th>
          <th>Class 4</th>
          <th>Class 5</th>
          <th>Class 6</th>
          <th>Class 7</th>
        </tr>
      </thead>
      <tbody id="timetableBodyGroup1">
        <tr><td colspan="9" class="text-center py-4 text-muted">Loading timetable...</td></tr>
      </tbody>
    </table>
  </div>

  <!-- Group 2 Table: Class 8A–Form 4 -->
  <div class="table-responsive">
    <table class="table table-bordered align-middle mb-0" id="timetableTableGroup2">
      <thead class="table-primary">
        <tr>
          <th>Day</th>
          <th>Period</th>
          <th>Class 8A</th>
          <th>Class 8B</th>
          <th>Form 1</th>
          <th>Form 2</th>
          <th>Form 3</th>
          <th>Form 4</th>
        </tr>
      </thead>
      <tbody id="timetableBodyGroup2">
        <tr><td colspan="8" class="text-center py-4 text-muted">Loading timetable...</td></tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Edit Cell Modal -->
<div class="modal fade" id="editCellModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5>Edit Cell</h5></div>
      <div class="modal-body">
        <input type="hidden" id="edit_class_id">
        <input type="hidden" id="edit_day">
        <input type="hidden" id="edit_period_id">
        <div class="mb-2"><label>Subject</label><input type="text" class="form-control" id="edit_subject"></div>
        <div class="mb-2"><label>Teacher</label><input type="text" class="form-control" id="edit_teacher"></div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="saveCellBtn">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- Add/Edit Period Modal -->
<div class="modal fade" id="editPeriodModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5>Add/Edit Period</h5></div>
      <div class="modal-body">
        <input type="hidden" id="period_id">
        <div class="mb-2"><label>Period Number</label><input type="number" class="form-control" id="period_number"></div>
        <div class="mb-2"><label>Start Time</label><input type="time" class="form-control" id="start_time"></div>
        <div class="mb-2"><label>End Time</label><input type="time" class="form-control" id="end_time"></div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="savePeriodBtn">Save</button>
      </div>
    </div>
  </div>
</div>

</div>
    </div> <!-- container-fluid -->
  </div> <!-- content -->


<?php
include_once '../config/db_connect.php';
?>

<div class="content-page">
  <div class="content">
    <div class="container-fluid py-4">

      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Academic Year Management</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addYearModal">
          <i class="fas fa-plus"></i> Add New Year
        </button>
      </div>

      <div class="row" id="yearCards">
        <?php
        $years = $conn->query("SELECT * FROM academic_years ORDER BY id DESC");
        while($row = $years->fetch_assoc()):
        ?>
        <div class="col-md-6 col-lg-4 mb-3 year-card" data-id="<?= $row['id'] ?>">
          <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <h5 class="fw-bold mb-1"><?= $row['year_name'] ?></h5>
                <p class="mb-0 text-muted">Start: <?= $row['start_date'] ?><br>End: <?= $row['end_date'] ?></p>
                <?php if($row['is_active']): ?>
                  <span class="badge bg-success mt-2">Active</span>
                <?php else: ?>
                  <span class="badge bg-secondary mt-2">Inactive</span>
                <?php endif; ?>
              </div>
              <div class="text-end">
                <button class="btn btn-sm btn-info editYearBtn" data-id="<?= $row['id'] ?>"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-danger deleteYearBtn" data-id="<?= $row['id'] ?>"><i class="fas fa-trash"></i></button>
                <?php if(!$row['is_active']): ?>
                  <button class="btn btn-sm btn-success setActiveBtn mt-1" data-id="<?= $row['id'] ?>"><i class="fas fa-check"></i></button>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <?php endwhile; ?>
      </div>

    </div>
  </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addYearModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="addYearForm">
        <input type="hidden" name="action" value="add">
        <div class="modal-header">
          <h5 class="modal-title">Add Academic Year</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Year Name</label>
            <input type="text" class="form-control" name="year_name" placeholder="e.g., 2025-2026" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" class="form-control" name="start_date" required>
          </div>
          <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" class="form-control" name="end_date" required>
          </div>
          <div class="form-check">
            <input type="checkbox" class="form-check-input" name="is_active" id="isActiveAdd">
            <label class="form-check-label" for="isActiveAdd">Set as Active Year</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save Year</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editYearModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content" id="editYearContent">
      <!-- Dynamic content loaded via JS -->
    </div>
  </div>
</div>


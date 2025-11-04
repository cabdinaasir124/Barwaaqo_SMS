<div class="content-page">
  <div class="content">
    <div class="container-fluid py-4">

      <!-- ===== Page Header ===== -->
      <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div>
          <h4 class="fw-semibold text-primary mb-1">
            <i data-feather="users" class="me-2"></i> Student Management
          </h4>
          <p class="text-muted small mb-0">Manage all enrolled students and their details</p>
        </div>
        <button id="addStudentBtn" class="btn btn-primary rounded-pill shadow-sm px-4">
  <i data-feather="user-plus" class="me-2"></i> Add Student
</button>

      </div>

      <!-- ===== Filter & Search ===== -->
      <div class="card shadow-sm border-0 mb-4">
        <div class="card-body d-flex flex-wrap gap-3 align-items-center justify-content-between">
          <div class="d-flex align-items-center gap-2">
            <label class="fw-semibold small text-muted">Filter:</label>
            <select class="form-select form-select-sm">
              <option value="">All Classes</option>
              <option>Class 1</option>
              <option>Class 2</option>
              <option>Form 1</option>
              <option>Form 2</option>
            </select>
          </div>
          <div class="input-group w-auto">
            <span class="input-group-text bg-light border-end-0"><i data-feather="search"></i></span>
            <input type="text" class="form-control border-start-0" placeholder="Search students...">
          </div>
        </div>
      </div>

      <!-- ===== Student Table ===== -->
      <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">
          <table class="table align-middle table-hover">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Student</th>
                <th>Class</th>
                <th>Gender</th>
                <th>Guardian</th>
                <th>Contact</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>01</td>
                <td class="d-flex align-items-center">
                  <img src="assets/img/avatar1.jpg" class="rounded-circle me-2" width="40" height="40" alt="">
                  <div>
                    <strong>Ahmed Mohamed</strong><br>
                    <small class="text-muted">#STU001</small>
                  </div>
                </td>
                <td><span class="badge bg-info-subtle text-info px-3 py-2">Form 2</span></td>
                <td><span class="text-secondary">Male</span></td>
                <td>Mr. Mohamed</td>
                <td>612345678</td>
                <td><span class="badge bg-success-subtle text-success px-3 py-2">Active</span></td>
                <td class="text-center">
                  <button class="btn btn-sm btn-outline-info rounded-circle me-1" data-bs-toggle="tooltip" title="View">
                    <i data-feather="eye"></i>
                  </button>
                  <button class="btn btn-sm btn-outline-warning rounded-circle me-1" data-bs-toggle="tooltip" title="Edit">
                    <i data-feather="edit-3"></i>
                  </button>
                  <button class="btn btn-sm btn-outline-danger rounded-circle" data-bs-toggle="tooltip" title="Delete">
                    <i data-feather="trash-2"></i>
                  </button>
                </td>
              </tr>

              <tr>
                <td>02</td>
                <td class="d-flex align-items-center">
                  <img src="assets/img/avatar2.jpg" class="rounded-circle me-2" width="40" height="40" alt="">
                  <div>
                    <strong>Fatima Ali</strong><br>
                    <small class="text-muted">#STU002</small>
                  </div>
                </td>
                <td><span class="badge bg-primary-subtle text-primary px-3 py-2">Class 7</span></td>
                <td><span class="text-secondary">Female</span></td>
                <td>Mrs. Asha</td>
                <td>614567890</td>
                <td><span class="badge bg-success-subtle text-success px-3 py-2">Active</span></td>
                <td class="text-center">
                  <button class="btn btn-sm btn-outline-info rounded-circle me-1"><i data-feather="eye"></i></button>
                  <button class="btn btn-sm btn-outline-warning rounded-circle me-1"><i data-feather="edit-3"></i></button>
                  <button class="btn btn-sm btn-outline-danger rounded-circle"><i data-feather="trash-2"></i></button>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>



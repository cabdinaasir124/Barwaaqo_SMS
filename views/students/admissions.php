<div class="content-page">
  <div class="content">
    <div class="container-fluid py-4">

      <!-- Page Header -->
      <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div>
          <h4 class="fw-semibold text-primary mb-1">
            <i class="fas fa-user-graduate me-2"></i>Admissions Management
          </h4>
          <p class="text-muted mb-0">Handle new student admissions, approvals, and enrollment records.</p>
        </div>
        <div>
          <a href="student-add.php" class="btn btn-primary">
            <i class="fas fa-user-plus me-2"></i> Register New Student
          </a>
        </div>
      </div>

      <!-- Statistics Cards -->
      <div class="row g-3 mb-4">
        <div class="col-md-3">
          <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body d-flex align-items-center">
              <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                <i class="fas fa-users text-primary fs-4"></i>
              </div>
              <div>
                <h6 class="text-muted mb-0">Total Students</h6>
                <h4 class="fw-bold mb-0">1,248</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body d-flex align-items-center">
              <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                <i class="fas fa-user-check text-success fs-4"></i>
              </div>
              <div>
                <h6 class="text-muted mb-0">This Term Admissions</h6>
                <h4 class="fw-bold mb-0">234</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body d-flex align-items-center">
              <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                <i class="fas fa-user-clock text-warning fs-4"></i>
              </div>
              <div>
                <h6 class="text-muted mb-0">Pending Applications</h6>
                <h4 class="fw-bold mb-0">18</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body d-flex align-items-center">
              <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                <i class="fas fa-user-times text-danger fs-4"></i>
              </div>
              <div>
                <h6 class="text-muted mb-0">Rejected Applications</h6>
                <h4 class="fw-bold mb-0">7</h4>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Search & Filter Bar -->
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
          <div class="row g-2 align-items-center">
            <div class="col-md-4">
              <input type="text" class="form-control" placeholder="Search by name or ID...">
            </div>
            <div class="col-md-3">
              <select class="form-select">
                <option selected>Filter by Class</option>
                <option>Nursery</option>
                <option>Primary</option>
                <option>Secondary</option>
              </select>
            </div>
            <div class="col-md-3">
              <select class="form-select">
                <option selected>Status</option>
                <option>Admitted</option>
                <option>Pending</option>
                <option>Rejected</option>
              </select>
            </div>
            <div class="col-md-2 text-end">
              <button class="btn btn-outline-primary w-100">
                <i class="fas fa-search me-1"></i> Search
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Students Table -->
      <div class="card shadow-sm border-0">
        <div class="card-header bg-light">
          <h6 class="mb-0 fw-semibold text-secondary"><i class="fas fa-list me-2"></i>Recent Admissions</h6>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-primary">
              <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Gender</th>
                <th>Class</th>
                <th>Guardian</th>
                <th>Contact</th>
                <th>Status</th>
                <th>Date Registered</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td><strong>Ahmed Mohamed</strong></td>
                <td>Male</td>
                <td>Class 2</td>
                <td>Ali Yusuf</td>
                <td>+252 61 234 5678</td>
                <td><span class="badge bg-success">Admitted</span></td>
                <td>2025-10-29</td>
                <td>
                  <a href="view-student.php?id=1" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                  <a href="edit-student.php?id=1" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                  <button class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td><strong>Fatima Abdi</strong></td>
                <td>Female</td>
                <td>Class 1</td>
                <td>Hassan Abdi</td>
                <td>+252 61 987 6543</td>
                <td><span class="badge bg-warning text-dark">Pending</span></td>
                <td>2025-10-28</td>
                <td>
                  <a href="view-student.php?id=2" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                  <a href="edit-student.php?id=2" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>


<!-- Subjects Management Page -->
<div class="content-page">
  <div class="content">
    <div class="container-fluid py-4">

      <!-- Page Header -->
      <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div>
          <h4 class="fw-semibold mb-1 text-primary">Subjects Management</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb small mb-0">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Subjects</li>
            </ol>
          </nav>
        </div>
        <div class="mt-3 mt-md-0">
          <button class="btn btn-primary me-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
            <i data-feather="plus-circle" class="me-1"></i> Add Subject
          </button>
          <a href="classes.php" class="btn btn-outline-secondary me-2 shadow-sm">
            <i data-feather="grid" class="me-1"></i> View Classes
          </a>
          <a href="teacher-list.php" class="btn btn-outline-secondary shadow-sm">
            <i data-feather="user" class="me-1"></i> View Teachers
          </a>
        </div>
      </div>

      <!-- Subjects Table -->
      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-light border-0 py-3 d-flex justify-content-between align-items-center flex-wrap">
  <h5 class="card-title mb-0">All Subjects</h5>

  <!-- Filter & Print Section -->
  <div class="d-flex align-items-center gap-2">
    <!-- Class Filter Dropdown -->
    <select id="filterClass" class="form-select form-select-sm">
      <option value="">All Classes</option>
      <!-- Dynamic options will be inserted here -->
    </select>

    <!-- Print Button -->
    <button id="printSubjects" class="btn btn-sm btn-outline-primary">
      <i data-feather="printer" class="me-1"></i> Print
    </button>
  </div>
</div>


        <div class="card-body">
          <table id="subjects-datatable" class="table table-striped table-bordered dt-responsive nowrap w-100">
            <thead>
              <tr>
                <th rowspan="2" class="align-middle">Subject Name</th>
                <th colspan="2">Academic Info</th>
                <th colspan="3">Teacher Details</th>
              </tr>
              <tr>
                <th>Subject Code</th>
                <th>Class</th>
                <th>Teacher</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Mathematics</td>
                <td>MTH101</td>
                <td>Form Four</td>
                <td>Mr. Hassan</td>
                <td><span class="badge bg-success-subtle text-success">Active</span></td>
                <td>
                  <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editSubjectModal">
                    <i data-feather="edit-2"></i>
                  </button>
                  <button class="btn btn-sm btn-outline-danger">
                    <i data-feather="trash"></i>
                  </button>
                </td>
              </tr>
              <tr>
                <td>English</td>
                <td>ENG102</td>
                <td>Form Three</td>
                <td>Ms. Aisha</td>
                <td><span class="badge bg-success-subtle text-success">Active</span></td>
                <td>
                  <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editSubjectModal">
                    <i data-feather="edit-2"></i>
                  </button>
                  <button class="btn btn-sm btn-outline-danger">
                    <i data-feather="trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Add Subject Modal -->
      <div class="modal fade" id="addSubjectModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-primary text-white rounded-top-4">
              <h5 class="modal-title"><i data-feather="book" class="me-2"></i> Add New Subject</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form>
                <div class="mb-3">
                  <label class="form-label fw-semibold">Subject Name</label>
                  <input type="text" class="form-control" placeholder="Enter subject name">
                </div>
                <div class="mb-3">
  <label class="form-label fw-semibold">Subject Code</label>
  <input type="text" id="subject_code" class="form-control" placeholder="e.g., MTH101" readonly>
</div>

                <hr>
                <div class="mb-3">
                  <label class="form-label fw-semibold">Assign to Class</label>
                  <select class="form-select class-select"></select>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-semibold">Assign Teacher</label>
                  <select class="form-select teacher-select"></select>
                </div>
                <div class="mb-3">
                  <label class="form-label fw-semibold">Status</label>
                  <select class="form-select status-select">
                    <option>Active</option>
                    <option>Inactive</option>
                  </select>
                </div>
                <div class="text-end">
                  <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Save Subject</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Edit Subject Modal -->
<div class="modal fade" id="editSubjectModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-info text-white rounded-top-4">
        <h5 class="modal-title"><i data-feather="edit-2" class="me-2"></i> Edit Subject</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label class="form-label fw-semibold">Subject Name</label>
            <input type="text" class="form-control subject-name">
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Subject Code</label>
            <input type="text" class="form-control subject-code" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Status</label>
            <select class="form-select status-select">
              <option>Active</option>
              <option>Inactive</option>
            </select>
          </div>
          <div class="text-end">
            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-info text-white">Update Subject</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


    </div>
  </div>
</div>


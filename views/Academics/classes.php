<!-- Classes Management Page -->
<div class="content-page">
  <div class="content">
    <div class="container-fluid py-4">

      <!-- Page Header -->
      <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div>
          <h4 class="fw-semibold mb-1 text-primary">Classes Management</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb small mb-0">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Classes</li>
            </ol>
          </nav>
        </div>
        <div class="mt-3 mt-md-0">
          <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addClassModal">
            <i data-feather="plus-circle" class="me-1"></i> Add Class
          </button>
        </div>
      </div>

      <!-- Classes Table -->
      <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-light border-0 py-3 d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0">All Classes</h5>
        </div>

        <div class="card-body">
          <table id="classes-datatable" class="table table-striped table-bordered nowrap w-100">
            <thead>
              <tr>
                <th>Class Name</th>
                <th>Class Code</th>
                <th>Section</th>
                <th>Class Teacher</th>
                <th>Maximum Students</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Form One</td>
                <td>FRM1</td>
                <td>A</td>
                <td>Mr. Hassan</td>
                <td>40</td>
                <td><span class="badge bg-success-subtle text-success">Active</span></td>
                <td>
                  <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editClassModal">
                    <i data-feather="edit-2"></i>
                  </button>
                  <button class="btn btn-sm btn-outline-danger">
                    <i data-feather="trash"></i>
                  </button>
                </td>
              </tr>
              <tr>
                <td>Form Two</td>
                <td>FRM2</td>
                <td>B</td>
                <td>Ms. Amina</td>
                <td>45</td>
                <td><span class="badge bg-success-subtle text-success">Active</span></td>
                <td>
                  <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editClassModal">
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

     <!-- Add Class Modal -->
<div class="modal fade" id="addClassModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-primary text-white rounded-top-4">
        <h5 class="modal-title"><i data-feather="plus-circle" class="me-2"></i> Add New Class</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="addClassForm">
          <div class="mb-3">
            <label class="form-label fw-semibold">Class Name</label>
            <input type="text" class="form-control" id="className" placeholder="Enter class name" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Class Code</label>
            <input type="text" class="form-control" id="classCode" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Section</label>
            <select class="form-select" id="section" required>
              <option value="">Select Section</option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Class Teacher</label>
            <select class="form-select" id="classTeacher" required>
              <option value="">Select Teacher</option>
              <!-- Options loaded dynamically -->
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Maximum Students</label>
            <input type="number" class="form-control" id="maxStudents" placeholder="Enter maximum students" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Status</label>
            <select class="form-select" id="status" required>
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
          </div>
          <div class="text-end">
            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Class</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


     <!-- Edit Class Modal -->
<div class="modal fade" id="editClassModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-info text-white rounded-top-4">
        <h5 class="modal-title"><i data-feather="edit-2" class="me-2"></i> Edit Class</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="editClassForm">
          <input type="hidden" id="editId">
          <div class="mb-3">
            <label class="form-label fw-semibold">Class Name</label>
            <input type="text" class="form-control" id="editClassName" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Class Code</label>
            <input type="text" class="form-control" id="editClassCode" readonly>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Section</label>
            <select class="form-select" id="editSection" required>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Class Teacher</label>
            <select class="form-select" id="editClassTeacher" required></select>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Maximum Students</label>
            <input type="number" class="form-control" id="editMaxStudents" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold">Status</label>
            <select class="form-select" id="editStatus" required>
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
          </div>
          <div class="text-end">
            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-info text-white">Update Class</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


    </div>
  </div>
</div>


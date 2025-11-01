<!-- Teacher List Page -->
<div class="content-page">
  <div class="content">
    <div class="container-fluid py-4">

      <!-- Page Header -->
      <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
        <div>
          <h4 class="fw-semibold mb-1 text-primary">Teacher Management</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb small mb-0">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Teacher List</li>
            </ol>
          </nav>
        </div>
        <div class="mt-3 mt-md-0">
          <button class="btn btn-primary d-flex align-items-center shadow-sm px-3" data-bs-toggle="modal" data-bs-target="#addTeacherModal">
            <i data-feather="user-plus" class="me-2"></i> Add Teacher
          </button>
        </div>
      </div>

      <!-- Teachers Table -->
      <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0 text-primary fw-semibold">
            <i data-feather="users" class="me-2 text-primary"></i> All Teachers
          </h5>
          <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
            Total: <span id="teacherCount">12</span>
          </span>
        </div>

        <div class="card-body">
          <div class="table-responsive">
         <table id="TeacherTable" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Photo</th>
      <th>Name</th>
      <th>National ID</th>
      <th>Classes</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Status</th>
      <th>Salary</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody id="TeacherBody"></tbody>
</table>

          </div>
        </div>
      </div>

      <!-- Add Teacher Modal -->
<div class="modal fade" id="addTeacherModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-primary text-white rounded-top-4">
        <h5 class="modal-title d-flex align-items-center">
          <i data-feather="user-plus" class="me-2"></i> Add New Teacher
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form id="addTeacherForm" enctype="multipart/form-data">
          <div class="row">
            
            <!-- Full Name -->
            <div class="col-md-6 mb-3">
              <label for="teacherName" class="form-label fw-semibold">Full Name</label>
              <input type="text" class="form-control form-control-lg" id="teacherName" name="teacher_name" placeholder="Enter full name" required>
            </div>

            <!-- Subjects -->
            <div class="col-md-6 mb-3">
              <label for="teacherSubjects" class="form-label fw-semibold">Subjects</label>
              <input type="text" class="form-control form-control-lg" id="teacherSubjects" name="teacher_subjects" placeholder="e.g. English, Math" required>
            </div>

            <!-- Classes -->
            <div class="col-12 mb-3">
              <label class="form-label fw-semibold">Classes Taught</label>
              <div id="classLists">
                <div class="input-group mb-2">
                  <input type="text" value="Classes " class="form-control" id="teacherClass1" name="teacher_classes[]" placeholder="e.g. Form 4 – Science">
                 
                </div>
              </div>
            </div>

            <!-- Email -->
            <div class="col-md-6 mb-3">
              <label for="teacherEmail" class="form-label fw-semibold">Email</label>
              <input type="email" class="form-control form-control-lg" id="teacherEmail" name="teacher_email" placeholder="Enter email" required>
            </div>

            <!-- Phone -->
            <div class="col-md-6 mb-3">
              <label for="teacherPhone" class="form-label fw-semibold">Phone</label>
              <input type="text" class="form-control form-control-lg" id="teacherPhone" name="teacher_phone" placeholder="Enter phone number" required>
            </div>

            <!-- Status -->
            <div class="col-md-6 mb-3">
              <label for="teacherStatus" class="form-label fw-semibold">Status</label>
              <select class="form-select form-select-lg" id="teacherStatus" name="teacher_status" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
            </div>

            <!-- Photo -->
            <div class="col-md-6 mb-3">
              <label for="teacherPhoto" class="form-label fw-semibold">Upload Photo</label>
              <input type="file" class="form-control form-control-lg" id="teacherPhoto" name="teacher_photo" accept="image/*">
            </div>

            <!-- National ID -->
            <div class="col-md-6 mb-3">
              <label for="teacherNationalID" class="form-label fw-semibold">National ID</label>
              <input type="text" class="form-control form-control-lg" id="teacherNationalID" name="teacher_national_id" placeholder="Enter national ID number">
            </div>

            <!-- Salary -->
            <div class="col-md-6 mb-3">
              <label for="teacherSalary" class="form-label fw-semibold">Salary (USD)</label>
              <input type="number" class="form-control form-control-lg" id="teacherSalary" name="teacher_salary" placeholder="e.g. 500">
            </div>
          </div>

          <!-- Buttons -->
          <div class="text-end mt-3">
            <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary px-4">
              <i data-feather="save" class="me-1"></i> Save Teacher
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>



     <!-- Edit Teacher Modal -->
<div class="modal fade" id="editTeacherModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-warning text-white rounded-top-4">
        <h5 class="modal-title"><i class="fas fa-edit me-2"></i> Edit Teacher</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="editTeacherForm" enctype="multipart/form-data">
          <input type="hidden" id="editTeacherID" name="teacher_id">

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Full Name</label>
              <input type="text" class="form-control" id="editTeacherName" name="teacher_name" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Subjects</label>
              <input type="text" class="form-control" id="editTeacherSubjects" name="teacher_subjects" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Email</label>
              <input type="email" class="form-control" id="editTeacherEmail" name="teacher_email" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Phone</label>
              <input type="text" class="form-control" id="editTeacherPhone" name="teacher_phone" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Classes</label>
              <input type="text" class="form-control" id="editTeacherClasses" name="teacher_classes[]" required>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Status</label>
              <select class="form-select" id="editTeacherStatus" name="teacher_status">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">National ID</label>
              <input type="text" class="form-control" id="editTeacherNational" name="teacher_national_id">
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Salary</label>
              <input type="number" class="form-control" id="editTeacherSalary" name="teacher_salary">
            </div>

            <div class="col-md-12 mb-3">
              <label class="form-label fw-semibold">Profile Photo</label>
              <input type="file" class="form-control" id="editTeacherPhoto" name="teacher_photo" accept="image/*">
            </div>
          </div>

          <div class="text-end mt-3">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-warning text-white">
              <i class="fas fa-save me-1"></i> Save Changes
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


    </div>
  </div>
</div>


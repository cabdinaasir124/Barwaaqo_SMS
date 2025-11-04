<div class="content-page">
  <div class="content">
    <div class="container-fluid py-4">

      <h4 class="text-primary mb-3"><i class="fas fa-user-plus me-2"></i> Register New Student</h4>

      <div class="card shadow-sm border-0">
        <div class="card-body">
          <form id="studentForm">
            <div class="row g-3">

              <!-- Personal Information -->
              <h5 class="text-primary mt-3 mb-2">Personal Information</h5>
              <div class="col-md-6">
                <label class="form-label">Full Name</label>
                <input type="text" name="full_name" class="form-control" required placeholder="Enter full name">
              </div>

              <div class="col-md-3">
                <label class="form-label">Gender</label>
                <select name="gender" class="form-select" required>
                  <option selected disabled>Choose...</option>
                  <option>Male</option>
                  <option>Female</option>
                </select>
              </div>

              <div class="col-md-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="dob" class="form-control" required>
              </div>

              <div class="col-md-4">
                <label class="form-label">Nationality</label>
                <input type="text" name="nationality" class="form-control" placeholder="e.g. Somali">
              </div>

              <div class="col-md-4">
                <label class="form-label">Religion</label>
                <input type="text" name="religion" class="form-control" value="Islam">
              </div>

              <div class="col-md-4">
                <label class="form-label">Orphan Status</label>
                <select name="orphan_status" class="form-select">
                  <option selected disabled>Choose...</option>
                  <option>Yes (Father Deceased)</option>
                  <option>Yes (Mother Deceased)</option>
                  <option>Yes (Both Deceased)</option>
                  <option>No</option>
                </select>
              </div>

              <!-- Academic Information -->
              <h5 class="text-primary mt-4 mb-2">Academic Information</h5>
              <div class="col-md-4">
                <label class="form-label">Admission Number</label>
                <input type="text" name="admission_no" class="form-control" placeholder="Auto or manual entry">
              </div>

              <div class="col-md-4">
                <label class="form-label">Class</label>
                <select name="class" class="form-select" required>
                  <option>Class 1</option>
                  <option>Class 2</option>
                  <option>Class 3</option>
                  <option>Form 1</option>
                  <option>Form 2</option>
                  <option>Form 3</option>
                  <option>Form 4</option>
                </select>
              </div>

              <div class="col-md-4">
                <label class="form-label">Admission Date</label>
                <input type="date" name="admission_date" class="form-control">
              </div>

              <!-- Guardian Information -->
              <h5 class="text-primary mt-4 mb-2">Guardian Information</h5>
              <div class="col-md-6">
                <label class="form-label">Guardian Name</label>
                <input type="text" name="guardian_name" class="form-control" placeholder="Enter guardian full name">
              </div>

              <div class="col-md-3">
                <label class="form-label">Relationship</label>
                <select name="guardian_relationship" class="form-select">
                  <option>Father</option>
                  <option>Mother</option>
                  <option>Uncle</option>
                  <option>Aunt</option>
                  <option>Other</option>
                </select>
              </div>

              <div class="col-md-3">
                <label class="form-label">Guardian Contact</label>
                <input type="text" name="guardian_contact" class="form-control" placeholder="Phone number">
              </div>

              <div class="col-md-6">
                <label class="form-label">Guardian Occupation</label>
                <input type="text" name="guardian_occupation" class="form-control" placeholder="e.g. Teacher, Trader">
              </div>

              <div class="col-md-6">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" placeholder="Enter residential address">
              </div>

              <!-- Health Information -->
              <h5 class="text-primary mt-4 mb-2">Health Information</h5>
              <div class="col-md-6">
                <label class="form-label">Known Medical Conditions</label>
                <input type="text" name="medical_conditions" class="form-control" placeholder="e.g. Asthma, Allergy">
              </div>

              <div class="col-md-6">
                <label class="form-label">Emergency Contact</label>
                <input type="text" name="emergency_contact" class="form-control" placeholder="Phone number for emergencies">
              </div>

              <!-- Submit -->
              <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary px-4">
                  <i class="fas fa-save me-2"></i> Save Student
                </button>
                <a href="student-list.php" class="btn btn-outline-secondary ms-2 px-4">
                  <i class="fas fa-arrow-left"></i> Back
                </a>
              </div>

            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>

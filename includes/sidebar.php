<!-- Left Sidebar Start -->
<div class="app-sidebar-menu">
  <div class="h-100" data-simplebar>

    <!-- Sidebar Menu -->
    <div id="sidebar-menu">

      <!-- Logo -->
      <div class="logo-box text-center py-3">
        <a href="dashboard.php" class="logo logo-dark">
          <span class="logo-sm">
            <img src="../assets/images/Fathuraman_logo.png" alt="logo" height="80">
          </span>
          <span class="logo-lg">
            <img src="../assets/images/Fathuraman_logo.png" alt="logo" height="80">
          </span>
        </a>
      </div>

      <ul id="side-menu">

        <!-- Dashboard -->
        <li class="mt-5">
          <a href="../Admin" class="tp-link">
            <i data-feather="home"></i>
            <span>Dashboard</span>
          </a>
        </li>

        <!-- Academics -->
        <li>
          <a href="#sidebarAcademics" data-bs-toggle="collapse" class="d-flex align-items-center">
            <i data-feather="book-open" class="me-2"></i>
            <span>Academics</span>
            <i class="ms-auto" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="sidebarAcademics">
            <ul class="nav-second-level ps-3">
              <li><a href="../Admin/subjects.php" class="tp-link">Subjects</a></li>
              <li><a href="../Admin/classes.php" class="tp-link">Classes</a></li>
              <li><a href="timetable.php" class="tp-link">Timetable</a></li>
            </ul>
          </div>
        </li>

        <!-- Exams & Results -->
        <li>
          <a href="#sidebarExams" data-bs-toggle="collapse" class="d-flex align-items-center">
            <i data-feather="clipboard" class="me-2"></i>
            <span>Exams & Results</span>
            <i class="ms-auto" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="sidebarExams">
            <ul class="nav-second-level ps-3">
              <li><a href="exam-hall.php" class="tp-link">Exam Halls</a></li>
              <li><a href="exam-list.php" class="tp-link">Exams</a></li>
              <li><a href="student-position.php" class="tp-link">Student Positions</a></li>
              <li><a href="result-generator.php" class="tp-link">Result Generator</a></li>
              <li><a href="exam-reports.php" class="tp-link">Exam Reports</a></li>
            </ul>
          </div>
        </li>

        <!-- Grading -->
        <li>
          <a href="#sidebarGrading" data-bs-toggle="collapse" class="d-flex align-items-center">
            <i data-feather="award" class="me-2"></i>
            <span>Grading</span>
            <i class="ms-auto" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="sidebarGrading">
            <ul class="nav-second-level ps-3">
              <li><a href="grading-scale.php" class="tp-link">Grading Scale</a></li>
              <li><a href="grade-setup.php" class="tp-link">Grade Setup</a></li>
              <li><a href="grade-reports.php" class="tp-link">Grade Reports</a></li>
            </ul>
          </div>
        </li>

        <!-- Students -->
        <li>
          <a href="#sidebarStudents" data-bs-toggle="collapse" class="d-flex align-items-center">
            <i data-feather="users" class="me-2"></i>
            <span>Students</span>
            <i class="ms-auto" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="sidebarStudents">
            <ul class="nav-second-level ps-3">
              <li><a href="../Admin/student-list.php" class="tp-link">Student List</a></li>
              <li><a href="../Admin/admissions.php" class="tp-link">Admissions</a></li>
              <li><a href="attendance.php" class="tp-link">Attendance</a></li>
              <li><a href="student-performance.php" class="tp-link">Performance</a></li>
            </ul>
          </div>
        </li>

        <!-- Teachers -->
        <li>
          <a href="#sidebarTeachers" data-bs-toggle="collapse" class="d-flex align-items-center">
            <i data-feather="user-check" class="me-2"></i>
            <span>Teachers</span>
            <i class="ms-auto" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="sidebarTeachers">
            <ul class="nav-second-level ps-3">
              <li><a href="../Admin/teacher-list.php" class="tp-link">Teacher List</a></li>
              <li><a href="assign-subjects.php" class="tp-link">Assign Subjects</a></li>
              <li><a href="teacher-attendance.php" class="tp-link">Attendance</a></li>
              <li><a href="payroll.php" class="tp-link">Payroll</a></li>
            </ul>
          </div>
        </li>

        <!-- Finance -->
        <li>
          <a href="#sidebarFinance" data-bs-toggle="collapse" class="d-flex align-items-center">
            <i data-feather="credit-card" class="me-2"></i>
            <span>Finance</span>
            <i class="ms-auto" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="sidebarFinance">
            <ul class="nav-second-level ps-3">
              <li><a href="fees.php" class="tp-link">Fees</a></li>
              <li><a href="invoices.php" class="tp-link">Invoices</a></li>
              <li><a href="payments.php" class="tp-link">Payments</a></li>
              <li><a href="expenses.php" class="tp-link">Expenses</a></li>
              <li><a href="financial-reports.php" class="tp-link">Reports</a></li>
            </ul>
          </div>
        </li>

        <!-- Communication -->
        <li>
          <a href="#sidebarCommunication" data-bs-toggle="collapse" class="d-flex align-items-center">
            <i data-feather="message-square" class="me-2"></i>
            <span>Communication</span>
            <i class="ms-auto" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="sidebarCommunication">
            <ul class="nav-second-level ps-3">
              <li><a href="messages.php" class="tp-link">Messages</a></li>
              <li><a href="announcements.php" class="tp-link">Announcements</a></li>
              <li><a href="notifications.php" class="tp-link">Notifications</a></li>
              <li><a href="events.php" class="tp-link">Events</a></li>
            </ul>
          </div>
        </li>

        <!-- Administration -->
        <li>
          <a href="#sidebarAdmin" data-bs-toggle="collapse" class="d-flex align-items-center">
            <i data-feather="settings" class="me-2"></i>
            <span>Administration</span>
            <i class="ms-auto" data-feather="chevron-down"></i>
          </a>
          <div class="collapse" id="sidebarAdmin">
            <ul class="nav-second-level ps-3">
              <li><a href="user-roles.php" class="tp-link">User Roles</a></li>
              <li><a href="permissions.php" class="tp-link">Permissions</a></li>
              <li><a href="../Admin/academic-year.php" class="tp-link">Academic Year</a></li>
              <li><a href="backup.php" class="tp-link">Backup & Restore</a></li>
              <li><a href="system-settings.php" class="tp-link">System Settings</a></li>
            </ul>
          </div>
        </li>

      </ul>

      <!-- Sidebar Footer / App Info -->
      <hr class="my-3">

      <div class="px-3 mb-3 text-center">
        <div class="mb-2">
          <span class="badge bg-warning-subtle text-warning fw-semibold rounded-pill py-1 px-2">Pro Version</span>
        </div>
        <p class="mb-1 text-muted fs-12">Fathurahman Al-Azhar</p>
        <p class="mb-1 text-muted fs-12">Powered by Barwaaqo ICT Solutions</p>
        <p class="mb-0 text-muted fs-12">Version 2.3.1</p>
        <a href="upgrade.php" class="btn btn-sm btn-primary mt-2 w-100">Upgrade Now</a>
      </div>

    </div>
    <!-- End Sidebar -->

  </div>
</div>
<!-- Left Sidebar End -->

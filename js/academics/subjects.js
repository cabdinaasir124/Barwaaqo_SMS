$(document).ready(function () {
  // === Initialize DataTable ===
  const table = $("#subjects-datatable").DataTable({
  dom:
    "<'row mb-3'<'col-sm-6'l><'col-sm-6 text-end'B>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row mt-3'<'col-sm-5'i><'col-sm-7'p>>",
  buttons: [
    {
      extend: "print",
      text: '<i class="fas fa-print"></i> Print',
      className: "btn btn-outline-primary btn-sm",
      title: "", // Remove default title
      exportOptions: {
        columns: [0, 1, 2, 3, 4], // Exclude edit/delete buttons
      },
      customize: function (win) {
        const now = new Date();
        const formattedDate = now.toLocaleDateString();

        // Custom print layout
        $(win.document.body)
          .css("font-family", "Poppins, sans-serif")
          .css("font-size", "14px")
          .css("color", "#212529")
          .prepend(`
            <div style="text-align:center; margin-bottom:20px;">
              <h2 style="margin-bottom:5px; color:#0d6efd;">BARWAAQO ICT SOLUTIONS</h2>
              <h5 style="margin:0; color:#555;">Subjects Management Report</h5>
              <p style="font-size:13px; color:#777;">Printed on: ${formattedDate}</p>
              <hr style="border:1px solid #061a38ff; width:80%; margin:auto;">
            </div>
          `);

        // Beautify table
        $(win.document.body)
          .find("table")
          .addClass("compact")
          .css("font-size", "13px")
          .css("width", "100%")
          .css("border-collapse", "collapse");

        $(win.document.body)
          .find("table th, table td")
          .css("border", "1px solid #ccc")
          .css("padding", "8px");
      },
    },
    {
      extend: "excel",
      text: '<i class="fas fa-file-excel"></i> Export Excel',
      className: "btn btn-outline-success btn-sm",
      title: "Subjects_List_Barwaaqo_School", // Custom Excel file name
      filename: "Subjects_List_Barwaaqo_School", // File name without unwanted text
      exportOptions: {
        columns: [0, 1, 2, 3, 4],
      },
    },
  ],
  language: {
    search: "_INPUT_",
    searchPlaceholder: "Search subjects...",
  },
});


  // === Initial Data Load ===
  fetchSubjects();
  fetchClasses();
  fetchTeachers();
  populateClassFilter();

  // === Fetch All Subjects ===
  function fetchSubjects() {
    $.ajax({
      type: "POST",
      url: "/SMS_BARWAAQO/controller/api/academics/subject_api.php",
      data: JSON.stringify({ action: "fetchAll" }),
      dataType: "json",
      contentType: "application/json",
      success: function (response) {
        if (response.status === "success") {
          renderSubjectsTable(response.data);
        } else {
          $("#subjects-datatable tbody").html(
            '<tr><td colspan="6" class="text-center text-muted">No subjects found.</td></tr>'
          );
        }
      },
    });
  }

  // === Render Subjects to DataTable ===
  function renderSubjectsTable(subjects) {
    table.clear();
    subjects.forEach((subject) => {
      const statusBadge =
        subject.status === "Active"
          ? '<span class="badge bg-success-subtle text-success">Active</span>'
          : '<span class="badge bg-danger-subtle text-danger">Inactive</span>';

      const actions = `
        <button class="btn btn-sm btn-outline-primary me-1 edit-btn" 
          data-id="${subject.id}" 
          data-name="${subject.subject_name}" 
          data-code="${subject.subject_code}" 
          data-status="${subject.status}">
          <i data-feather="edit-2"></i>
        </button>
        <button class="btn btn-sm btn-outline-danger delete-btn-subject" data-id="${subject.id}">
          <i data-feather="trash"></i>
        </button>
      `;

      table.row.add([
        subject.subject_name,
        subject.subject_code,
        subject.class_name,
        subject.teacher_name,
        statusBadge,
        actions,
      ]);
    });
    table.draw();
    feather.replace();
  }

  // === Populate Class Filter Dropdown ===
  function populateClassFilter() {
    $.ajax({
      type: "POST",
      url: "/SMS_BARWAAQO/controller/api/academics/subject_api.php",
      data: JSON.stringify({ action: "fetchClasses" }),
      dataType: "json",
      contentType: "application/json",
      success: function (response) {
        if (response.status === "success") {
          let options = '<option value="">All Classes</option>';
          response.data.forEach((cls) => {
            options += `<option value="${cls.class_name}">${cls.class_name} (${cls.class_code})</option>`;
          });
          $("#filterClass").html(options);
        }
      },
    });
  }

  // === Filter Subjects by Class ===
  $("#filterClass").on("change", function () {
    const selectedClass = $(this).val();
    $.ajax({
      type: "POST",
      url: "/SMS_BARWAAQO/controller/api/academics/subject_api.php",
      data: JSON.stringify({ action: "fetchAll" }),
      dataType: "json",
      contentType: "application/json",
      success: function (response) {
        if (response.status === "success") {
          let filteredSubjects = response.data;
          if (selectedClass) {
            filteredSubjects = filteredSubjects.filter(
              (sub) => sub.class_name === selectedClass
            );
          }
          renderSubjectsTable(filteredSubjects);
        }
      },
    });
  });

  // === Print Subjects ===
  $("#printSubjects").on("click", function () {
    table.button(".buttons-print").trigger();
  });

  // === Fetch Classes for Add Modal ===
  function fetchClasses() {
    $.ajax({
      type: "POST",
      url: "/SMS_BARWAAQO/controller/api/academics/subject_api.php",
      data: JSON.stringify({ action: "fetchClasses" }),
      dataType: "json",
      contentType: "application/json",
      success: function (response) {
        if (response.status === "success") {
          let options = '<option value="">Select Class</option>';
          response.data.forEach((cls) => {
            options += `<option value="${cls.class_name}">${cls.class_name} (${cls.class_code})</option>`;
          });
          $("#addSubjectModal select.class-select").html(options);
        }
      },
    });
  }

  // === Fetch Teachers for Add Modal ===
  function fetchTeachers() {
    $.ajax({
      type: "POST",
      url: "/SMS_BARWAAQO/controller/api/academics/subject_api.php",
      data: JSON.stringify({ action: "fetchTeachers" }),
      dataType: "json",
      contentType: "application/json",
      success: function (response) {
        if (response.status === "success") {
          let options = '<option value="">Select Teacher</option>';
          response.data.forEach((teacher) => {
            options += `<option value="${teacher.full_name}">${teacher.full_name}</option>`;
          });
          $("#addSubjectModal select.teacher-select").html(options);
        }
      },
    });
  }

  // === Auto-generate Subject Code ===
  $("#addSubjectModal input[placeholder='Enter subject name']").on("input", function () {
    const name = $(this).val().trim();
    const code = name ? name.substring(0, 3).toUpperCase() + "101" : "";
    $("#subject_code").val(code);
  });

  // === Add New Subject ===
  $("#addSubjectModal form").on("submit", function (e) {
    e.preventDefault();
    const data = {
      action: "addSubject",
      subject_name: $(this).find("input[placeholder='Enter subject name']").val(),
      class_name: $(this).find("select.class-select").val(),
      teacher_name: $(this).find("select.teacher-select").val(),
      status: $(this).find("select.status-select").val(),
    };

    $.ajax({
      type: "POST",
      url: "/SMS_BARWAAQO/controller/api/academics/subject_api.php",
      data: JSON.stringify(data),
      dataType: "json",
      contentType: "application/json",
      success: function (response) {
        Swal.fire({
          icon: response.status,
          title: response.status === "success" ? "Success" : "Error",
          text: response.message,
          timer: 1500,
          showConfirmButton: false,
        });
        if (response.status === "success") {
          $("#addSubjectModal").modal("hide");
          fetchSubjects();
        }
      },
    });
  });

  // === Edit Subject ===
  $(document).on("click", ".edit-btn", function () {
    const id = $(this).data("id");
    const name = $(this).data("name");
    const code = $(this).data("code");
    const status = $(this).data("status");

    $("#editSubjectModal .subject-name").val(name);
    $("#editSubjectModal .subject-code").val(code);
    $("#editSubjectModal .status-select").val(status);
    $("#editSubjectModal").data("id", id).modal("show");
  });

  // === Update Subject ===
  $("#editSubjectModal form").on("submit", function (e) {
    e.preventDefault();
    const id = $("#editSubjectModal").data("id");
    const name = $(this).find(".subject-name").val();
    const code = $(this).find(".subject-code").val();
    const status = $(this).find(".status-select").val();

    $.ajax({
      type: "POST",
      url: "/SMS_BARWAAQO/controller/api/academics/subject_api.php",
      data: JSON.stringify({
        action: "updateSubject",
        id,
        subject_name: name,
        subject_code: code,
        status,
      }),
      dataType: "json",
      contentType: "application/json",
      success: function (response) {
        Swal.fire({
          icon: response.status,
          title: response.status === "success" ? "Updated!" : "Error",
          text: response.message,
          timer: 1500,
          showConfirmButton: false,
        });
        if (response.status === "success") {
          $("#editSubjectModal").modal("hide");
          fetchSubjects();
        }
      },
    });
  });

  // === Delete Subject ===
  $(document).on("click", ".delete-btn-subject", function () {
    const id = $(this).data("id");
    if (!id) {
      Swal.fire("Error", "Invalid subject ID!", "error");
      return;
    }

    Swal.fire({
      title: "Are you sure?",
      text: "This will permanently delete the subject!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "/SMS_BARWAAQO/controller/api/academics/subject_api.php",
          data: JSON.stringify({ action: "deleteSubject", id }),
          dataType: "json",
          contentType: "application/json",
          success: function (response) {
            Swal.fire({
              icon: response.status,
              title: response.status === "success" ? "Deleted!" : "Error",
              text: response.message,
              timer: 1500,
              showConfirmButton: false,
            });
            if (response.status === "success") fetchSubjects();
          },
        });
      }
    });
  });
});

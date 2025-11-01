$(document).ready(function () {
  // === Initialize DataTable ===
  const table = $("#classes-datatable").DataTable({
    dom:
      "<'row mb-3'<'col-sm-6'l><'col-sm-6 text-end'B>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row mt-3'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [
      {
        extend: "print",
        text: '<i class="fas fa-print"></i> Print',
        className: "btn btn-outline-primary btn-sm",
        title: "",
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5], // Exclude actions
        },
        customize: function (win) {
          const now = new Date();
          const formattedDate = now.toLocaleDateString();

          $(win.document.body)
            .css("font-family", "Poppins, sans-serif")
            .css("font-size", "13px")
            .css("color", "#212529")
            .prepend(`
              <div style="text-align:center; margin-bottom:20px;">
                <h2 style="color:#0d6efd; margin-bottom:5px;">Barwaaqo Modern School</h2>
                <h5 style="margin:0; color:#555;">Classes Management Report</h5>
                <p style="font-size:13px; color:#777;">Printed on: ${formattedDate}</p>
                <hr style="border:1px solid #0d6efd; width:80%; margin:auto;">
              </div>
            `);

          $(win.document.body)
            .find("table")
            .addClass("compact")
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
        title: "Classes_List_Barwaaqo_School",
        filename: "Classes_List_Barwaaqo_School",
        exportOptions: {
          columns: [0, 1, 2, 3, 4, 5],
        },
      },
    ],
    language: {
      search: "_INPUT_",
      searchPlaceholder: "Search classes...",
    },
  });

  // === Fetch All Classes ===
  function fetchClasses() {
    $.ajax({
      type: "POST",
      url: "/SMS_BARWAAQO/controller/api/academics/classes_api.php",
      data: JSON.stringify({ action: "fetchAll" }),
      dataType: "json",
      contentType: "application/json",
      success: function (res) {
        if (res.status === "success") {
          renderClasses(res.data);
        } else {
          Swal.fire("Error", res.message, "error");
        }
      },
      error: function () {
        Swal.fire("Error", "Failed to fetch classes", "error");
      },
    });
  }

  // === Render Classes to DataTable ===
  function renderClasses(classes) {
    table.clear();
    classes.forEach((cls) => {
      const statusBadge =
        cls.status === "Active"
          ? '<span class="badge bg-success-subtle text-success">Active</span>'
          : '<span class="badge bg-danger-subtle text-danger">Inactive</span>';

      const actions = `
        <button class="btn btn-sm btn-outline-primary me-1 edit-btn" data-id="${cls.id}">
          <i data-feather="edit-2"></i>
        </button>
        <button class="btn btn-sm btn-outline-danger delete-btn" data-id="${cls.id}">
          <i data-feather="trash"></i>
        </button>
      `;

      table.row.add([
        cls.class_name,
        cls.class_code,
        cls.section,
        cls.class_teacher,
        cls.max_students,
        statusBadge,
        actions,
      ]);
    });
    table.draw();
    feather.replace();
  }

  // === Fetch Active Teachers ===
  function fetchTeachers(selectId) {
    $.ajax({
      type: "POST",
      url: "/SMS_BARWAAQO/controller/api/academics/classes_api.php",
      data: JSON.stringify({ action: "fetchTeachers" }),
      dataType: "json",
      contentType: "application/json",
      success: function (res) {
        if (res.status === "success") {
          let options = '<option value="">Select Teacher</option>';
          res.data.forEach((t) => {
            options += `<option value="${t.full_name}">${t.full_name}</option>`;
          });
          $(selectId).html(options);
        }
      },
    });
  }

  // === Generate Class Code ===
  function generateClassCode() {
    $.ajax({
      type: "POST",
      url: "/SMS_BARWAAQO/controller/api/academics/classes_api.php",
      data: JSON.stringify({ action: "generateCode" }),
      dataType: "json",
      contentType: "application/json",
      success: function (res) {
        if (res.status === "success") $("#classCode").val(res.data.code);
      },
    });
  }

  // === Show Add Modal ===
  $("#addClassModal").on("show.bs.modal", function () {
    fetchTeachers("#classTeacher");
    generateClassCode();
  });

  // === ADD CLASS ===
  $("#addClassForm").on("submit", function (e) {
    e.preventDefault();
    const formData = {
      action: "add",
      class_name: $("#className").val(),
      class_code: $("#classCode").val(),
      section: $("#section").val(),
      teacher_name: $("#classTeacher").val(),
      max_students: $("#maxStudents").val(),
      status: $("#status").val(),
    };

    $.ajax({
      type: "POST",
      url: "/SMS_BARWAAQO/controller/api/academics/classes_api.php",
      data: JSON.stringify(formData),
      dataType: "json",
      contentType: "application/json",
      success: function (res) {
        if (res.status === "success") {
          $("#addClassModal").modal("hide");
          $("#addClassForm")[0].reset();
          fetchClasses();
          Swal.fire("Success", res.message, "success");
        } else {
          Swal.fire("Error", res.message, "error");
        }
      },
    });
  });

  // === OPEN EDIT MODAL ===
  $(document).on("click", ".edit-btn", function () {
    const id = $(this).data("id");

    $.ajax({
      type: "POST",
      url: "/SMS_BARWAAQO/controller/api/academics/classes_api.php",
      data: JSON.stringify({ action: "fetchAll" }),
      dataType: "json",
      contentType: "application/json",
      success: function (res) {
        if (res.status === "success") {
          const cls = res.data.find((c) => c.id == id);
          if (!cls) return;

          $("#editId").val(cls.id);
          $("#editClassName").val(cls.class_name);
          $("#editClassCode").val(cls.class_code);
          $("#editSection").val(cls.section);
          $("#editMaxStudents").val(cls.max_students);
          $("#editStatus").val(cls.status);

          fetchTeachers("#editClassTeacher");
          setTimeout(() => {
            $("#editClassTeacher").val(cls.class_teacher);
          }, 300);

          $("#editClassModal").modal("show");
        }
      },
    });
  });

  // === UPDATE CLASS ===
  $("#editClassForm").on("submit", function (e) {
    e.preventDefault();
    const data = {
      action: "update",
      id: $("#editId").val(),
      class_name: $("#editClassName").val(),
      class_code: $("#editClassCode").val(),
      section: $("#editSection").val(),
      teacher_name: $("#editClassTeacher").val(),
      max_students: $("#editMaxStudents").val(),
      status: $("#editStatus").val(),
    };

    $.ajax({
      type: "POST",
      url: "/SMS_BARWAAQO/controller/api/academics/classes_api.php",
      data: JSON.stringify(data),
      dataType: "json",
      contentType: "application/json",
      success: function (res) {
        if (res.status === "success") {
          $("#editClassModal").modal("hide");
          fetchClasses();
          Swal.fire("Updated", res.message, "success");
        } else {
          Swal.fire("Error", res.message, "error");
        }
      },
    });
  });

  // === DELETE CLASS ===
  $(document).on("click", ".delete-btn", function () {
    const id = $(this).data("id");

    Swal.fire({
      title: "Are you sure?",
      text: "This will permanently delete the class!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "/SMS_BARWAAQO/controller/api/academics/classes_api.php",
          data: JSON.stringify({ action: "delete", id }),
          dataType: "json",
          contentType: "application/json",
          success: function (res) {
            if (res.status === "success") {
              fetchClasses();
              Swal.fire("Deleted!", res.message, "success");
            } else {
              Swal.fire("Error", res.message, "error");
            }
          },
        });
      }
    });
  });

  // === Initial Load ===
  fetchClasses();
});

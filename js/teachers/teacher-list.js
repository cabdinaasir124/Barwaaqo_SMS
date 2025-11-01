$(document).ready(function () {

  // === Fetch All Teachers ===
  fetchTeachers();

function fetchTeachers() {
  $.ajax({
    type: "POST",
    url: "/SMS_BARWAAQO/controller/api/teachers/teacher_api.php",
    data: JSON.stringify({ action: "fetchAll" }),
    dataType: "json",
    contentType: "application/json",
   success: function (response) {
  if (response.status === "success") {
    renderTeachers(response.data);
    $("#teacherCount").text(response.data.length);

    // ✅ Initialize or reinitialize DataTable
    if ($.fn.DataTable.isDataTable("#TeacherTable")) {
      $("#TeacherTable").DataTable().clear().destroy();
    }
    $("#TeacherTable").DataTable({
      pageLength: 10,
      responsive: true,
      order: [[1, "asc"]],
    });
  } else {
    $("#TeacherBody").html(`<tr><td colspan="10" class="text-center text-muted py-3">${response.message}</td></tr>`);
    $("#teacherCount").text("0");
  }
}

  });
}

// Render table rows dynamically
function renderTeachers(teachers) {
  let tbody = $("#TeacherBody");
  tbody.empty();

  teachers.forEach((teacher) => {
    let row = `
      <tr>
        <td><img src="${teacher.profile_image}" class="rounded-circle" width="45" height="45" alt="Profile"></td>
        <td>${teacher.full_name}<br><small class="text-muted">${teacher.designation}</small></td>
        <td>${teacher.national_id}</td>
        
        <td>${teacher.classes}</td>
        <td>${teacher.email}</td>
        <td>${teacher.phone}</td>
        <td><span class="badge ${teacher.status === 'Active' ? 'bg-success' : 'bg-danger'}">${teacher.status}</span></td>
        <td>$${teacher.salary}</td>
        <td class="text-center">
          <button class="btn btn-sm btn-primary editTeacherBtn" 
  data-id="${teacher.id}" 
  data-name="${teacher.full_name}" 
  data-email="${teacher.email}" 
  data-phone="${teacher.phone}" 
  data-designation="${teacher.designation}" 
  data-classes="${teacher.classes}" 
  data-status="${teacher.status}" 
  data-salary="${teacher.salary}" 
  data-national="${teacher.national_id}" 
  data-image="${teacher.profile_image}">
  <i class="fas fa-pencil"></i>
</button>

          <button class="btn btn-sm btn-danger deleteTeacherBtn" data-id="${teacher.id}">
            <i class="fas fa-trash"></i>
          </button>
        </td>
      </tr>
    `;
    tbody.append(row);
  });
}


  // === Add Teacher Form Submit ===
  $(document).on("submit", "#addTeacherForm", function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("action", "add_teacher");

    Swal.fire({
      title: "Please wait...",
      text: "Sending data to server...",
      allowOutsideClick: false,
      didOpen: () => {
        Swal.showLoading();
      },
    });

    $.ajax({
      type: "POST",
      url: "/SMS_BARWAAQO/controller/api/teachers/teacher_api.php",
      data: formData,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        Swal.close();
        if (response.status === "success") {
          Swal.fire({
            icon: "success",
            title: "Teacher Added!",
            text: "The teacher has been successfully added.",
            timer: 1800,
            showConfirmButton: false
          });

          $("#addTeacherForm")[0].reset();
          $("#addTeacherModal").modal("hide");
          fetchTeachers();
        } else {
          Swal.fire("Error", response.message || "Something went wrong.", "error");
        }
      },
      error: function (xhr, status, error) {
        Swal.close();
        Swal.fire("Error", "Failed to send request: " + error, "error");
        console.error("AJAX Error:", xhr.responseText);
      }
    });
  });


  // === Handle Delete Teacher ===
$(document).on("click", ".deleteTeacherBtn", function () {
  const teacherId = $(this).data("id");

  Swal.fire({
    title: "Are you sure?",
    text: "This action cannot be undone!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#6c757d",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "/SMS_BARWAAQO/controller/api/teachers/teacher_api.php",
        data: JSON.stringify({ action: "delete_teacher", id: teacherId }),
        dataType: "json",
        contentType: "application/json",
        success: function (response) {
          if (response.status === "success") {
            Swal.fire({
              icon: "success",
              title: "Deleted!",
              text: "Teacher has been removed.",
              timer: 1500,
              showConfirmButton: false
            });
            fetchTeachers(); // Refresh list
          } else {
            Swal.fire("Error", response.message || "Failed to delete teacher.", "error");
          }
        },
        error: function (xhr, status, error) {
          Swal.fire("Error", "Request failed: " + error, "error");
        }
      });
    }
  });
});
  
  
  // === Open Edit Modal ===
$(document).on("click", ".editTeacherBtn", function () {
  const teacher = $(this).data();

  $("#editTeacherID").val(teacher.id);
  $("#editTeacherName").val(teacher.name);
  $("#editTeacherSubjects").val(teacher.designation);
  $("#editTeacherEmail").val(teacher.email);
  $("#editTeacherPhone").val(teacher.phone);
  $("#editTeacherClasses").val(teacher.classes);
  $("#editTeacherStatus").val(teacher.status);
  $("#editTeacherNational").val(teacher.national);
  $("#editTeacherSalary").val(teacher.salary);

  $("#editTeacherModal").modal("show");
});

// === Submit Edit Form ===
$(document).on("submit", "#editTeacherForm", function (e) {
  e.preventDefault();

  const formData = new FormData(this);
  formData.append("action", "update_teacher");

  Swal.fire({
    title: "Updating...",
    text: "Saving teacher details...",
    allowOutsideClick: false,
    didOpen: () => Swal.showLoading(),
  });

  $.ajax({
    type: "POST",
    url: "/SMS_BARWAAQO/controller/api/teachers/teacher_api.php",
    data: formData,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function (response) {
      Swal.close();

      if (response.status === "success") {
        Swal.fire({
          icon: "success",
          title: "Updated!",
          text: "Teacher details updated successfully.",
          timer: 1500,
          showConfirmButton: false,
        });

        $("#editTeacherModal").modal("hide");
        fetchTeachers(); // reload list
      } else {
        Swal.fire("Error", response.message || "Failed to update.", "error");
      }
    },
    error: function (xhr, status, error) {
      Swal.close();
      Swal.fire("Error", "AJAX request failed: " + error, "error");
      console.error(xhr.responseText);
    }
  });
});



});

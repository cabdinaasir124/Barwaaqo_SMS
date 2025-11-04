 
<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col fs-13 text-muted text-center">
                &copy; <script>document.write(new Date().getFullYear())</script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="#!" class="text-reset fw-semibold">Barwaaqo ICT solutions</a> 
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->
 <!-- Vendor -->
<script src="../assets/libs/jquery/jquery.min.js"></script>
<script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/libs/simplebar/simplebar.min.js"></script>
<script src="../assets/libs/node-waves/waves.min.js"></script>
<script src="../assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="../assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
<script src="../assets/libs/feather-icons/feather.min.js"></script>
<!-- Apexcharts JS -->
<script src="../assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- custom js links -->
<script src="../js/teachers/teacher-list.js"></script>
<script src="../js/academics/subjects.js"></script>
<script src="../js/academics/classes.js"></script>
<script src="../js/academics/timetable.js"></script>
<script src="../js/academics/academic-year.js"></script>
<!-- Widgets Init Js -->
<script src="../assets/js/pages/crm-dashboard.init.js"></script>
<!-- App js-->
<script src="../assets/js/app.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- DataTables Buttons Extension JS -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>

<!-- JSZip for Excel Export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- PDFMake (optional, if you plan PDF export) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!-- Buttons HTML5 + Print -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script>
  feather.replace();

  // Enable Bootstrap tooltips
  document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => new bootstrap.Tooltip(el));

  // Redirect when Add Student is clicked
  document.getElementById("addStudentBtn").addEventListener("click", () => {
    window.location.href = "student-add.php";
  });
</script>
<script>
$(document).ready(function () {
  let locked = false;
  let visible = true;

  $("#toggleWidgets").click(function () {
    if (locked) {
      alert("Dashboard is locked. Unlock first to show/hide widgets.");
      return;
    }

    visible = !visible;
    if (visible) {
      $("#dashboardWidgets").slideDown(300);
      $(this).html('<i class="mdi mdi-eye-off"></i> Hide Statistics');
    } else {
      $("#dashboardWidgets").slideUp(300);
      $(this).html('<i class="mdi mdi-eye"></i> Show Statistics');
    }
  });

  $("#lockWidgets").click(function () {
    locked = !locked;

    if (locked) {
      $(this).html('<i class="mdi mdi-lock"></i> Locked');
      $(this).removeClass("btn-outline-danger").addClass("btn-danger");
      $("#toggleWidgets").prop("disabled", true);
    } else {
      $(this).html('<i class="mdi mdi-lock-open-outline"></i> Unlock');
      $(this).removeClass("btn-danger").addClass("btn-outline-danger");
      $("#toggleWidgets").prop("disabled", false);
    }
  });
});
</script>

<script>

var options = {
chart: { type: 'area', height: 350 },
series: [{
name: 'Students',
data: [120, 130, 125, 140, 150, 160] // Example: students per year
}],
xaxis: {
categories: ['2018', '2019', '2020', '2021', '2022', '2023']
},
colors: ['#1E88E5'], // school theme blue
dataLabels: { enabled: false },
stroke: { curve: 'smooth' },
title: { text: 'Enrollment per Year', align: 'left' }
};

var chart = new ApexCharts(document.querySelector("#enrollment-trends"), options);
chart.render();
</script>
</body>
</html>
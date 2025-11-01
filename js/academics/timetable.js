// public/app.js
const API_URL = "/SMS_BARWAAQO/controller/api/academics/timetable_api.php";

$(function () {
  const days = ["Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday"];
  const group1 = ["Class 1","Class 2","Class 3","Class 4","Class 5","Class 6","Class 7"];
  const group2 = ["Class 8A","Class 8B","Form 1","Form 2","Form 3","Form 4"];

  function showLoading() { $("#loadingSpinner").removeClass("d-none"); }
  function hideLoading() { $("#loadingSpinner").addClass("d-none"); }

  $("#refreshBtn").click(fetchWeeklyTimetable);

function getAcademicYear() {
    const now = new Date();
    const year = now.getFullYear();
    const month = now.getMonth() + 1; // JS months 0-11
    // If current month >= August, academic year starts this year
    if (month >= 8) {
        return `${year}/${year + 1}`;
    } else {
        // Otherwise, it's the previous year's start
        return `${year - 1}/${year}`;
    }
}

// Usage in your print function:
const academicYear = getAcademicYear();

$("#printTimetable").click(() => {
    const content = document.getElementById("timetableTableGroup1").outerHTML + "<br><br>" +
                    document.getElementById("timetableTableGroup2").outerHTML;

    const win = window.open("");
    win.document.write(`
      <html>
        <head>
          <title>Weekly Timetable</title>
          <style>
            body { font-family: 'Arial', sans-serif; padding: 20px; color: #333; }
            .header { text-align: center; margin-bottom: 20px; }
            .header h1 { font-size: 24px; color: #0d6efd; margin: 0; }
            .header h3 { font-size: 18px; margin: 5px 0; }
            .academic-year { font-size: 16px; margin-top: 5px; font-weight: 500; }
            table { width: 100%; border-collapse: collapse; font-size: 12px; margin-bottom: 30px; }
            th, td { border: 1px solid #ccc; padding: 6px; text-align: center; }
            th { background: #0d6efd; color: #fff; }
            .break-row td { background: #fff4e6; font-weight: 700; }
            .footer { width: 100%; margin-top: 50px; display: flex; justify-content: space-between; }
            .signature { text-align: center; }
            .signature-line { margin-top: 60px; border-top: 1px solid #000; width: 200px; margin-left: auto; margin-right: auto; }
          </style>
        </head>
        <body>
          <div class="header">
            <h1>Fathu-Rahman School</h1>
            <h3>Weekly Timetable (Morning)</h3>
            <div class="academic-year">Academic Year: ${academicYear}</div>
          </div>

          ${content}

          <div class="footer">
            <div class="signature">
              Manager
              <div class="signature-line"></div>
            </div>
            <div class="signature">
              Deputy Manager
              <div class="signature-line"></div>
            </div>
          </div>
        </body>
      </html>
    `);
    win.print();
    win.close();
});



  function fetchWeeklyTimetable() {
    showLoading();
    $.ajax({
      type: "POST",
      url: API_URL,
      data: JSON.stringify({ action: "fetchAllWeekly" }),
      dataType: "json",
      contentType: "application/json",
      success(res) {
        hideLoading();
        if (res.status === "success") renderTimetable(res.data);
        else alert(res.message);
      },
      error() {
        hideLoading();
        alert("Error loading timetable");
      }
    });
  }

  function renderTimetable(data) {
    const map = {};
    data.forEach(r => {
      map[r.day] = map[r.day] || {};
      map[r.day][r.period_number] = map[r.day][r.period_number] || {};
      map[r.day][r.period_number][r.class_name] = r;
    });

    function renderGroup(classes, tbodyId) {
      let html = "";
      days.forEach(day => {
        html += `<tr class="table-secondary"><td colspan="${2 + classes.length}" class="fw-semibold">${day}</td></tr>`;
        for (let period = 1; period <= 7; period++) {
          if (period === 5) html += `<tr class="break-row"><td colspan="${2 + classes.length}">Break: 10:00-10:20</td></tr>`;
          html += `<tr><td>${day}</td><td>Period ${period}</td>`;
          classes.forEach(cls => {
            const cell = map[day] && map[day][period] && map[day][period][cls] || null;
            const sub = cell ? cell.subject_name || "" : "";
            const teacher = cell ? cell.teacher_name || "" : "";
            html += `<td class="editable" data-class="${cls}" data-day="${day}" data-period="${period}">${sub}<br><small>${teacher}</small></td>`;
          });
          html += `</tr>`;
        }
      });
      $(`#${tbodyId}`).html(html);
    }

    renderGroup(group1, "timetableBodyGroup1");
    renderGroup(group2, "timetableBodyGroup2");
  }

  // Click-to-edit (also works for empty cells)
$(document).on("click", "td.editable", function () {
    const td = $(this);
    $("#edit_class_id").val(td.data("class"));
    $("#edit_day").val(td.data("day"));
    $("#edit_period_id").val(td.data("period"));

    // Get subject safely: all text except small tag
    let subject = td.clone()           // clone the td
                    .children()       // remove child elements (<small>)
                    .remove()         // remove them
                    .end()            // back to td
                    .text()           // get remaining text
                    .trim();          // trim
    const teacher = td.find("small").text().trim();

    $("#edit_subject").val(subject);
    $("#edit_teacher").val(teacher);

    $("#editCellModal").modal("show");
});



  // Save (add or update) timetable cell
  $("#saveCellBtn").click(() => {
    const data = {
      action: "saveTimetable",
      class_name: $("#edit_class_id").val(),
      day: $("#edit_day").val(),
      period_number: $("#edit_period_id").val(),
      subject_name: $("#edit_subject").val(),
      teacher_name: $("#edit_teacher").val()
    };
    $.ajax({
      type: "POST",
      url: API_URL,
      data: JSON.stringify(data),
      contentType: "application/json",
      dataType: "json",
      success(res) {
        if (res.status === "success") {
          $("#editCellModal").modal("hide");
          fetchWeeklyTimetable();
        } else alert(res.message);
      }
    });
  });

  // Initial load
  fetchWeeklyTimetable();
});

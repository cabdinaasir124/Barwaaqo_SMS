<?php
header('Content-Type: application/json');
include_once __DIR__ . '/../../../config/db_connect.php';

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

function respond($status, $message = '', $data = null)
{
  echo json_encode(['status' => $status, 'message' => $message, 'data' => $data]);
  exit;
}

if ($method === 'POST' && isset($input['action'])) {

  $action = $input['action'];

  // === FETCH ALL SUBJECTS ===
  if ($action === 'fetchAll') {
    $query = "SELECT * FROM subjects ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    $subjects = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $subjects[] = $row;
    }
    respond('success', '', $subjects);
  }

  // === FETCH CLASSES ===
  if ($action === 'fetchClasses') {
    $query = "SELECT id, class_name, class_code FROM classes WHERE status = 'Active'";
    $result = mysqli_query($conn, $query);
    $classes = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $classes[] = $row;
    }
    respond('success', '', $classes);
  }

  // === FETCH TEACHERS ===
  if ($action === 'fetchTeachers') {
    $query = "SELECT id, full_name FROM teachers WHERE status = 'Active'";
    $result = mysqli_query($conn, $query);
    $teachers = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $teachers[] = $row;
    }
    respond('success', '', $teachers);
  }

  // === GENERATE SUBJECT CODE ===
  function generateSubjectCode($name)
  {
    $prefix = strtoupper(substr($name, 0, 3));
    $rand = rand(100, 999);
    return $prefix . $rand;
  }

  // === ADD NEW SUBJECT ===
  if ($action === 'addSubject') {
    $name = mysqli_real_escape_string($conn, $input['subject_name']);
    $code = generateSubjectCode($name);
    $class = mysqli_real_escape_string($conn, $input['class_name']);
    $teacher = mysqli_real_escape_string($conn, $input['teacher_name']);
    $status = mysqli_real_escape_string($conn, $input['status']);

    $query = "INSERT INTO subjects (subject_name, subject_code, class_name, teacher_name, status)
              VALUES ('$name', '$code', '$class', '$teacher', '$status')";

    if (mysqli_query($conn, $query)) {
      respond('success', 'Subject added successfully!');
    } else {
      respond('error', 'Failed to add subject: ' . mysqli_error($conn));
    }
  }

  // === UPDATE SUBJECT ===
if ($action === 'updateSubject') {
  $id = (int)$input['id'];
  $name = mysqli_real_escape_string($conn, $input['subject_name']);
  $code = mysqli_real_escape_string($conn, $input['subject_code']);
  $status = mysqli_real_escape_string($conn, $input['status']);

  $query = "UPDATE subjects SET subject_name='$name', subject_code='$code', status='$status' WHERE id=$id";

  if (mysqli_query($conn, $query)) {
    respond('success', 'Subject updated successfully!');
  } else {
    respond('error', 'Failed to update subject: ' . mysqli_error($conn));
  }
}

// === FETCH CLASSES ===
if ($action === 'fetchClasses2') {
  $query = "SELECT id, class_name, class_code FROM classes WHERE status = 'Active' ORDER BY class_name ASC";
  $result = mysqli_query($conn, $query);

  $classes = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $classes[] = $row;
  }
  respond('success', '', $classes);
}


// === DELETE SUBJECT ===
if ($action === 'deleteSubject') {
    $id = (int)$input['id']; // cast to integer to avoid string issues
    $query = "DELETE FROM subjects WHERE id=$id";

    if (mysqli_query($conn, $query)) {
        if (mysqli_affected_rows($conn) > 0) {
            respond('success', 'Subject deleted successfully!');
        } else {
            respond('error', 'No record found with that ID.');
        }
    } else {
        respond('error', 'Failed to delete subject: ' . mysqli_error($conn));
    }
}




} else {
  respond('error', 'Invalid request');
}
?>

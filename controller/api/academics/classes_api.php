<?php
header('Content-Type: application/json');
include_once __DIR__ . '/../../../config/db_connect.php';

// === Helper ===
function response($status, $message, $data = null) {
    echo json_encode(['status' => $status, 'message' => $message, 'data' => $data]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

if ($method !== 'POST' || !isset($input['action'])) {
    response('error', 'Invalid request method or missing action');
}

$action = $input['action'];

// === FETCH ALL CLASSES ===
if ($action === 'fetchAll') {
    $query = "SELECT * FROM classes ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
    if (!$result) response('error', mysqli_error($conn));

    $classes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $classes[] = $row;
    }
    response('success', 'Classes fetched successfully', $classes);
}

// === FETCH ACTIVE TEACHERS ===
if ($action === 'fetchTeachers') {
    $query = "SELECT full_name FROM teachers WHERE status='Active' ORDER BY full_name ASC";
    $result = mysqli_query($conn, $query);
    if (!$result) response('error', mysqli_error($conn));

    $teachers = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $teachers[] = $row;
    }
    response('success', 'Teachers fetched successfully', $teachers);
}

// === GENERATE CLASS CODE ===
if ($action === 'generateCode') {
    $uuid = substr(strtoupper(bin2hex(random_bytes(3))), 0, 6);
    $code = "CLS-" . $uuid;
    response('success', 'Class code generated', ['code' => $code]);
}


// === ADD CLASS ===
if ($action === 'add') {
    $class_name = mysqli_real_escape_string($conn, $input['class_name']);
    $class_code = mysqli_real_escape_string($conn, $input['class_code']);
    $section = mysqli_real_escape_string($conn, $input['section']);
    $teacher_name = mysqli_real_escape_string($conn, $input['teacher_name']);
    $max_students = (int) $input['max_students'];
    $status = mysqli_real_escape_string($conn, $input['status']);

    $query = "INSERT INTO classes (class_name, class_code, section, class_teacher, max_students, status)
              VALUES ('$class_name', '$class_code', '$section', '$teacher_name', $max_students, '$status')";
    $result = mysqli_query($conn, $query);

    if ($result) response('success', 'Class added successfully');
    else response('error', 'Failed to add class: ' . mysqli_error($conn));
}

// === UPDATE CLASS ===
if ($action === 'update') {
    $id = (int) $input['id'];
    $class_name = mysqli_real_escape_string($conn, $input['class_name']);
    $class_code = mysqli_real_escape_string($conn, $input['class_code']);
    $section = mysqli_real_escape_string($conn, $input['section']);
    $teacher_name = mysqli_real_escape_string($conn, $input['teacher_name']);
    $max_students = (int) $input['max_students'];
    $status = mysqli_real_escape_string($conn, $input['status']);

    $query = "UPDATE classes 
              SET class_name='$class_name', class_code='$class_code', section='$section',
                  class_teacher='$teacher_name', max_students=$max_students, status='$status'
              WHERE id=$id";

    $result = mysqli_query($conn, $query);
    if ($result) response('success', 'Class updated successfully');
    else response('error', 'Failed to update class: ' . mysqli_error($conn));
}

// === DELETE CLASS ===
if ($action === 'delete') {
    $id = (int) $input['id'];

    $query = "DELETE FROM classes WHERE id=$id";
    $result = mysqli_query($conn, $query);

    if ($result) response('success', 'Class deleted successfully');
    else response('error', 'Failed to delete class: ' . mysqli_error($conn));
}

response('error', 'Invalid action');
?>

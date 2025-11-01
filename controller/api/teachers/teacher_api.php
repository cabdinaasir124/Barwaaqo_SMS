<?php
header("Content-Type: application/json");
include_once __DIR__ . '/../../../config/db_connect.php';

if (!isset($conn)) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection not found.']);
    exit;
}

// Handle both JSON and FormData requests
$input = json_decode(file_get_contents("php://input"), true);
$action = $_POST['action'] ?? ($input['action'] ?? '');

if ($action === 'fetchAll') {
    // ==============================
    // FETCH ALL TEACHERS
    // ==============================
    try {
        $query = "SELECT `id`, `full_name`, `email`, `phone`, `designation`, `classes`, `profile_image`, `status`, `created_at`, `salary`, `national_id`
                  FROM `teachers` ORDER BY id DESC";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $teachers = [];
            while ($row = $result->fetch_assoc()) {
                $teachers[] = $row;
            }
            echo json_encode(['status' => 'success', 'data' => $teachers]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No teachers found']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }

} elseif ($action === 'add_teacher') {
    // ==============================
    // ADD TEACHER LOGIC
    // ==============================
    try {
        $full_name     = $_POST['teacher_name'] ?? '';
        $email         = $_POST['teacher_email'] ?? '';
        $phone         = $_POST['teacher_phone'] ?? '';
        $designation   = $_POST['teacher_subjects'] ?? '';
        $classes       = isset($_POST['teacher_classes']) ? implode(", ", $_POST['teacher_classes']) : '';
        $status        = $_POST['teacher_status'] ?? 'Active';
        $national_id   = $_POST['teacher_national_id'] ?? '';
        $salary        = $_POST['teacher_salary'] ?? 0;
        $created_at    = date('Y-m-d H:i:s');

        // Handle profile image upload
        $profile_image = "/SMS_BARWAAQO/assets/images/person.jpg"; // Default image
        if (!empty($_FILES['teacher_photo']['name'])) {
            $uploadDir = __DIR__ . '/../../../assets/uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $fileName = time() . "_" . basename($_FILES['teacher_photo']['name']);
            $uploadFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['teacher_photo']['tmp_name'], $uploadFile)) {
                $profile_image = "/SMS_BARWAAQO/assets/uploads/" . $fileName;
            }
        }

        // Insert into DB
        $stmt = $conn->prepare("INSERT INTO `teachers`
            (`full_name`, `email`, `phone`, `designation`, `classes`, `status`, `created_at`, `salary`, `national_id`, `profile_image`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssssssssss",
            $full_name,
            $email,
            $phone,
            $designation,
            $classes,
            $status,
            $created_at,
            $salary,
            $national_id,
            $profile_image
        );

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Teacher added successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to insert record: ' . $stmt->error]);
        }
        $stmt->close();

    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }

} elseif ($action === 'delete_teacher') {
    // ==============================
    // DELETE TEACHER LOGIC
    // ==============================
    $teacher_id = $input['id'] ?? null;

    if (!$teacher_id) {
        echo json_encode(['status' => 'error', 'message' => 'Missing teacher ID.']);
        exit;
    }

    try {
        $stmt = $conn->prepare("DELETE FROM teachers WHERE id = ?");
        $stmt->bind_param("i", $teacher_id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Teacher deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Teacher not found or already deleted.']);
        }
        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }

}elseif ($action === 'update_teacher') {
    // ==============================
    // UPDATE TEACHER LOGIC
    // ==============================
    try {
        $id            = $_POST['teacher_id'] ?? '';
        $full_name     = $_POST['teacher_name'] ?? '';
        $email         = $_POST['teacher_email'] ?? '';
        $phone         = $_POST['teacher_phone'] ?? '';
        $designation   = $_POST['teacher_subjects'] ?? '';
        $classes       = isset($_POST['teacher_classes']) ? implode(", ", $_POST['teacher_classes']) : '';
        $status        = $_POST['teacher_status'] ?? 'Active';
        $national_id   = $_POST['teacher_national_id'] ?? '';
        $salary        = $_POST['teacher_salary'] ?? 0;

        if (empty($id)) {
            echo json_encode(['status' => 'error', 'message' => 'Missing teacher ID.']);
            exit;
        }

        // Handle profile image upload (optional)
        $profile_image = null;
        if (!empty($_FILES['teacher_photo']['name'])) {
            $uploadDir = __DIR__ . '/../../../assets/uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $fileName = time() . "_" . basename($_FILES['teacher_photo']['name']);
            $uploadFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['teacher_photo']['tmp_name'], $uploadFile)) {
                $profile_image = "/SMS_BARWAAQO/assets/uploads/" . $fileName;
            }
        }

        // Build update query
        if ($profile_image) {
            $stmt = $conn->prepare("UPDATE teachers 
                SET full_name=?, email=?, phone=?, designation=?, classes=?, status=?, salary=?, national_id=?, profile_image=? 
                WHERE id=?");
            $stmt->bind_param("sssssssssi", 
                $full_name, $email, $phone, $designation, $classes, $status, $salary, $national_id, $profile_image, $id);
        } else {
            $stmt = $conn->prepare("UPDATE teachers 
                SET full_name=?, email=?, phone=?, designation=?, classes=?, status=?, salary=?, national_id=? 
                WHERE id=?");
            $stmt->bind_param("ssssssssi", 
                $full_name, $email, $phone, $designation, $classes, $status, $salary, $national_id, $id);
        }

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Teacher updated successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update: ' . $stmt->error]);
        }
        $stmt->close();

    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
 else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
}
?>

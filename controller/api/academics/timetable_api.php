<?php
header('Content-Type: application/json');
include_once __DIR__ . '/../../../config/db_connect.php';

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

if($method!=='POST' || !isset($input['action'])){
    echo json_encode(["status"=>"error","message"=>"Invalid request"]);
    exit;
}

$action = $input['action'];

$period_times = [
  1 => ['07:20:00','08:00:00'],
  2 => ['08:00:00','08:40:00'],
  3 => ['08:40:00','09:20:00'],
  4 => ['09:20:00','10:00:00'],
  5 => ['10:20:00','11:00:00'],
  6 => ['11:00:00','11:40:00'],
  7 => ['11:40:00','12:20:00'],
];

switch($action){

  case "fetchAllWeekly":
    $sql = "SELECT id,class_name,day,period_number,start_time,end_time,subject_name,teacher_name 
            FROM timetables
            ORDER BY FIELD(day,'Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'), period_number ASC, class_name ASC";
    $res = mysqli_query($conn,$sql);
    $data = [];
    while($row=mysqli_fetch_assoc($res)) $data[]=$row;
    echo json_encode(["status"=>"success","data"=>$data]);
    break;

  case "saveTimetable":
    $class_name = trim($input['class_name'] ?? '');
    $day = trim($input['day'] ?? '');
    $period_number = (int)($input['period_number'] ?? 0);
    $subject_name = trim($input['subject_name'] ?? null);
    $teacher_name = trim($input['teacher_name'] ?? null);

    if($class_name==='' || $day==='' || $period_number<1){
      echo json_encode(["status"=>"error","message"=>"Missing required fields"]); exit;
    }

    $start_time = $end_time = null;
    if(isset($period_times[$period_number])){
      $start_time = $period_times[$period_number][0];
      $end_time = $period_times[$period_number][1];
    }

    // check exists
    $stmt=mysqli_prepare($conn,"SELECT id FROM timetables WHERE class_name=? AND day=? AND period_number=? LIMIT 1");
    mysqli_stmt_bind_param($stmt,"ssi",$class_name,$day,$period_number);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $exists=mysqli_stmt_num_rows($stmt)>0;
    mysqli_stmt_close($stmt);

    if($exists){
      $stmt=mysqli_prepare($conn,"UPDATE timetables SET subject_name=?, teacher_name=?, start_time=?, end_time=?, created_at=NOW() WHERE class_name=? AND day=? AND period_number=?");
      mysqli_stmt_bind_param($stmt,"ssssssi",$subject_name,$teacher_name,$start_time,$end_time,$class_name,$day,$period_number);
      $ok=mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      echo json_encode(["status"=>$ok?"success":"error","message"=>$ok?"Timetable updated":"Update failed"]);
    }else{
      $stmt=mysqli_prepare($conn,"INSERT INTO timetables(class_name,day,period_number,start_time,end_time,subject_name,teacher_name) VALUES(?,?,?,?,?,?,?)");
      mysqli_stmt_bind_param($stmt,"ssisiss",$class_name,$day,$period_number,$start_time,$end_time,$subject_name,$teacher_name);
      $ok=mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      echo json_encode(["status"=>$ok?"success":"error","message"=>$ok?"Added successfully":"Failed to add"]);
    }
    break;

  case "deleteTimetable":
    $id=(int)($input['id'] ?? 0);
    if($id>0){
      $ok=mysqli_query($conn,"DELETE FROM timetables WHERE id=$id");
      echo json_encode(["status"=>$ok?"success":"error","message"=>$ok?"Deleted":"Failed"]);
    }
    break;

  case "fetchAllPeriods":
    $res=mysqli_query($conn,"SELECT * FROM periods ORDER BY period_number ASC");
    $periods=mysqli_fetch_all($res,MYSQLI_ASSOC);
    echo json_encode(["status"=>"success","data"=>$periods]);
    break;

  case "savePeriod":
    $id=(int)($input['id'] ?? 0);
    $num=(int)($input['period_number'] ?? 0);
    $start=($input['start_time'] ?? null);
    $end=($input['end_time'] ?? null);
    if($num && $start && $end){
      if($id>0){
        $ok=mysqli_query($conn,"UPDATE periods SET period_number='$num',start_time='$start',end_time='$end' WHERE id=$id");
      }else{
        $ok=mysqli_query($conn,"INSERT INTO periods(period_number,start_time,end_time) VALUES('$num','$start','$end')");
      }
      echo json_encode(["status"=>$ok?"success":"error","message"=>$ok?"Saved":"Failed"]);
    }
    break;

  case "deletePeriod":
    $id=(int)($input['id'] ?? 0);
    if($id>0){
      $ok=mysqli_query($conn,"DELETE FROM periods WHERE id=$id");
      echo json_encode(["status"=>$ok?"success":"error","message"=>$ok?"Deleted":"Failed"]);
    }
    break;

  default:
    echo json_encode(["status"=>"error","message"=>"Unknown action"]);
    break;
}
?>

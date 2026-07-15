<?php
include "Checklogin.php";
include "connection.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['shift_id']) || !isset($_POST['shift_number'])) {
    header("Location: U_Select_Shift_Date.php?error=invalid_request");
    exit;
}

$shift_id = $_POST['shift_id'];
$shift_number = (int)$_POST['shift_number'];
$user_id = $_SESSION['user_id'];

// اعتبارسنجی شماره شیفت
if ($shift_number < 1 || $shift_number > 3) {
    header("Location: U_Select_Shift_Date.php?error=invalid_shift");
    exit;
}

// بررسی وجود شیفت
$stmt = $pdo->prepare("SELECT * FROM as_shifts WHERE id = ?");
$stmt->execute([$shift_id]);
$shift = $stmt->fetch();

if (!$shift) {
    header("Location: U_Select_Shift_Date.php?error=shift_not_found");
    exit;
}

// بررسی ظرفیت شیفت
$max_users_field = "max_users" . $shift_number;
$max_users = $shift[$max_users_field];

$stmt = $pdo->prepare("SELECT COUNT(*) FROM as_user_shifts 
                      WHERE shift_id = ? AND shift_number = ?");
$stmt->execute([$shift_id, $shift_number]);
$registered_count = $stmt->fetchColumn();

if ($registered_count >= $max_users) {
    header("Location: U_Select_Shift_Date.php?shift_date=" . urlencode($shift['shift_date']) . "&error=full_capacity");
    exit;
}

// بررسی آیا کاربر قبلاً برای این تاریخ ثبت‌نام کرده
/*$stmt = $pdo->prepare("SELECT * FROM as_user_shifts 
                      WHERE user_id = ? AND shift_id = ?");
$stmt->execute([$user_id, $shift_id]);

if ($stmt->fetch()) {
    header("Location: U_Select_Shift_Date.php?shift_date=" . urlencode($shift['shift_date']) . "&error=already_registered");
    exit;
}*/

// ثبت شیفت کاربر
try {
    $stmt = $pdo->prepare("INSERT INTO as_user_shifts 
                          (user_id, shift_id, shift_number) 
                          VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $shift_id, $shift_number]);

    header("Location: U_Shifts_History.php?success=shift_registered");
    exit;
} catch (PDOException $e) {
    error_log("Error registering shift: " . $e->getMessage());
    header("Location: U_Select_Shift.php?shift_date=" . urlencode($shift['shift_date']) . "&error=database_error");
    exit;
}

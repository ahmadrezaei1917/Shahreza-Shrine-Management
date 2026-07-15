<?php
include "Checklogin.php";
include "Check_Admin.php"; // بررسی دسترسی ادمین
include "connection.php";

// بررسی وجود پارامتر ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: A_See_Shifts.php?error=invalid_id");
    exit;
}

$shift_id = (int)$_GET['id'];

// شروع تراکنش
$pdo->beginTransaction();

try {
    
    // حذف شیفت
    $sql = "DELETE FROM as_user_shifts WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$shift_id]);

    if ($stmt->rowCount() > 0) {
    header("Location: A_See_Shifts.php?success=shift_deleted");
    exit;
    }

} catch (PDOException $e) {
    $pdo->rollBack();
    error_log("Database Error in A_Delete_Shift: " . $e->getMessage());
    header("Location: A_See_Shifts.php?error=database_error");
    exit;
} catch (Exception $e) {
    $pdo->rollBack();
    error_log("Application Error in A_Delete_Shift: " . $e->getMessage());
    header("Location: A_See_Shifts.php?error=shift_not_found");
    exit;
}
?>
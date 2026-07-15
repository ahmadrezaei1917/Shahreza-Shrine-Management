<?php
require_once "Checklogin.php";
require_once "Check_Admin.php";
require_once "connection.php";

// بررسی وجود پارامتر ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: A_View_Defined_Shifts.php?error=invalid_id");
    exit;
}

$shift_id = (int)$_GET['id'];

// شروع تراکنش
$pdo->beginTransaction();

try {
    // 1. دریافت اطلاعات شیفت قبل از حذف
    $stmt = $pdo->prepare("SELECT * FROM as_shifts WHERE id = ?");
    $stmt->execute([$shift_id]);
    $shift_info = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$shift_info) {
        throw new Exception("شیفت مورد نظر یافت نشد");
    }

    // 2. بررسی آیا کاربرانی برای این شیفت ثبت‌نام کرده‌اند
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM as_user_shifts WHERE shift_id = ?");
    $stmt->execute([$shift_id]);
    $registered_users = $stmt->fetchColumn();

    if ($registered_users > 0) {
        // 3. حذف تمام ثبت‌نام‌های مرتبط با این شیفت
        $stmt = $pdo->prepare("DELETE FROM as_user_shifts WHERE shift_id = ?");
        $stmt->execute([$shift_id]);
        
        $deleted_registrations = $stmt->rowCount();
    }

    // 4. حذف خود شیفت
    $stmt = $pdo->prepare("DELETE FROM as_shifts WHERE id = ?");
    $stmt->execute([$shift_id]);

    if ($stmt->rowCount() === 0) {
        throw new Exception("شیفت مورد نظر حذف نشد");
    }

    
   

    // تأیید تراکنش
    $pdo->commit();

    header("Location: A_Defined_Shifts.php?success=shift_deleted&deleted_registrations=" . ($registered_users ?? 0));
    exit;

} catch (PDOException $e) {
    $pdo->rollBack();
    error_log("Database Error in A_Delete_Shift_Definition: " . $e->getMessage());
    header("Location: A_Defined_Shifts.php?error=database_error");
    exit;
} catch (Exception $e) {
    $pdo->rollBack();
    error_log("Application Error in A_Delete_Shift_Definition: " . $e->getMessage());
    header("Location: A_Defined_Shifts.php?error=operation_failed");
    exit;
}
<?php
include "Checklogin.php";
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['u_code'])) {
        if ($_SESSION['user_id'] == $_POST['u_code']) {
            $u_code = $_POST['u_code'];

            try {
                $sql = "DELETE FROM as_user WHERE u_code = :u_code";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':u_code' => $u_code]);

                if ($stmt->rowCount() > 0) {
                    header("location:logout.php");
                    exit;
                } else {
                    header("location:U_See_Details.php?error=not_found");
                    exit;
                }
            } catch (PDOException $e) {
                error_log("Database error: " . $e->getMessage());
                header("location:U_See_Details.php?error=database");
                exit;
            }
        } elseif (isset($_SESSION['user_type'])) {
            if ($_SESSION['user_type'] === "پشتیبان" || $_SESSION['user_type'] === "مدیر آستان" || $_SESSION['user_type'] === "مسئول خادمین افتخاری" || $_SESSION['user_type'] === "مسئول فرهنگی آستان") {
                $u_code = $_POST['u_code'];

                try {
                    $sql = "DELETE FROM as_user WHERE u_code = :u_code";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([':u_code' => $u_code]);

                    if ($stmt->rowCount() > 0) {
                        header("location:U_See_Details.php?success=deleted");
                        exit;
                    } else {
                        header("location:U_See_Details.php?u_code=$u_code&error=not_found");
                        exit;
                    }
                } catch (PDOException $e) {
                    error_log("Database error: " . $e->getMessage());
                    header("location:U_See_Details.php?u_code=$u_code&error=database&message=" . $e->getMessage());
                    exit;
                }
            }
        }
    } else {
        header("location:U_See_Details.php?error=invalid_request");
        exit;
    }
} else {
    header("location:U_See_Details.php?error=invalid_request");
    exit;
}
?>
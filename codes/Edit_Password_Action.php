<?php
    include "Checklogin.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $user_id = $_SESSION['user_id'];
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_new_password = $_POST['confirm_new_password'];

        if($new_password !== $confirm_new_password){
            header ("location:U_Edit_Password.php?error=pass_does_not_match");
            exit;
        }

        include "Connection.php";

        global $pdo;

        $sql = "SELECT u_password FROM as_user WHERE u_code = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);

        if(!$user || !password_verify($current_password,$user->u_password)){
            header ("location:U_Edit_Password.php?error=wrong_pass");
            exit;
        }

        $hashed_password = password_hash($new_password,PASSWORD_DEFAULT);
        $sql = "UPDATE as_user SET u_password = :new_password WHERE u_code= :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':new_password' => $hashed_password,':user_id' => $user_id]);

        header ("location:U_Edit_Password.php?success=password_changed");
        exit;
    }

?>
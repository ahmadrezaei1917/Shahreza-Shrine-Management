<?php
session_start();

/*if(isset($_POST['u_code']) && !empty($_POST['u_code']) && isset($_POST['u_password']) && !empty($_POST['u_password'])){
   $u_code=$_POST['u_code'];
   $u_password=$_POST['u_password']; */

include "connection.php";

if (isset($_POST['register'])) {
    if (isset($_POST['u_code']) and isset($_POST['u_password']) and isset($_POST['u_name']) and isset($_POST['u_family']) and isset($_POST['u_father_name']) and isset($_POST['u_phone']) and isset($_POST['u_virtual']) and isset($_POST['u_gender']) and isset($_POST['u_marriage']) and isset($_POST['u_nation']) and isset($_POST['u_religion']) and isset($_POST['u_sect']) and isset($_POST['u_education']) and isset($_POST['u_state']) and isset($_POST['u_city']) and isset($_POST['u_type'])) {
        if (!empty($_POST['u_code']) and !empty($_POST['u_password']) and !empty($_POST['u_name']) and !empty($_POST['u_family']) and !empty($_POST['u_father_name']) and !empty($_POST['u_phone']) and !empty($_POST['u_gender']) and !empty($_POST['u_marriage']) and !empty($_POST['u_nation']) and !empty($_POST['u_religion']) and !empty($_POST['u_sect']) and !empty($_POST['u_education']) and !empty($_POST['u_state']) and !empty($_POST['u_city']) and !empty($_POST['u_type'])) {
            if (register($_POST['u_code'], $_POST['u_password'], $_POST['u_name'], $_POST['u_family'], $_POST['u_father_name'], $_POST['u_phone'], $_POST['u_virtual'], $_POST['u_gender'], $_POST['u_marriage'], $_POST['u_nation'], $_POST['u_religion'], $_POST['u_sect'], $_POST['u_education'], $_POST['u_state'], $_POST['u_city'], $_POST['u_type'])) {
                //echo "<script> alert('با موفقیت وارد شدید');</script>";
                header("location: A_Create_User.php?success=user_created");
                exit;
            } else {
                if ($user_exists == 1) {
                    header("location: A_Create_User.php?error=user_exists");
                    exit;
                }
                header("location: A_Create_User.php?error=user");
                exit;
            }
        } else {
            header("location: A_Create_User.php?error=empty"); //خالی بودن مقادیر (به جز شماره تماس مجازی)
        }
    } else {
        header("location: A_Create_User.php?error=user");
        exit;
    }
} elseif (isset($_POST['login'])) {
    if (isset($_POST['u_code']) and isset($_POST['u_password'])) {
        if (!empty($_POST['u_code']) and !empty($_POST['u_password'])) {
            if (login($_POST['u_code'], $_POST['u_password'])) {
                //echo "<script> alert('با موفقیت وارد شدید');</script>";
                header("location: home.php");
                exit;
            } else {
                $_SESSION['login'] = false;
                header("location: login.php?error=wrong_credentials");
                exit;
            }
        } else {
            $_SESSION['login'] = false;
            header("location: login.php?s=0"); //خالی بودن مقادیر
            exit;
        }
    }
}



function isUserExists($u_code)
{
    global $pdo;
    $sql = "SELECT * FROM as_user WHERE u_code = :u_code";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':u_code' => $u_code]);
    return $stmt->rowCount();
}

function register($u_code, $u_password, $u_name, $u_family, $u_father_name, $u_phone, $u_virtual, $u_gender, $u_marriage, $u_nation, $u_religion, $u_sect, $u_education, $u_state, $u_city, $u_type)
{
    global $pdo;
    if (isUserExists($u_code)) {
        $user_exists = 1;
        return false;
    }

    /*$data = [
        ':national_code' => $_POST['national_code'],
        ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT), // هش کردن رمز عبور
        ':first_name' => $_POST['first_name'],
        ':last_name' => $_POST['last_name'],
        ':father_name' => $_POST['father_name'],
        ':phone' => $_POST['phone'],
        ':virtual_number' => $_POST['virtual_number'],
        ':education' => $_POST['education'],
        ':city' => $_POST['city'],
        ':gender' => $_POST['gender'],
        ':nationality' => $_POST['nationality'],
        ':marital_status' => $_POST['marital_status'],
        ':user_type' => $_POST['user_type'],
        ':religion' => $_POST['religion'],
        ':sect' => $_POST['sect']
    ];*/
    $hashed_password = password_hash($u_password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO as_user (u_code, u_password, u_name, u_family, u_father_name, u_phone, u_virtual, u_gender, u_marriage, u_nation, u_religion, u_sect, u_education, u_state, u_city, u_type) 
                VALUES (:u_code, :u_password, :u_name, :u_family, :u_father_name, :u_phone, :u_virtual, :u_gender, :u_marriage, :u_nation, :u_religion, :u_sect, :u_education, :u_state, :u_city, :u_type)";

    $stmt = $pdo->prepare($sql);
    if ($stmt->execute([':u_code' => $u_code, ':u_password' => $hashed_password, ':u_name' => $u_name, ':u_family' => $u_family, ':u_father_name' => $u_father_name, ':u_phone' => $u_phone, ':u_virtual' => $u_virtual, ':u_gender' => $u_gender, ':u_marriage' => $u_marriage, ':u_nation' => $u_nation, ':u_religion' => $u_religion, ':u_sect' => $u_sect, ':u_education' => $u_education, ':u_state' => $u_state, ':u_city' => $u_city, ':u_type' => $u_type])) {
        $user_exists = 0;
        return true;
    } else {
        return false;
    }
}

function login($u_code, $u_password)
{
    global $pdo;

    if (!isUserExists($u_code)) {
        return false;
    }

    $sql = "SELECT * FROM as_user WHERE u_code = :u_code";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':u_code' => $u_code]);
    $user = $stmt->fetch(PDO::FETCH_OBJ);

    if ($user) {
        if (password_verify($u_password, $user->u_password)) {
            $_SESSION['user_id'] = $user->u_code;
            $_SESSION['user_name'] = $user->u_name;
            $_SESSION['u_family'] = $user->u_family;
            $_SESSION['user_type'] = $user->u_type;
            $_SESSION['user_gender'] = $user->u_gender;
            $_SESSION['login'] = true;
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
/* $sql="SELECT * FROM as_user WHERE u_code=$u_code AND u_password=$u_password";
/$result=mysqli_query($link,$sql);

$row=mysqli_fetch_array($result);
if ($row)
{
    echo ("<p style='color:green;'><b>کاربر {$row['u_name']} {$row['u_family']} به سایت آستان مقدس امامزاده شاهرضا (ع) خوش آمدید</b>");
}
 elseif {
   echo("<p style='color:red;'><b>کد ملی یا رمز عبور صحیح نیست</b></p>");
 }
}else {
   echo("<p style='color:red'><b>مقدار ها را وارد کنید</b></p>");
} */



?>
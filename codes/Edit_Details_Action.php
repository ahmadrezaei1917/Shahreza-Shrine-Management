<?php





include "Checklogin.php";
include "Connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['Edit_Details'])) {
    if (
      isset($_POST['u_code']) and isset($_POST['u_name']) and isset($_POST['u_family']) and isset($_POST['u_father_name']) and
      isset($_POST['u_phone']) and isset($_POST['u_virtual']) and isset($_POST['u_gender']) and isset($_POST['u_type']) and
      isset($_POST['u_marriage']) and isset($_POST['u_nation']) and isset($_POST['u_religion']) and isset($_POST['u_sect']) and
      isset($_POST['u_education']) and isset($_POST['u_state']) and isset($_POST['u_city'])
    ) {

      if (
        !empty($_POST['u_code']) and !empty($_POST['u_name']) and !empty($_POST['u_family']) and !empty($_POST['u_father_name']) and
        !empty($_POST['u_phone']) and !empty($_POST['u_gender']) and !empty($_POST['u_type']) and
        !empty($_POST['u_marriage']) and !empty($_POST['u_nation']) and !empty($_POST['u_religion']) and
        !empty($_POST['u_sect']) and !empty($_POST['u_education']) and !empty($_POST['u_state']) and !empty($_POST['u_city'])
      ) {

        $u_code = $_POST['u_code'];
        $u_name = $_POST['u_name'];
        $u_family = $_POST['u_family'];
        $u_father_name = $_POST['u_father_name'];
        $u_phone = $_POST['u_phone'];
        $u_virtual = $_POST['u_virtual'];
        $u_gender = $_POST['u_gender'];
        $u_type = $_POST['u_type'];
        $u_marriage = $_POST['u_marriage'];
        $u_nation = $_POST['u_nation'];
        $u_religion = $_POST['u_religion'];
        $u_sect = $_POST['u_sect'];
        $u_education = $_POST['u_education'];
        $u_state = $_POST['u_state'];
        $u_city = $_POST['u_city'];

        try {
          $sql = "UPDATE as_user SET 
                u_name = :u_name,
                u_family = :u_family,
                u_father_name = :u_father_name,
                u_phone = :u_phone, 
                u_virtual = :u_virtual,
                u_education = :u_education, 
                u_state = :u_state, 
                u_city = :u_city, 
                u_gender = :u_gender,
                u_nation = :u_nation, 
                u_marriage = :u_marriage, 
                u_type = :u_type, 
                u_religion = :u_religion, 
                u_sect = :u_sect 
                WHERE u_code = :u_code";

          $stmt = $pdo->prepare($sql);
          $result = $stmt->execute([
            ':u_code' => $u_code,
            ':u_name' => $u_name,
            ':u_family' => $u_family,
            ':u_father_name' => $u_father_name,
            ':u_phone' => $u_phone,
            ':u_virtual' => $u_virtual,
            ':u_education' => $u_education,
            ':u_state' => $u_state,
            ':u_city' => $u_city,
            ':u_gender' => $u_gender,
            ':u_nation' => $u_nation,
            ':u_marriage' => $u_marriage,
            ':u_type' => $u_type,
            ':u_religion' => $u_religion,
            ':u_sect' => $u_sect
          ]);

          if ($result) {
            header("location:U_Edit_Details.php?u_code=$u_code&success=updated");
            exit;
          } else {
            header("location:U_Edit_Details.php?u_code=$u_code&error=update_failed");
            exit;
          }
        } catch (PDOException $e) {
          error_log("Database error: " . $e->getMessage());
          header("location:U_Edit_Details.php?u_code=$u_code&error=database");
          exit;
        }
      } else {
        header("location:U_Edit_Details.php?u_code=$u_code&wrong=empty_field");
        exit;
      }
    } else {
      header("location:U_Edit_Details.php?u_code=$u_code&wrong=missing_field");
      exit;
    }
  }
}

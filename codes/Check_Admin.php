<?php
    if (isset($_SESSION['user_type'])) {
      $allowed_types = ["پشتیبان", "مدیر آستان", "مسئول خادمین افتخاری", "مسئول فرهنگی آستان"];
      
      if (!in_array($_SESSION['user_type'], $allowed_types)) {
          header("location: home.php?access=denied");
          exit;
      }
  } else {
      header("location: login.php?error=user_type");
      exit;
  }
 ?>
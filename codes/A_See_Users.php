<?php include "Checklogin.php"; ?>
<?php include "Check_Admin.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>مشاهده کابران</title>
  <?php include "Header.php"; ?>

  <style>
    /* استایل‌های عمومی جدول */
    .responsive-table {
      width: 100%;
      overflow-x: auto;
    }

    table {
      min-width: 600px;
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 12px 8px;
      text-align: center;
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    th {
      background-color: rgba(255, 255, 255, 0.05);
    }

    /* استایل‌های موبایل */
    @media (max-width: 768px) {
      .container.blur {
        padding: 0;
      }

      .responsive-table {
        padding: 0 10px;
      }

      th,
      td {
        padding: 8px 4px;
        font-size: 14px;
      }
    }

    /* استایل‌های چاپ */
    @media print {
      body * {
        visibility: hidden;
      }

      .print-table,
      .print-table * {
        visibility: visible;
      }

      .print-table {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
      }

      table {
        width: 100% !important;
      }

      th,
      td {
        border: 1px solid #000 !important;
        color: #000 !important;
      }
    }
  </style>
</head>

<body>
  <!--Main-->
  <?php include "connection.php";
  $sql = "SELECT u_code, u_name, u_family, u_phone, u_type, u_gender FROM as_user";
  /*if($_SESSION['user_type'] == "مسئول خادمین افتخاری"){
    $gender = $_SESSION['user_gender'];
      $sql = $sql . " WHERE u_type='خادم افتخاری' AND u_gender='$gender'";
  }*/
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

  ?>
  <div class="container blur pb-3" style="border-radius: 1rem">
    <h2 class="text-center text-dark my-4 p-3">مشاهده کاربران</h2>

    <div class="responsive-table print-table">
      <table class="text-dark blur mb-5">
        <thead class="blur">
          <tr>
            <th scope="col">ردیف</th>
            <th scope="col">کد ملی</th>
            <th scope="col">نام</th>
            <th scope="col">نام خانوادگی</th>
            <th scope="col">شماره تماس</th>
            <th scope="col">نوع کاربر</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $row_number = 1;
          foreach ($users as $user) {
            if($_SESSION['user_type'] == "مسئول خادمین افتخاری"){
              if($user['u_type'] == "خادم افتخاری"){
                if($_SESSION['user_gender'] == $user['u_gender']){
                  echo "<tr>";
                  echo "<td>" . $row_number++ . "</td>";
                  echo "<td><a class='text-reset' href='U_See_Details.php?u_code=" . urlencode($user['u_code']) . "'>" . htmlspecialchars($user['u_code']) . "</a></td>";
                  echo "<td>" . htmlspecialchars($user['u_name']) . "</td>";
                  echo "<td>" . htmlspecialchars($user['u_family']) . "</td>";
                  echo "<td>" . htmlspecialchars($user['u_phone']) . "</td>";
                  echo "<td>" . htmlspecialchars($user['u_type']) . "</td>";
                  echo "</tr>";
                }
              } else {
                echo "<tr>";
                echo "<td>" . $row_number++ . "</td>";
                echo "<td><a class='text-reset' href='U_See_Details.php?u_code=" . urlencode($user['u_code']) . "'>" . htmlspecialchars($user['u_code']) . "</a></td>";
                echo "<td>" . htmlspecialchars($user['u_name']) . "</td>";
                echo "<td>" . htmlspecialchars($user['u_family']) . "</td>";
                echo "<td>" . htmlspecialchars($user['u_phone']) . "</td>";
                echo "<td>" . htmlspecialchars($user['u_type']) . "</td>";
                echo "</tr>";
              }
            } else {
            echo "<tr>";
            echo "<td>" . $row_number++ . "</td>";
            echo "<td><a class='text-reset' href='U_See_Details.php?u_code=" . urlencode($user['u_code']) . "'>" . htmlspecialchars($user['u_code']) . "</a></td>";
            echo "<td>" . htmlspecialchars($user['u_name']) . "</td>";
            echo "<td>" . htmlspecialchars($user['u_family']) . "</td>";
            echo "<td>" . htmlspecialchars($user['u_phone']) . "</td>";
            echo "<td>" . htmlspecialchars($user['u_type']) . "</td>";
            echo "</tr>";
          }
        }
          ?>
        </tbody>
      </table>
    </div>

    <!-- دکمه چاپ در پایین صفحه -->
    <div class="text-center mb-5 no-print">
      <button onclick="printTable()" class="btn btn-light blur col-12 col-md-3 col-lg-2">چاپ <i class="fas fa-print"></i></button>
    </div>
  </div>
  <!--Main-->

  <?php include "Footer.php"; ?>

  <script>
    function printTable() {
      window.print();
    }
  </script>
</body>

</html>
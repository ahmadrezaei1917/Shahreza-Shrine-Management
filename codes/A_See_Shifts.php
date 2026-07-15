<?php
include "Checklogin.php";
include "Check_Admin.php";
include "connection.php";

// دریافت پارامترهای جستجو
$search_date = isset($_GET['date']) ? $_GET['date'] : '';
$search_user = isset($_GET['user']) ? $_GET['user'] : '';

// ساخت کوئری با فیلترهای جستجو
$sql = $sql = "SELECT 
us.id,
u.u_code,
u.u_name,
u.u_family,
s.shift_date,
CASE 
    WHEN us.shift_number = 1 THEN s.shift_start1
    WHEN us.shift_number = 2 THEN s.shift_start2
    WHEN us.shift_number = 3 THEN s.shift_start3
END as shift_start,
CASE 
    WHEN us.shift_number = 1 THEN s.shift_end1
    WHEN us.shift_number = 2 THEN s.shift_end2
    WHEN us.shift_number = 3 THEN s.shift_end3
END as shift_end,
us.shift_number,
us.registered_at,
us.shift_status
FROM as_user_shifts us
JOIN as_shifts s ON us.shift_id = s.id
JOIN as_user u ON us.user_id = u.u_code
WHERE 1=1";

$params = [];

if (!empty($search_date)) {
  $sql .= " AND s.shift_date = ?";
  $params[] = $search_date;
}

if (!empty($search_user)) {
  $sql .= " AND (u.u_code LIKE ? OR u.u_name LIKE ? OR u.u_family LIKE ?)";
  $params[] = "%$search_user%";
  $params[] = "%$search_user%";
  $params[] = "%$search_user%";
}

$sql .= " ORDER BY s.shift_date DESC, us.shift_number";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$all_shifts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <title>مدیریت شیفت‌ها - ادمین</title>
  <?php include "Header.php"; ?>

  <style>
    /* استایل‌های عمومی جدول */
    .responsive-table {
      width: 100%;
      overflow-x: auto;
    }

    table {
      min-width: 800px;
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 12px 8px;
      text-align: center;
      border: 1px solid rgba(255, 255, 255, 0.1);
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

      .no-print {
        display: none !important;
      }
    }

    .search-box {

      border-radius: 0.5rem;
      padding: 1rem;
      margin-bottom: 1.5rem;
    }

    a {
      text-decoration: none !important;
    }

    a:hover,
    a:focus,
    a:active {
      text-decoration: none !important;
    }

    .btn {
      text-decoration: none !important;
    }
  </style>
</head>

<body class="text-reset">
  <!--Main-->
  <div class="container blur pb-3" style="border-radius: 1rem">
    <h2 class="text-center text-dark my-4 p-3"> شیفت های انتخابی کاربران</h2>

    <!-- بخش جستجو -->
    <div class="search-box no-print">
      <form method="get" action="">
        <div class="row">
          <div class="col-12 col-lg-2 mb-3">
            <label for="date" class="form-label">جستجو بر اساس تاریخ</label>
            <input type="date" id="date" name="date" class="blur form-control"
              value="<?= htmlspecialchars($search_date) ?>">
          </div>
          <div class="col-12 col-lg-3   mb-3">
            <label for="user" class="form-label">جستجو بر اساس مشخصات کاربر</label>
            <input type="text" id="user" name="user" class="blur form-control"
              value="<?= htmlspecialchars($search_user) ?>">
          </div>
          <div class="col-12 col-lg-2 d-flex align-items-end mb-3">
            <button type="submit" class="btn blur btn-light w-100">جستجو</button>
          </div>
          <div class="col-12 col-lg-2 d-flex align-items-end mb-3">
            <a href="A_See_Shifts.php">
              <button type="button" class="btn blur btn-light w-100">مشاهده همه</button>
          </div>
        </div>
      </form>
    </div>

    <div class="responsive-table print-table">
      <table class="text-dark mb-5 blur">
        <thead class="blur text-reset">
          <tr>
            <th scope="col">ردیف</th>
            <th scope="col">کد کاربر</th>
            <th scope="col">نام کاربر</th>
            <th scope="col">تاریخ شیفت</th>
            <th scope="col">شیفت</th>
            <th scope="col">ساعت شروع</th>
            <th scope="col">ساعت پایان</th>
            <th scope="col">تاریخ ثبت</th>
            <th scope="col">وضعیت</th>
            <th scope="col" class="no-print">عملیات</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $row_number = 1;
          $today = date('Y-m-d');

          foreach ($all_shifts as $shift) {
            $shift_class = ($shift['shift_date'] < $today) ? 'shift-past' : 'shift-future';
            $status = ($shift['shift_date'] < $today) ? 'گذشته' : 'آینده';
            if ($shift['shift_date'] == $today) {
              $shift_class = 'shift-today';
              $status = 'امروز';
            }

            echo "<tr class='$shift_class'>";
            echo "<td>" . $row_number++ . "</td>";
            echo "<td>" . htmlspecialchars($shift['u_code']) . "</td>";
            echo "<td>" . htmlspecialchars($shift['u_name']) . " " . htmlspecialchars($shift['u_family']) . "</td>";
            echo "<td>" . persian_date($shift['shift_date']) . "</td>";
            echo "<td>شیفت " . $shift['shift_number'] . "</td>";
            echo "<td>" . substr($shift['shift_start'], 0, 5) . "</td>";
            echo "<td>" . substr($shift['shift_end'], 0, 5) . "</td>";
            echo "<td>" . persian_date_time($shift['registered_at']) . "</td>";
            if ($status == "آینده") {
              echo "<td>" . $status . "</td>";
            } elseif ($status == "امروز" || $status == "گذشته") {
              if (!empty($shift['shift_status'])) {
                echo "<td>" . htmlspecialchars($shift['shift_status'])." ";
                echo '<a href="A_Delete_Shift_Status_Action.php?id=' . $shift['id'] . '" class="no-print btn btn-secondary btn-sm" 
                  onclick="return confirm(\'آیا از حذف وضعیت این شیفت اطمینان دارید؟\')">
                  <i class=""></i> ویرایش
                  </a>';
                echo "</td>";
              } else {
                echo '<td class="no-print">
                    <a href="A_Shift_Status_Action.php?id=' . $shift['id'] . '&status=حضور" class="btn btn-success  btn-sm" 
                       onclick="return confirm(\'آیا از ثبت حضور برای این شیفت اطمینان دارید؟\')">
                       <i class=""></i> حضور
                    </a>
                    <a href="A_Shift_Status_Action.php?id=' . $shift['id'] . '&status=غیبت" class="btn btn-danger  btn-sm" 
                       onclick="return confirm(\'آیا از ثبت غیبت برای این شیفت اطمینان دارید؟\')">
                       <i class=""></i> غیبت
                    </a>
                  </td>';
              }
            }
            if ($shift['shift_date'] >= $today) {
              echo '<td class="no-print">
                    <a href="A_Delete_Shift_Action.php?id=' . $shift['id'] . '" class="btn btn-warning btn-sm" 
                       onclick="return confirm(\'آیا از حذف این شیفت اطمینان دارید؟\')">
                       <i class="fas fa-trash-alt"></i> حذف
                    </a>
                  </td>';
            } else {
              echo '<td class="no-print">
                    <button class="btn btn-warning btn-sm" disabled><i class="fas fa-trash-alt"></i> حذف</button>
                  </td>';
            }
            echo "</tr>";
          }

          if (count($all_shifts) === 0) {
            echo '<tr><td colspan="10" class="text-center py-4">هیچ شیفتی یافت نشد</td></tr>';
          }
          ?>
        </tbody>
      </table>
    </div>

    <!-- دکمه‌های چاپ و خروجی اکسل -->
    <div class="text-center mb-5 no-print">
      <button onclick="printTable()" class="btn btn-light blur col-12 col-md-2 col-lg-1 mx-1">چاپ <i
          class="fas fa-print"></i></button>
      <button onclick="exportToExcel()" class="btn btn-light blur col-12 col-md-3 col-lg-2 mx-1">خروجی Excel <i
          class="fas fa-file-excel"></i></button>
    </div>
  </div>
  <!--Main-->

 

  <script>
    function printTable() {
      window.print();
    }

    function exportToExcel() {
      // ایجاد یک جدول موقت برای اکسل
      let html = "<table>";
      html += "<tr>";
      html += "<th>ردیف</th>";
      html += "<th>کد کاربر</th>";
      html += "<th>نام کاربر</th>";
      html += "<th>تاریخ شیفت</th>";
      html += "<th>شیفت</th>";
      html += "<th>ساعت شروع</th>";
      html += "<th>ساعت پایان</th>";
      html += "<th>تاریخ ثبت</th>";
      html += "<th>وضعیت</th>";
      html += "</tr>";

      // اضافه کردن ردیف‌های داده
      <?php
      $row_num = 1;
      foreach ($all_shifts as $shift) {
        $status = ($shift['shift_date'] < date('Y-m-d')) ? 'گذشته' : 'آینده';
        echo "html += \"<tr>\";\n";
        echo "html += \"<td>" . $row_num++ . "</td>\";\n";
        echo "html += \"<td>" . $shift['u_code'] . "</td>\";\n";
        echo "html += \"<td>" . $shift['u_name'] . " " . $shift['u_family'] . "</td>\";\n";
        echo "html += \"<td>" . persian_date($shift['shift_date']) . "</td>\";\n";
        echo "html += \"<td>شیفت " . $shift['shift_number'] . "</td>\";\n";
        echo "html += \"<td>" . substr($shift['shift_start'], 0, 5) . "</td>\";\n";
        echo "html += \"<td>" . substr($shift['shift_end'], 0, 5) . "</td>\";\n";
        echo "html += \"<td>" . persian_date_time($shift['registered_at']) . "</td>\";\n";
        echo "html += \"<td>" . (!empty($shift['shift_status']) ? $shift['shift_status'] : $status) . "</td>\";\n";
        echo "html += \"</tr>\";\n";
      }
      ?>

      html += "</table>";

      // ایجاد فایل اکسل
      let blob = new Blob([html], {
        type: "application/vnd.ms-excel"
      });
      let url = URL.createObjectURL(blob);
      let a = document.createElement("a");
      a.href = url;
      a.download = "شیفت_های_ثبت_شده.xls";
      document.body.appendChild(a);
      a.click();
      document.body.removeChild(a);
    }
  </script>
</body>

</html>

<?php
// تابع تبدیل تاریخ میلادی به شمسی
function persian_date($date)
{
  // اینجا باید کد تبدیل تاریخ میلادی به شمسی قرار گیرد
  // می‌توانید از کتابخانه‌هایی مانند jdf استفاده کنید
  return $date;
}

// تابع تبدیل تاریخ و زمان میلادی به شمسی
function persian_date_time($datetime)
{
  // اینجا باید کد تبدیل تاریخ و زمان میلادی به شمسی قرار گیرد
  return $datetime;
}
?>

 <?php include "Footer.php"; ?>
<?php
include "Checklogin.php";
include "connection.php";

// دریافت شناسه کاربر از session
$user_id = $_SESSION['user_id'];

// دریافت اطلاعات شیفت‌های کاربر
$sql = "SELECT 
            us.id,
            us.registered_at,
            s.id as shift_id,
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
            us.shift_number
        FROM as_user_shifts us
        JOIN as_shifts s ON us.shift_id = s.id
        WHERE us.user_id = ?
        ORDER BY s.shift_date DESC, us.shift_number";

$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$user_shifts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// پردازش حذف شیفت اگر درخواست شده باشد
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_shift'])) {
  $shift_to_delete = (int) $_POST['shift_id'];

  // بررسی مالکیت شیفت
  $stmt = $pdo->prepare("SELECT us.id, s.shift_date 
                          FROM as_user_shifts us
                          JOIN as_shifts s ON us.shift_id = s.id
                          WHERE us.id = ? AND us.user_id = ?");
  $stmt->execute([$shift_to_delete, $user_id]);
  $shift_info = $stmt->fetch();

  if ($shift_info) {
    $today = date('Y-m-d');
    $shift_date = $shift_info['shift_date'];

    // فقط اجازه حذف شیفت‌های آینده را داریم
    if ($shift_date >= $today) {
      try {
        $pdo->beginTransaction();

        // حذف شیفت
        $stmt = $pdo->prepare("DELETE FROM as_user_shifts WHERE id = ?");
        $stmt->execute([$shift_to_delete]);

        $pdo->commit();

        // رفرش صفحه برای نمایش تغییرات
        header("Location: U_Shifts_History.php?success=shift_deleted");
        exit;
      } catch (PDOException $e) {
        $pdo->rollBack();
        $error = "خطا در حذف شیفت: " . $e->getMessage();
      }
    } else {
      $error = "امکان حذف شیفت‌های گذشته وجود ندارد";
    }
  } else {
    $error = "شیفت مورد نظر یافت نشد یا شما مجاز به حذف آن نیستید";
  }
}


?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <title>تاریخچه شیفت‌های من</title>
  <?php include "Header.php"; ?>

  <style>
    /* استایل‌های عمومی جدول */
    .responsive-table {
      width: 100%;
      overflow-x: auto;
    }

    table {
      min-width: 700px;
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

    /* استایل دکمه حذف */
    .btn-delete {
      padding: 0.25rem 0.5rem;
      font-size: 0.8rem;
    }
  </style>
</head>

<body>
  <!--Main-->
  <div class="container blur pb-3" style="border-radius: 1rem">
    <h2 class="text-center text-dark my-4 p-3">تاریخچه شیفت‌های من</h2>

    <?php if (isset($error)): ?>
      <div class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
    <?php elseif (isset($_GET['success']) && $_GET['success'] === 'shift_deleted'): ?>
      <div class="alert alert-success text-center">شیفت با موفقیت حذف شد</div>
    <?php elseif (isset($_GET['success']) && $_GET['success'] === 'shift_registered'): ?>
      <div class="alert alert-success text-center">شیفت با موفقیت ثبت شد</div>
      <?php endif; ?>

    <div class="responsive-table print-table">
      <table class="text-dark mb-5 blur">
        <thead class="blur">
          <tr>
            <th scope="col">ردیف</th>
            <th scope="col">تاریخ</th>
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

          foreach ($user_shifts as $shift) {
            $shift_class = ($shift['shift_date'] < $today) ? 'shift-past' : 'shift-future';
            $status = ($shift['shift_date'] < $today) ? 'گذشته' : 'آینده';

            if ($shift['shift_date'] == $today) {
              $shift_class = 'shift-today';
              $status = 'امروز';
            }

            echo "<tr class='$shift_class'>";
            echo "<td>" . $row_number++ . "</td>";
            echo "<td>" . persian_date($shift['shift_date']) . "</td>";
            echo "<td>شیفت " . $shift['shift_number'] . "</td>";
            echo "<td>" . substr($shift['shift_start'], 0, 5) . "</td>";
            echo "<td>" . substr($shift['shift_end'], 0, 5) . "</td>";
            echo "<td>" . persian_date_time($shift['registered_at']) . "</td>";
            echo "<td>" . $status . "</td>";

            echo '<td class="no-print">';
            if ($shift['shift_date'] >= $today) {
              echo '<form method="post" style="display:inline;" 
                      onsubmit="return confirm(\'آیا از حذف این شیفت اطمینان دارید؟\');">
                      <input type="hidden" name="shift_id" value="' . $shift['id'] . '">
                      <button type="submit" name="delete_shift" class="btn btn-light blur btn-delete">
                          <i class="fas fa-trash-alt"></i> حذف
                      </button>
                  </form>';
            } else {
              echo ' <button type="button" class="btn btn-light blur btn-delete" disabled>
                          <i class="fas fa-trash-alt"></i> حذف
                      </button>';
            }
            echo '</td>';

            echo "</tr>";
          }

          if (count($user_shifts) === 0) {
            echo '<tr><td colspan="8" class="text-center py-4">هیچ شیفتی ثبت نشده است</td></tr>';
          }
          ?>
        </tbody>
      </table>
    </div>

    <!-- دکمه چاپ در پایین صفحه -->
    <div class="text-center mb-5 no-print">
      <button onclick="printTable()" class="btn btn-light blur col-12 col-md-3 col-lg-2">چاپ <i
          class="fas fa-print"></i></button>
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
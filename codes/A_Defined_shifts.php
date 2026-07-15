<?php
include "Checklogin.php";
include "Check_Admin.php";
include "connection.php";

// دریافت پارامترهای جستجو
$search_date = isset($_GET['date']) ? $_GET['date'] : '';
$page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$per_page = 15; // تعداد رکوردها در هر صفحه

// ساخت کوئری با فیلترهای جستجو
$sql = "SELECT * FROM as_shifts WHERE 1=1";
$count_sql = "SELECT COUNT(*) FROM as_shifts WHERE 1=1";
$params = [];
$count_params = [];

if (!empty($search_date)) {
    $sql .= " AND shift_date = :date";
    $count_sql .= " AND shift_date = :date";
    $params[':date'] = $search_date;
    $count_params[':date'] = $search_date;
}

// مرتب سازی
$sql .= " ORDER BY shift_date DESC";

// صفحه‌بندی با استفاده از named parameters
$sql .= " LIMIT :per_page OFFSET :offset";
$params[':per_page'] = $per_page;
$params[':offset'] = ($page - 1) * $per_page;

// اجرای کوئری اصلی
$stmt = $pdo->prepare($sql);
foreach ($params as $key => $value) {
    $param_type = (strpos($key, 'per_page') !== false || strpos($key, 'offset') !== false)
        ? PDO::PARAM_INT
        : PDO::PARAM_STR;
    $stmt->bindValue($key, $value, $param_type);
}
$stmt->execute();
$shifts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// محاسبه تعداد کل رکوردها
$stmt = $pdo->prepare($count_sql);
foreach ($count_params as $key => $value) {
    $stmt->bindValue($key, $value);
}
$stmt->execute();
$total_shifts = $stmt->fetchColumn();
$total_pages = ceil($total_shifts / $per_page);

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <title>مدیریت شیفت‌های تعریف شده</title>
    <?php include "Header.php"; ?>

    <style>
        .responsive-table {
            width: 100%;
            overflow-x: auto;
        }

        table {
            min-width: 900px;
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 8px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }



        .pagination {
            justify-content: center;
        }

        .search-box {

            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

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

        .glass-pagination {
            color: #000;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .glass-pagination .page-item .page-link {
            color: #000;
            background-color: transparent;
            border: none;
            transition: all 0.3s ease;
        }

        .glass-pagination .page-item.active .page-link {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            font-weight: bold;
        }

        .glass-pagination .page-item .page-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container blur pb-3" style="border-radius: 1rem">
        <h2 class="text-center text-dark my-4 p-3">شیفت‌های تعریف شده</h2>

        <div class="row">
            <div class="col-md-3 col-lg-4"></div>
            <div class="col-12 col-lg-4 col-md-6 text-center">
                <?php if (isset($_GET['success']) && $_GET['success'] == "shift_created"): ?>
                    <!-- پیام موفقیت ایجاد شیفت با استایل یکسان -->
                    <div class="alert alert-success mb-4 p-3 font-weight-bold" style="border-radius: 1rem">
                        <i class="fas fa-check-circle"></i> شیفت با موفقیت ایجاد شد
                    </div>

                    <?php if (isset($_GET['deleted_registrations']) && !empty($_GET['deleted_registrations'])): ?>
                        <div class="alert alert-warning mb-4 p-3 font-weight-bold" style="border-radius: 1rem">
                            <i class="fas fa-exclamation-triangle"></i>
                            توجه: <?php echo htmlspecialchars($_GET['deleted_registrations']) ?> شیفت قبلی به دلیل تداخل زمانی حذف گردید
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="col-md-3 col-lg-4"></div>
        </div>

        <!-- بخش جستجو -->
        <div class="search-box">
            <form method="get" action="">
                <div class="row">
                    <div class="col-md-3 col-12 mb-3">
                        <label for="date" class="form-label">جستجو بر اساس تاریخ</label>
                        <input type="date" id="date" name="date" class="form-control blur"
                            value="<?= htmlspecialchars($search_date) ?>">
                    </div>
                    <div class="col-md-2 col-12 d-flex align-items-end mb-3">
                        <button type="submit" class="btn btn-light blur w-100">جستجو</button>
                        <?php if (!empty($search_date)): ?>
                            <a href="A_Defined_Shifts.php" class="btn btn-outline-danger mr-2">حذف فیلتر</a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>

        <div class="responsive-table print-table">
            <table class="text-dark mb-5 blur">
                <thead class="blur">
                    <tr>
                        <th>ردیف</th>
                        <th>تاریخ</th>
                        <th>شیفت 1</th>
                        <th>حداکثر خادم افتخاری <br>(شیفت 1)</th>
                        <th>شیفت 2</th>
                        <th>حداکثر خادم افتخاری <br>(شیفت 2)</th>
                        <th>شیفت 3</th>
                        <th>حداکثر خادم افتخاری <br>(شیفت 3)</th>
                        <th>توضیحات</th>
                        <th class="no-print">عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($shifts) > 0): ?>
                        <?php foreach ($shifts as $index => $shift): ?>
                            <?php
                            $today = date('Y-m-d');
                            $shift_class = ($shift['shift_date'] < $today) ? 'shift-past' : ($shift['shift_date'] == $today ? 'shift-today' : 'shift-future');
                            ?>
                            <tr class="<?= $shift_class ?>">
                                <td><?= ($page - 1) * $per_page + $index + 1 ?></td>
                                <td><?= persian_date($shift['shift_date']) ?></td>
                                <td><?= substr($shift['shift_start1'], 0, 5) ?> - <?= substr($shift['shift_end1'], 0, 5) ?></td>
                                <td><?= $shift['max_users1'] ?></td>
                                <td><?= substr($shift['shift_start2'], 0, 5) ?> - <?= substr($shift['shift_end2'], 0, 5) ?></td>
                                <td><?= $shift['max_users2'] ?></td>
                                <td><?= substr($shift['shift_start3'], 0, 5) ?> - <?= substr($shift['shift_end3'], 0, 5) ?></td>
                                <td><?= $shift['max_users3'] ?></td>
                                <td><?= htmlspecialchars($shift['description']) ?></td>
                                <td class="no-print">
                                    <a href="A_Delete_Shift_Definition.php?id=<?= $shift['id'] ?>"
                                        class="btn btn-sm btn-warning"
                                        onclick="return confirm('آیا از حذف این شیفت اطمینان دارید؟ تمام ثبت‌نام‌های مرتبط نیز حذف خواهند شد.')">
                                        <i class="fas fa-trash-alt"></i> حذف
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" class="text-center py-4">هیچ شیفتی یافت نشد</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- صفحه‌بندی -->

        <?php if ($total_pages > 1): ?>
            <nav aria-label="Page navigation" class="d-flex justify-content-center">
                <ul class="pagination glass-pagination">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?date=<?= urlencode($search_date) ?>&page=<?= $page - 1 ?>"
                                aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?date=<?= urlencode($search_date) ?>&page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?date=<?= urlencode($search_date) ?>&page=<?= $page + 1 ?>"
                                aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>


        <div class="text-center mb-5 no-print">
            <button onclick="printTable()" class="btn btn-light blur col-12 col-md-2 col-lg-1 my-3 mx-1">چاپ <i
                    class="fas fa-print"></i></button>
            <a href="A_Create_Shift.php">
                <button class="btn btn-light blur col-12 col-md-3 col-lg-2 my-3 mx-1">ایجاد شیفت جدید <i
                        class="fa fa-plus"></i></button></a>
        </div>
    </div>

    <script>
        function printTable() {
            window.print();
        }
    </script>

    <?php include "Footer.php"; ?>

    <?php
    // تابع تبدیل تاریخ میلادی به شمسی
    function persian_date($date)
    {
        // پیاده‌سازی تبدیل تاریخ میلادی به شمسی
        // می‌توانید از کتابخانه‌هایی مانند jdf استفاده کنید
        $date = new DateTime($date);
        $year = $date->format('Y');
        $month = $date->format('m');
        $day = $date->format('d');

        // اینجا باید کد تبدیل میلادی به شمسی قرار گیرد
        // به عنوان مثال ساده:
        return "$year/$month/$day";
    }
    ?>
</body>

</html>
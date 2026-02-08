<?php
include "session.php";
include '_db/connect.php';

// Sanitize GET parameters to prevent SQL Injection
$values1_raw = $_GET["values1"] ?? '';
$values2_raw = $_GET["values2"] ?? '';
$total_menu_raw = $_GET['total_menu'] ?? '';
$amount1 = intval($_GET['amount1'] ?? 0);
$amount2 = intval($_GET['amount2'] ?? 0);

// Ensure all IDs are integers only
$values1 = implode(',', array_map('intval', array_filter(explode(',', $values1_raw), 'strlen')));
$values2 = implode(',', array_map('intval', array_filter(explode(',', $values2_raw), 'strlen')));
$total_menu = implode(',', array_map('intval', array_filter(explode(',', $total_menu_raw), 'strlen')));
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>สรุปวัตถุดิบ (เนื้อสัตว์) - รพ.เทพา</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { box-sizing: border-box; }
        
        body {
            font-family: 'Sarabun', sans-serif;
            font-size: 13px;
            background: #f0f2f5;
            margin: 0;
            padding: 20px;
        }
        
        .print-page {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .report-header {
            background: linear-gradient(135deg, #c05621 0%, #dd6b20 100%);
            color: #fff;
            padding: 25px 30px;
            position: relative;
        }
        
        .report-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #f6ad55, #ed8936);
        }
        
        .header-content {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .logo-container {
            width: 80px;
            height: 80px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        
        .logo-container img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }
        
        .header-text h1 {
            font-size: 22px;
            font-weight: 600;
            margin: 0 0 5px 0;
        }
        
        .header-text .hospital-name {
            font-size: 16px;
            opacity: 0.9;
            margin: 0;
        }
        
        .header-text .report-type {
            font-size: 14px;
            background: rgba(255,255,255,0.2);
            padding: 4px 12px;
            border-radius: 20px;
            display: inline-block;
            margin-top: 8px;
        }
        
        .info-section {
            background: #fffaf0;
            padding: 20px 30px;
            border-bottom: 1px solid #feebc8;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .info-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #c05621, #dd6b20);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }
        
        .info-label {
            font-size: 11px;
            color: #c05621;
            text-transform: uppercase;
        }
        
        .info-value {
            font-size: 15px;
            font-weight: 600;
            color: #1a202c;
        }
        
        .table-section {
            padding: 25px 30px;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #c05621;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-title i {
            color: #ed8936;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin-bottom: 25px;
        }
        
        .data-table thead th {
            background: linear-gradient(135deg, #c05621, #dd6b20);
            color: #fff;
            padding: 12px 10px;
            text-align: center;
            font-weight: 500;
            border: none;
        }
        
        .data-table thead th:first-child {
            border-radius: 8px 0 0 0;
        }
        
        .data-table thead th:last-child {
            border-radius: 0 8px 0 0;
        }
        
        .data-table tbody td {
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: middle;
        }
        
        .data-table tbody tr:hover {
            background: #fffaf0;
        }
        
        .data-table tbody tr.row-special {
            background: #ebf8ff;
        }
        
        .data-table tbody tr.row-normal {
            background: #fffbeb;
        }
        
        .badge-type {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
        }
        
        .badge-special {
            background: #3182ce;
            color: #fff;
        }
        
        .badge-normal {
            background: #d69e2e;
            color: #fff;
        }
        
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        .date-line {
            background: #fffaf0;
            padding: 15px 20px;
            border: 2px dashed #ed8936;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .date-line label {
            font-weight: 500;
            color: #c05621;
        }
        
        .date-line .date-input {
            flex: 1;
            border: none;
            border-bottom: 2px dotted #ed8936;
            background: transparent;
            font-family: 'Sarabun', sans-serif;
            font-size: 14px;
            padding: 5px;
        }
        
        .report-footer {
            background: #fffaf0;
            padding: 20px 30px;
            border-top: 1px solid #feebc8;
            text-align: center;
        }
        
        .footer-line {
            height: 3px;
            background: linear-gradient(90deg, #c05621, #f6ad55, #c05621);
            margin-bottom: 15px;
            border-radius: 2px;
        }
        
        .footer-text {
            color: #4a5568;
            font-size: 11px;
        }
        
        .footer-text strong {
            color: #c05621;
        }
        
        .print-actions {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
            z-index: 1000;
        }
        
        .btn-action {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            font-family: 'Sarabun', sans-serif;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }
        
        .btn-print {
            background: linear-gradient(135deg, #c05621, #dd6b20);
            color: #fff;
        }
        
        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(192,86,33,0.4);
        }
        
        .btn-close-page {
            background: #e2e8f0;
            color: #475569;
        }
        
        .btn-close-page:hover {
            background: #cbd5e1;
        }
        
        /* Mobile Responsive */
        @media screen and (max-width: 768px) {
            body { padding: 5px; }
            
            .print-page { border-radius: 8px; }
            
            .report-header { padding: 15px; }
            .header-content { flex-direction: column; text-align: center; gap: 10px; }
            .header-text h1 { font-size: 17px; }
            .header-text .hospital-name { font-size: 13px; }
            .header-text .report-type { font-size: 12px; }
            .logo-container { width: 60px; height: 60px; }
            .logo-container img { width: 45px; height: 45px; }
            
            .info-section { padding: 12px 15px; }
            .info-grid { grid-template-columns: 1fr 1fr; gap: 10px; }
            .info-icon { width: 32px; height: 32px; font-size: 12px; }
            .info-label { font-size: 10px; }
            .info-value { font-size: 13px; }
            
            .table-section { padding: 15px 10px; overflow-x: auto; -webkit-overflow-scrolling: touch; }
            .section-title { font-size: 14px; }
            
            .data-table { min-width: 600px; font-size: 11px; }
            .data-table thead th { padding: 8px 5px; font-size: 11px; }
            .data-table tbody td { padding: 6px 5px; }
            
            .print-actions { top: 10px; right: 10px; }
            .btn-action { padding: 8px 12px; font-size: 12px; }
            
            .report-footer { padding: 15px; }
        }
        
        @media print {
            body {
                background: #fff;
                padding: 0;
            }
            
            .print-page {
                box-shadow: none;
                border-radius: 0;
            }
            
            .print-actions {
                display: none;
            }
            
            .report-header,
            .data-table thead th,
            .data-table tbody tr.row-special,
            .data-table tbody tr.row-normal {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="print-actions">
        <button class="btn-action btn-print" onclick="window.print()">
            <i class="fas fa-print"></i> พิมพ์รายงาน
        </button>
        <button class="btn-action btn-close-page" onclick="window.close()">
            <i class="fas fa-times"></i> ปิด
        </button>
    </div>

    <div class="print-page">
        <div class="report-header">
            <div class="header-content">
                <div class="logo-container">
                    <img src="images/logo.png" alt="รพ.เทพา">
                </div>
                <div class="header-text">
                    <h1>รายงานสรุปวัตถุดิบ (เนื้อสัตว์)</h1>
                    <p class="hospital-name">โรงพยาบาลเทพา จังหวัดสงขลา</p>
                    <span class="report-type"><i class="fas fa-drumstick-bite"></i> วัตถุดิบประเภทเนื้อสัตว์</span>
                </div>
            </div>
        </div>
        
        <div class="info-section">
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-calendar-alt"></i></div>
                    <div>
                        <div class="info-label">วันที่พิมพ์</div>
                        <div class="info-value"><?= date('d/m/Y'); ?></div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-clock"></i></div>
                    <div>
                        <div class="info-label">เวลา</div>
                        <div class="info-value"><?= date('H:i'); ?> น.</div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-user-injured"></i></div>
                    <div>
                        <div class="info-label">ผู้ป่วยห้องธรรมดา</div>
                        <div class="info-value"><?= number_format($amount1); ?> คน</div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-star"></i></div>
                    <div>
                        <div class="info-label">ผู้ป่วยห้องพิเศษ</div>
                        <div class="info-value"><?= number_format($amount2); ?> คน</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="table-section">
            <div class="date-line">
                <label><i class="fas fa-calendar-check"></i> วันที่ใช้วัตถุดิบ:</label>
                <input type="text" class="date-input" placeholder="...................................................................">
            </div>
            
            <!-- ส่วนเมนูอาหาร -->
            <div class="section-title">
                <i class="fas fa-utensils"></i> 1. เมนูอาหาร
            </div>
            
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="15%">มื้อ</th>
                        <th width="20%">ประเภท</th>
                        <th width="65%">เมนู</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_menu = "SELECT menu_name, 'พิเศษ' type FROM menu WHERE menu_id IN ($values2)
                                UNION
                                SELECT menu_name, 'ธรรมดา' type FROM menu WHERE menu_id IN ($values1)";
                    $res_menu = mysqli_query($conn, $sql_menu);
                    
                    while ($row_menu = mysqli_fetch_array($res_menu)) {
                        $badgeClass = ($row_menu['type'] == 'พิเศษ') ? 'badge-special' : 'badge-normal';
                        ?>
                        <tr>
                            <td class="text-center"></td>
                            <td class="text-center"><span class="badge-type <?= $badgeClass; ?>"><?= $row_menu['type']; ?></span></td>
                            <td><?= htmlspecialchars($row_menu['menu_name']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            
            <!-- ส่วนวัตถุดิบเนื้อสัตว์ -->
            <div class="section-title">
                <i class="fas fa-drumstick-bite"></i> 2. วัตถุดิบ (เนื้อสัตว์)
            </div>
            
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="8%">ลำดับ</th>
                        <th width="30%">วัตถุดิบ</th>
                        <th width="12%">กรัม</th>
                        <th width="12%">กิโลกรัม</th>
                        <th width="10%">ฟอง</th>
                        <th width="10%">ตัว</th>
                        <th width="18%">หมายเหตุ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row_num = 1;
                    
                    // ห้องพิเศษ - เฉพาะเนื้อสัตว์ (staple_type_id = 2)
                    if (!empty($values2)) {
                        $sql3 = "SELECT m.menu_name, s.staple_name, s.staple_serve, s.staple_yield, s.is_fish,
                                f.factor_value
                                FROM staple s
                                LEFT JOIN menu m ON m.menu_id = s.menu_id
                                LEFT JOIN menu_type t ON t.menu_type_id = m.menu_type_id
                                LEFT JOIN factor f ON f.staple_name = s.staple_name AND f.menu_type_id = t.menu_type_id
                                WHERE m.menu_id IN ($values2) AND s.staple_type_id = 2 
                                ORDER BY s.staple_name";
                        $res3 = mysqli_query($conn, $sql3);
                        
                        while ($row3 = mysqli_fetch_array($res3)) {
                            $yield3 = ($row3['staple_serve'] * $row3['factor_value'] * 100) / $row3['staple_yield'];
                            ?>
                            <tr class="row-special">
                                <td class="text-center"><?= $row_num; ?></td>
                                <td><?= htmlspecialchars($row3['staple_name']); ?></td>
                                <td class="text-right"><?= number_format($yield3 * $amount2, 1); ?></td>
                                <td class="text-right"><?= number_format(($yield3 * $amount2) / 1000, 2); ?></td>
                                <td class="text-center">
                                    <?php if (strpos($row3['staple_name'], 'ไข่') !== false) {
                                        echo number_format(($yield3 * $amount2) / 31.9, 1);
                                    } else {
                                        echo '-';
                                    } ?>
                                </td>
                                <td class="text-center"><?= ($row3['is_fish'] == 1) ? $amount2 : '-'; ?></td>
                                <td></td>
                            </tr>
                            <?php
                            $row_num++;
                        }
                    }
                    
                    // ห้องธรรมดา - เฉพาะเนื้อสัตว์
                    if (!empty($values1)) {
                        $sql = "SELECT m.menu_name, s.staple_name, s.staple_serve, s.staple_yield, s.is_fish,
                                f.factor_value
                                FROM staple s
                                LEFT JOIN menu m ON m.menu_id = s.menu_id
                                LEFT JOIN menu_type t ON t.menu_type_id = m.menu_type_id
                                LEFT JOIN factor f ON f.staple_name = s.staple_name AND f.menu_type_id = t.menu_type_id
                                WHERE m.menu_id IN ($values1) AND s.staple_type_id = 2 
                                ORDER BY s.staple_name";
                        $res = mysqli_query($conn, $sql);
                        
                        while ($row = mysqli_fetch_array($res)) {
                            $yield = ($row['staple_serve'] * $row['factor_value'] * 100) / $row['staple_yield'];
                            ?>
                            <tr class="row-normal">
                                <td class="text-center"><?= $row_num; ?></td>
                                <td><?= htmlspecialchars($row['staple_name']); ?></td>
                                <td class="text-right"><?= number_format($yield * $amount1, 1); ?></td>
                                <td class="text-right"><?= number_format(($yield * $amount1) / 1000, 2); ?></td>
                                <td class="text-center">
                                    <?php if (strpos($row['staple_name'], 'ไข่') !== false) {
                                        echo number_format(($yield * $amount1) / 31.9, 1);
                                    } else {
                                        echo '-';
                                    } ?>
                                </td>
                                <td class="text-center"><?= ($row['is_fish'] == 1) ? $amount1 : '-'; ?></td>
                                <td></td>
                            </tr>
                            <?php
                            $row_num++;
                        }
                    }
                    
                    if ($row_num == 1) {
                        echo '<tr><td colspan="7" class="text-center" style="padding: 30px; color: #a0aec0;"><i class="fas fa-inbox fa-2x"></i><br>ไม่มีข้อมูลวัตถุดิบประเภทเนื้อสัตว์</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="report-footer">
            <div class="footer-line"></div>
            <p class="footer-text">
                <strong>โรงพยาบาลเทพา</strong> | ระบบคำนวณวัตถุดิบอาหาร v2.0<br>
                เอกสารนี้พิมพ์จากระบบอัตโนมัติ | <?= date('d/m/Y H:i:s'); ?>
            </p>
        </div>
    </div>
</body>
</html>

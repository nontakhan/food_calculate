<?php
include "session.php";
include '_db/connect.php';

// Sanitize GET parameters to prevent SQL Injection
$values1_raw = $_GET["values1"] ?? '';
$values2_raw = $_GET["values2"] ?? '';
$amount1 = intval($_GET['amount1'] ?? 0);
$amount2 = intval($_GET['amount2'] ?? 0);

// Ensure all IDs are integers only
$values1 = implode(',', array_map('intval', array_filter(explode(',', $values1_raw), 'strlen')));
$values2 = implode(',', array_map('intval', array_filter(explode(',', $values2_raw), 'strlen')));

// Combine all menu IDs
$all_menu_ids = array_filter(array_merge(
    explode(',', $values1),
    explode(',', $values2)
), 'strlen');
$all_menu_ids_str = implode(',', array_map('intval', $all_menu_ids));
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>สรุปรายการซื้อวัตถุดิบ - รพ.เทพา</title>
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
        
        /* Header */
        .report-header {
            background: linear-gradient(135deg, #1e3a5f 0%, #2c5282 100%);
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
            background: linear-gradient(90deg, #48bb78, #38a169);
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
        
        /* Info Section */
        .info-section {
            background: #f8fafc;
            padding: 20px 30px;
            border-bottom: 1px solid #e2e8f0;
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
            background: linear-gradient(135deg, #1e3a5f, #2c5282);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }
        
        .info-label {
            font-size: 11px;
            color: #64748b;
            text-transform: uppercase;
        }
        
        .info-value {
            font-size: 15px;
            font-weight: 600;
            color: #1e293b;
        }
        
        /* Table Section */
        .table-section {
            padding: 25px 30px;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #1e3a5f;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-title i {
            color: #48bb78;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        
        .data-table thead th {
            background: linear-gradient(135deg, #1e3a5f, #2c5282);
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
            background: #f8fafc;
        }
        
        .data-table tbody tr.total-row {
            background: #fef3c7;
            font-weight: 600;
        }
        
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        /* Footer */
        .report-footer {
            background: #f8fafc;
            padding: 20px 30px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
        }
        
        .footer-line {
            height: 3px;
            background: linear-gradient(90deg, #1e3a5f, #48bb78, #1e3a5f);
            margin-bottom: 15px;
            border-radius: 2px;
        }
        
        .footer-text {
            color: #64748b;
            font-size: 11px;
        }
        
        .footer-text strong {
            color: #1e3a5f;
        }
        
        /* Print Button */
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
            background: linear-gradient(135deg, #1e3a5f, #2c5282);
            color: #fff;
        }
        
        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30,58,95,0.4);
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
            
            .report-header {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            
            .data-table thead th {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            
            .data-table tbody tr.total-row {
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
                    <h1>รายงานสรุปการซื้อวัตถุดิบ</h1>
                    <p class="hospital-name">โรงพยาบาลเทพา จังหวัดสงขลา</p>
                    <span class="report-type"><i class="fas fa-shopping-cart"></i> รายการวัตถุดิบที่ต้องซื้อ</span>
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
            <div class="section-title">
                <i class="fas fa-list-alt"></i> รายการวัตถุดิบที่ต้องซื้อทั้งหมด
            </div>
            
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="5%">ลำดับ</th>
                        <th width="30%">วัตถุดิบ</th>
                        <th width="15%">ประเภท</th>
                        <th width="15%">กรัม</th>
                        <th width="10%">ฟอง</th>
                        <th width="10%">ตัว</th>
                        <th width="15%">กิโลกรัม</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $row_num = 1;
                    $ingredients = [];
                    
                    // Get all ingredients from selected menus
                    if (!empty($all_menu_ids_str)) {
                        $sql = "SELECT s.staple_name, s.staple_serve, s.staple_yield, s.is_fish,
                                f.factor_value, t.staple_type_name,
                                (s.staple_serve*f.factor_value*100)/s.staple_yield as yield_per_serving
                                FROM staple s
                                LEFT JOIN factor f ON f.staple_name = s.staple_name
                                LEFT JOIN staple_type t ON t.id = s.staple_type_id
                                WHERE s.menu_id IN ($all_menu_ids_str)
                                ORDER BY t.staple_type_name, s.staple_name";
                        
                        $result = mysqli_query($conn, $sql);
                        
                        while ($row = mysqli_fetch_array($result)) {
                            $staple_name = $row['staple_name'];
                            $type_name = $row['staple_type_name'] ?? 'ไม่ระบุ';
                            $yield_per_serving = $row['yield_per_serving'];
                            
                            // Initialize ingredient if not exists
                            if (!isset($ingredients[$staple_name])) {
                                $ingredients[$staple_name] = [
                                    'type' => $type_name,
                                    'grams' => 0,
                                    'eggs' => 0,
                                    'pieces' => 0,
                                    'kg' => 0
                                ];
                            }
                            
                            // Calculate for normal rooms
                            if (!empty($values1)) {
                                $ingredients[$staple_name]['grams'] += $yield_per_serving * $amount1;
                                if (strpos($staple_name, 'ไข่') !== false) {
                                    $ingredients[$staple_name]['eggs'] += ($yield_per_serving * $amount1) / 31.9;
                                }
                                if ($row['is_fish'] == 1) {
                                    $ingredients[$staple_name]['pieces'] += $amount1;
                                }
                            }
                            
                            // Calculate for special rooms
                            if (!empty($values2)) {
                                $ingredients[$staple_name]['grams'] += $yield_per_serving * $amount2;
                                if (strpos($staple_name, 'ไข่') !== false) {
                                    $ingredients[$staple_name]['eggs'] += ($yield_per_serving * $amount2) / 31.9;
                                }
                                if ($row['is_fish'] == 1) {
                                    $ingredients[$staple_name]['pieces'] += $amount2;
                                }
                            }
                        }
                    }
                    
                    // Display ingredients grouped by type
                    $current_type = '';
                    $type_totals = [];
                    
                    foreach ($ingredients as $name => $data) {
                        $type = $data['type'];
                        
                        // Type header
                        if ($type !== $current_type) {
                            if (!empty($current_type)) {
                                // Show type total
                                echo "<tr class='total-row'>";
                                echo "<td colspan='3' class='text-right'><strong>รวมประเภท $current_type:</strong></td>";
                                echo "<td class='text-right'><strong>" . number_format($type_totals[$current_type]['grams'], 1) . "</strong></td>";
                                echo "<td class='text-center'><strong>" . ($type_totals[$current_type]['eggs'] > 0 ? number_format($type_totals[$current_type]['eggs'], 1) : '-') . "</strong></td>";
                                echo "<td class='text-center'><strong>" . ($type_totals[$current_type]['pieces'] > 0 ? number_format($type_totals[$current_type]['pieces']) : '-') . "</strong></td>";
                                echo "<td class='text-right'><strong>" . number_format($type_totals[$current_type]['kg'], 2) . "</strong></td>";
                                echo "</tr>";
                            }
                            
                            $current_type = $type;
                            $type_totals[$current_type] = ['grams' => 0, 'eggs' => 0, 'pieces' => 0, 'kg' => 0];
                            
                            echo "<tr><td colspan='7' style='background: #e2e8f0; font-weight: 600; padding: 8px;'>ประเภท: $type</td></tr>";
                        }
                        
                        // Calculate kg
                        $kg = $data['grams'] / 1000;
                        
                        // Update type totals
                        $type_totals[$current_type]['grams'] += $data['grams'];
                        $type_totals[$current_type]['eggs'] += $data['eggs'];
                        $type_totals[$current_type]['pieces'] += $data['pieces'];
                        $type_totals[$current_type]['kg'] += $kg;
                        
                        echo "<tr>";
                        echo "<td class='text-center'>$row_num</td>";
                        echo "<td>" . htmlspecialchars($name) . "</td>";
                        echo "<td class='text-center'>" . htmlspecialchars($type) . "</td>";
                        echo "<td class='text-right'>" . number_format($data['grams'], 1) . "</td>";
                        echo "<td class='text-center'>" . ($data['eggs'] > 0 ? number_format($data['eggs'], 1) : '-') . "</td>";
                        echo "<td class='text-center'>" . ($data['pieces'] > 0 ? number_format($data['pieces']) : '-') . "</td>";
                        echo "<td class='text-right'>" . number_format($kg, 2) . "</td>";
                        echo "</tr>";
                        
                        $row_num++;
                    }
                    
                    // Show final type total
                    if (!empty($current_type)) {
                        echo "<tr class='total-row'>";
                        echo "<td colspan='3' class='text-right'><strong>รวมประเภท $current_type:</strong></td>";
                        echo "<td class='text-right'><strong>" . number_format($type_totals[$current_type]['grams'], 1) . "</strong></td>";
                        echo "<td class='text-center'><strong>" . ($type_totals[$current_type]['eggs'] > 0 ? number_format($type_totals[$current_type]['eggs'], 1) : '-') . "</strong></td>";
                        echo "<td class='text-center'><strong>" . ($type_totals[$current_type]['pieces'] > 0 ? number_format($type_totals[$current_type]['pieces']) : '-') . "</strong></td>";
                        echo "<td class='text-right'><strong>" . number_format($type_totals[$current_type]['kg'], 2) . "</strong></td>";
                        echo "</tr>";
                    }
                    
                    // Grand total
                    $grand_total = ['grams' => 0, 'eggs' => 0, 'pieces' => 0, 'kg' => 0];
                    foreach ($type_totals as $totals) {
                        $grand_total['grams'] += $totals['grams'];
                        $grand_total['eggs'] += $totals['eggs'];
                        $grand_total['pieces'] += $totals['pieces'];
                        $grand_total['kg'] += $totals['kg'];
                    }
                    
                    echo "<tr class='total-row' style='background: #dc2626; color: white;'>";
                    echo "<td colspan='3' class='text-right'><strong>รวมทั้งหมด:</strong></td>";
                    echo "<td class='text-right'><strong>" . number_format($grand_total['grams'], 1) . "</strong></td>";
                    echo "<td class='text-center'><strong>" . ($grand_total['eggs'] > 0 ? number_format($grand_total['eggs'], 1) : '-') . "</strong></td>";
                    echo "<td class='text-center'><strong>" . ($grand_total['pieces'] > 0 ? number_format($grand_total['pieces']) : '-') . "</strong></td>";
                    echo "<td class='text-right'><strong>" . number_format($grand_total['kg'], 2) . "</strong></td>";
                    echo "</tr>";
                    ?>
                </tbody>
            </table>
        </div>
        
        <div class="report-footer">
            <div class="footer-line"></div>
            <p class="footer-text">
                <strong>ระบบคำนวณวัตถุดิบอาหาร</strong> | 
                โรงพยาบาลเทพา จังหวัดสงขลา | 
                พิมพ์เมื่อ: <?= date('d/m/Y H:i'); ?>
            </p>
        </div>
    </div>
</body>
</html>

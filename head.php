<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ระบบคำนวณวัตถุดิบอาหาร - รพ.เทพา</title>
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
  
  <!-- Google Font: Sarabun -->
  <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
  <!-- DataTables Bootstrap 5 -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
  
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">

  <style>
    :root {
      --sidebar-width: 250px;
      --header-height: 56px;
      --primary-color: #1e3a5f;
      --primary-dark: #0d2137;
    }
    
    * { box-sizing: border-box; }
    
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Sarabun', sans-serif;
      font-size: 14px;
      background: #f4f6f9;
    }
    
    /* ===== LAYOUT ===== */
    .wrapper {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      padding-left: var(--sidebar-width);
    }
    
    /* ===== SIDEBAR ===== */
    .main-sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: var(--sidebar-width);
      height: 100vh;
      background: linear-gradient(180deg, var(--primary-color) 0%, var(--primary-dark) 100%);
      z-index: 1040;
      overflow-y: auto;
    }
    
    .brand-link {
      display: flex;
      align-items: center;
      height: var(--header-height);
      padding: 0 15px;
      background: rgba(0,0,0,0.15);
      color: #fff;
      text-decoration: none;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    
    .brand-link img {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      margin-right: 10px;
    }
    
    .brand-text {
      font-size: 14px;
      font-weight: 500;
      white-space: nowrap;
    }
    
    .sidebar {
      padding: 15px 0;
    }
    
    .nav-sidebar {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    
    .nav-header {
      padding: 10px 15px 5px;
      font-size: 11px;
      font-weight: 600;
      text-transform: uppercase;
      color: rgba(255,255,255,0.4);
    }
    
    .nav-item {
      margin: 2px 8px;
    }
    
    .nav-link {
      display: flex;
      align-items: center;
      padding: 10px 12px;
      color: rgba(255,255,255,0.85);
      border-radius: 5px;
      text-decoration: none;
      font-size: 13px;
      transition: all 0.2s;
    }
    
    .nav-link:hover {
      background: rgba(255,255,255,0.1);
      color: #fff;
    }
    
    .nav-link.active {
      background: #0d6efd;
      color: #fff;
    }
    
    .nav-link i {
      width: 20px;
      margin-right: 10px;
      text-align: center;
    }
    
    .nav-link p {
      margin: 0;
    }
    
    /* ===== CONTENT AREA ===== */
    .content-wrapper {
      flex: 1;
      display: flex;
      flex-direction: column;
      width: 100%;
    }
    
    /* ===== HEADER/NAVBAR ===== */
    .main-header {
      height: var(--header-height);
      background: #fff;
      border-bottom: 1px solid #dee2e6;
      display: flex;
      align-items: center;
      padding: 0 20px;
      width: 100%;
    }
    
    /* ===== CONTENT ===== */
    .content-header {
      padding: 20px 20px 10px;
    }
    
    .content-header h1 {
      font-size: 1.3rem;
      font-weight: 600;
      margin: 0;
      color: #333;
    }
    
    .content {
      flex: 1;
      padding: 0 20px 20px;
    }
    
    /* ===== FOOTER ===== */
    .main-footer {
      background: #fff;
      border-top: 1px solid #dee2e6;
      padding: 12px 20px;
      font-size: 12px;
      color: #6c757d;
      margin-left: var(--sidebar-width);
    }
    
    /* ===== CARDS ===== */
    .card {
      border: none;
      border-radius: 8px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    
    .card-header {
      background: #fff;
      border-bottom: 1px solid #e9ecef;
      padding: 15px 20px;
      font-weight: 500;
    }
    
    .card-body {
      padding: 20px;
    }
    
    /* ===== TABLES ===== */
    .table {
      width: 100% !important;
      margin-bottom: 0;
    }
    
    .table thead th {
      background: #f8f9fa;
      border-bottom: 2px solid #dee2e6;
      font-weight: 600;
      font-size: 13px;
      padding: 12px 15px;
      white-space: nowrap;
    }
    
    .table tbody td {
      padding: 10px 15px;
      vertical-align: middle;
      font-size: 13px;
    }
    
    /* ===== BUTTONS ===== */
    .btn { border-radius: 5px; }
    .btn-xs { padding: 4px 8px; font-size: 12px; }
    .btn-sm { padding: 6px 12px; font-size: 13px; }
    
    /* ===== FORMS ===== */
    .form-control, .form-select {
      border-radius: 5px;
      font-size: 13px;
    }
    
    .form-label {
      font-weight: 500;
      margin-bottom: 5px;
      font-size: 13px;
    }
    
    /* ===== MODALS ===== */
    .modal-content {
      border: none;
      border-radius: 10px;
    }
    
    .modal-header {
      background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
      color: #fff;
      border-radius: 10px 10px 0 0;
      padding: 15px 20px;
    }
    
    .modal-header .btn-close {
      filter: brightness(0) invert(1);
    }
    
    .modal-body { padding: 20px; }
    .modal-footer { padding: 12px 20px; border-top: 1px solid #e9ecef; }
    
    /* ===== DATATABLES ===== */
    .dataTables_wrapper {
      width: 100%;
    }
    
    .dataTables_wrapper .row {
      margin: 0;
      width: 100%;
    }
    
    .dataTables_wrapper .col-sm-12 {
      padding: 0;
    }
    
    /* ===== MOBILE ===== */
    .sidebar-toggle {
      display: none;
      background: none;
      border: none;
      font-size: 20px;
      padding: 5px 10px;
      margin-right: 15px;
      color: #333;
    }
    
    .sidebar-backdrop {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 1035;
    }
    
    @media (max-width: 991.98px) {
      .wrapper {
        padding-left: 0;
      }
      
      .main-sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s;
      }
      
      .main-sidebar.show {
        transform: translateX(0);
      }
      
      .main-footer {
        margin-left: 0;
      }
      
      .sidebar-toggle {
        display: block;
      }
      
      .sidebar-backdrop.show {
        display: block;
      }
    }
    
    @media (max-width: 575.98px) {
      .content-header { padding: 15px; }
      .content { padding: 0 15px 15px; }
      .main-header { padding: 0 15px; }
      .main-footer { padding: 10px 15px; }
      .card-body { padding: 15px; }
    }
  </style>
</head>

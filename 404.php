<?php
include "session.php";
include "header.php";
?>

<section class="content-header">
    <div class="container-fluid">
        <h1><i class="fas fa-exclamation-triangle me-2"></i>404 - ไม่พบหน้าที่คุณต้องการ</h1>
    </div>
</section>

<section class="content">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-search fa-4x text-muted"></i>
                    </div>
                    <h3 class="text-primary mb-3">หน้าที่คุณค้นหาไม่พบ</h3>
                    <p class="text-muted mb-4">
                        ขออภัย ไม่พบหน้าที่คุณต้องการค้นหา<br>
                        อาจจะถูกลบไป หรือ URL อาจจะไม่ถูกต้อง
                    </p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="calculate.php" class="btn btn-primary">
                            <i class="fas fa-home me-2"></i>หน้าหลัก
                        </a>
                        <a href="javascript:history.back()" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>ย้อนกลับ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>
</body>
</html>

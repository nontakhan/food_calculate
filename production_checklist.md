# Production Deployment Checklist - ระบบคำนวณวัตถุดิบอาหาร รพ.เทพา

## ✅ ความปลอดภัย (Security)

### 1. Authentication & Session
- [x] Secure session management (session.php)
- [x] CSRF protection implemented
- [x] Session timeout (30 minutes)
- [x] Session regeneration
- [x] Secure cookie settings

### 2. Password Security
- [x] Password hashing with bcrypt (cost 12)
- [x] Auto-migration from plain text
- [x] Password verification functions

### 3. Input Validation & XSS Protection
- [x] htmlspecialchars() for output escaping
- [x] CSRF tokens in forms
- [x] Input sanitization functions
- [ ] Additional input validation needed

### 4. Database Security
- [x] Prepared statements in check_login.php
- [x] PDO connection with error handling
- [x] Connection error logging
- [ ] SQL injection protection review needed

### 5. Security Headers (.htaccess)
- [x] X-Content-Type-Options: nosniff
- [x] X-Frame-Options: SAMEORIGIN
- [x] X-XSS-Protection: 1; mode=block
- [x] Content-Security-Policy
- [x] Strict-Transport-Security (HTTPS only)

### 6. File Security
- [x] Directory browsing disabled
- [x] Sensitive files protected
- [x] .htaccess for configuration files
- [x] File upload restrictions

## ⚠️ ต้องแก้ไขก่อนขึ้น Production

### 1. Database Credentials
```php
// _db/connect.php - เปลี่ยนเป็น production credentials
define('DB_HOST', 'production_db_host');
define('DB_USER', 'production_user');
define('DB_PASS', 'strong_production_password');
define('DB_NAME', 'production_db_name');
```

### 2. Error Reporting
```php
// Production: ปิด error display
ini_set('display_errors', 0);
ini_set('log_errors', 1);
```

### 3. Session Security
```php
// Production: ต้องใช้ HTTPS
ini_set('session.cookie_secure', 1);
```

### 4. Input Validation
- เพิ่ม validation สำหรับทุก input
- ใช้ filter_var() สำหรับ email, numbers
- ตรวจสอบ file uploads ถ้ามี

### 5. SQL Injection Review
- ตรวจสอบทุก query ที่ใช้ mysqli_query
- เปลี่ยนเป็น prepared statements ทั้งหมด
- ใช้ parameter binding

## 🔧 Server Configuration

### 1. Web Server
- [ ] Configure HTTPS/SSL certificate
- [ ] Set up virtual host
- [ ] Configure firewall
- [ ] Set up monitoring

### 2. PHP Configuration
```ini
; php.ini สำหรับ production
display_errors = Off
log_errors = On
error_log = /var/log/php_errors.log
max_execution_time = 30
memory_limit = 128M
upload_max_filesize = 2M
post_max_size = 8M
allow_url_fopen = Off
allow_url_include = Off
expose_php = Off
```

### 3. Database
- [ ] Create production database
- [ ] Import schema and data
- [ ] Set up database user permissions
- [ ] Configure backups

## 📋 Pre-Deployment Tasks

### 1. Testing
- [ ] Test all functionality
- [ ] Test login/logout
- [ ] Test print functions
- [ ] Test error handling
- [ ] Performance testing

### 2. Backup
- [ ] Backup current system
- [ ] Backup database
- [ ] Document deployment process

### 3. Monitoring
- [ ] Set up error logging
- [ ] Set up performance monitoring
- [ ] Set up security monitoring

## 🚀 Deployment Steps

1. **Prepare Server**
   - Install PHP 8.x, MySQL, Apache/Nginx
   - Configure SSL certificate
   - Set up firewall rules

2. **Upload Files**
   - Upload all files to production server
   - Set correct file permissions (755 for directories, 644 for files)
   - Protect sensitive files

3. **Configure Database**
   - Create production database
   - Import food_cal.sql
   - Update credentials in _db/connect.php

4. **Test System**
   - Test login functionality
   - Test all features
   - Check error logs

5. **Go Live**
   - Update DNS if needed
   - Monitor system performance
   - Check security logs

## 🔐 Security Recommendations

### 1. Regular Updates
- Update PHP, MySQL, Apache regularly
- Update dependencies (Bootstrap, jQuery)
- Monitor security advisories

### 2. Access Control
- Limit admin access
- Use strong passwords
- Enable 2FA if possible
- Regular security audits

### 3. Backup Strategy
- Daily database backups
- Weekly file backups
- Off-site backup storage
- Test restore procedures

### 4. Monitoring
- Monitor failed login attempts
- Monitor error logs
- Monitor system performance
- Set up alerts for suspicious activity

## 📞 Emergency Contacts

- System Administrator: [ชื่อผู้ดูแลระบบ]
- Database Administrator: [ชื่อผู้ดูแลฐานข้อมูล]
- Security Contact: [ชื่อผู้ดูแลความปลอดภัย]

---

**⚠️ คำเตือน:** อย่าลืมเปลี่ยนรหัสผ่านและข้อมูลสำคัญก่อนขึ้น Production!

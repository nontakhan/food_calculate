<!DOCTYPE html>
<html>
<head>
    <title>Debug Form Submit</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .debug-btn { padding: 10px 20px; margin: 10px; }
        .debug-info { background: #f0f0f0; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .debug-error { background: #ffebee; color: #c62828; padding: 15px; margin: 10px 0; border-radius: 5px; }
        .debug-success { background: #e8f5e8; color: #2e7d32; padding: 15px; margin: 10px 0; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Debug Form Submit</h1>
    
    <div class="debug-info">
        <h3>Test 1: Manual Form Submit</h3>
        <form id="testForm" method="post" action="debug_login_simple.php">
            <input type="hidden" name="csrf_token" value="test-token">
            Username: <input type="text" name="username1" value="admin"><br><br>
            Password: <input type="password" name="password1" value="123456"><br><br>
            <button type="submit" class="debug-btn">Submit to debug_login_simple.php</button>
        </form>
    </div>

    <div class="debug-info">
        <h3>Test 2: Simulate Real Login Form</h3>
        <form id="realForm" method="post" action="check_login.php">
            <input type="hidden" name="csrf_token" id="csrfToken">
            Username: <input type="text" name="username1" value="admin"><br><br>
            Password: <input type="password" name="password1" value="123456"><br><br>
            <button type="submit" id="realSubmit" class="debug-btn">Submit to check_login.php</button>
        </form>
    </div>

    <div class="debug-info">
        <h3>Test 3: JavaScript Submit</h3>
        <button onclick="jsSubmit()" class="debug-btn">JavaScript Submit to check_login.php</button>
    </div>

    <div id="results"></div>

    <script>
        // Generate CSRF token
        fetch('generate_csrf.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('csrfToken').value = data.token;
                document.getElementById('results').innerHTML = '<div class="debug-success">CSRF token generated: ' + data.token.substring(0, 20) + '...</div>';
            })
            .catch(error => {
                document.getElementById('results').innerHTML = '<div class="debug-error">Failed to get CSRF token: ' + error.message + '</div>';
            });

        function jsSubmit() {
            const form = document.getElementById('realForm');
            const btn = document.getElementById('realSubmit');
            
            // Simulate the login form JavaScript
            const u = document.querySelector('#realForm input[name="username1"]').value.trim();
            const p = document.querySelector('#realForm input[name="password1"]').value.trim();
            
            if (!u || !p) {
                Swal.fire({ icon: 'warning', title: 'กรุณากรอกข้อมูล', text: 'กรุณากรอกชื่อผู้ใช้และรหัสผ่าน' });
                return;
            }
            
            btn.classList.add('loading');
            btn.disabled = true;
            
            document.getElementById('results').innerHTML = '<div class="debug-info">Form submitted via JavaScript...</div>';
            
            // Submit form
            form.submit();
        }

        // Monitor form submission
        document.getElementById('realForm').addEventListener('submit', function(e) {
            document.getElementById('results').innerHTML = '<div class="debug-info">Form is submitting...</div>';
            
            const btn = document.getElementById('realSubmit');
            console.log('Button disabled:', btn.disabled);
            console.log('Button classes:', btn.className);
        });
    </script>
</body>
</html>

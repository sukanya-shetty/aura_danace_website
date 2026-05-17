# InfinityFree Deployment Guide - Aura Dance Academy

**Last Updated:** May 17, 2026  
**Status:** All security fixes completed ✅

---

## Pre-Deployment Checklist

- [x] All SQL queries use prepared statements
- [x] Hardcoded credentials removed
- [x] Password security verified (BCRYPT)
- [x] Error handling implemented
- [x] Input validation added
- [x] .gitignore created to protect sensitive files
- [x] SECURITY_AUDIT.md documentation created
- [x] Code pushed to GitHub

---

## Step-by-Step Deployment to InfinityFree

### Phase 1: Export & Setup (10 minutes)

#### Step 1A: Export Local Database
```bash
1. Open WAMP Control Panel
2. Click "Tools" → "phpMyAdmin"
3. Select "aura_dance" database
4. Click "Export" tab
5. Choose "SQL" format
6. Click "Go"
7. Save file as "aura_dance.sql" to Desktop
```

#### Step 1B: Create InfinityFree Account
```bash
1. Go to https://www.infinityfree.net
2. Click "Sign Up"
3. Enter email, username, password
4. Verify email
5. Login to dashboard
```

#### Step 1C: Create Hosting Account
```bash
1. In InfinityFree dashboard, click "Create New Account"
2. Choose free domain (.tk, .ml, .ga, or .42web.io)
3. Create account
4. Wait 2 minutes for activation
```

---

### Phase 2: Get Server Credentials (5 minutes)

#### Step 2A: Retrieve FTP Details
```bash
1. In InfinityFree dashboard, left sidebar click "FTP Details"
2. Note down:
   - FTP Host: ftpupload.net
   - FTP Username: if0_XXXXXX
   - FTP Password: YOUR_PASSWORD
3. Also get cPanel URL
```

#### Step 2B: Get Database Credentials
```bash
1. Still in dashboard, click "Control Panel" or open cPanel
2. Go to "MySQL Databases"
3. Note your hosting provider username/database prefix
```

---

### Phase 3: Upload Website Files (20 minutes)

#### Step 3A: Upload via File Manager (Easiest)
```bash
1. In cPanel, click "File Manager"
2. Navigate to "public_html" folder
3. Click "Upload"
4. Select all files from C:\wamp64\www\p\
5. Upload everything EXCEPT:
   - vendor/ folder (too large, will install later)
   - .git/ folder (development only)
   - config.php (will create on server)
   - mailer-config.php (will create on server)
```

#### Step 3B: Upload via FileZilla (Faster for large projects)
```bash
1. Download FileZilla from https://filezilla-project.org/
2. Open FileZilla
3. File → Site Manager → New Site
4. Fill in:
   Host: ftpupload.net
   Username: if0_XXXXXX
   Password: YOUR_PASSWORD
   Port: 21
5. Click Connect
6. Left side = your computer (C:\wamp64\www\p\)
7. Right side = server (public_html)
8. Drag files to right side (skip vendor, .git, config, mailer-config)
```

---

### Phase 4: Create Database on Server (10 minutes)

#### Step 4A: Create MySQL Database
```bash
1. In cPanel, click "MySQL Databases"
2. Create new database:
   - Name: aura_dance (or prefix_aura_dance)
   - Click "Create Database"
3. Create new user:
   - Username: aura_admin
   - Password: strong_password_here
   - Click "Create User"
4. Add user to database:
   - Select aura_admin
   - Select aura_dance
   - Click "Add"
   - Select ALL privileges
   - Click "Make Changes"
```

#### Step 4B: Import Database Backup
```bash
1. In cPanel, click "phpMyAdmin"
2. Select your database (aura_dance)
3. Click "Import" tab
4. Choose File: browse and select aura_dance.sql
5. Click "Go"
6. Database will be imported with all tables and test data
```

---

### Phase 5: Update Configuration Files (10 minutes)

#### Step 5A: Create config.php on Server
```bash
1. In cPanel File Manager, navigate to public_html
2. Right-click → Create New File
3. Name it: config.php
4. Edit and paste this content:

<?php
$server = 'localhost';
$uname = 'aura_admin';  // User you created
$password = 'YOUR_STRONG_PASSWORD';  // Password you created
$database = 'aura_dance';  // Database name

$conn = new mysqli($server, $uname, $password, $database);

if($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
?>

5. Save file
```

#### Step 5B: Create mailer-config.php on Server
```bash
1. Create new file: mailer-config.php
2. Edit and paste this content:

<?php
define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_PORT', 465);
define('MAIL_USERNAME', 'your-email@gmail.com');  // Gmail address
define('MAIL_PASSWORD', 'app-password-here');      // Gmail App Password
define('MAIL_FROM_EMAIL', 'your-email@gmail.com');
define('MAIL_FROM_NAME', 'Aura Dance Academy');
?>

3. Save file
4. NOTE: Replace with actual Gmail credentials
```

#### Step 5C: Install Composer Dependencies
```bash
OPTION 1: Auto-install via cPanel
1. In cPanel, click "Composer"
2. Install dependencies automatically

OPTION 2: Manual installation
1. SSH into server (if available)
2. cd public_html
3. composer install
4. This installs PHPMailer and other dependencies
```

---

### Phase 6: Final Configuration (5 minutes)

#### Step 6A: Update URLs in Code
```bash
Files to update (if using your custom domain):
- sendPassword.php: Change reset link URL
  OLD: http://localhost/p/updatepassword.php
  NEW: https://yourdomain.com/updatepassword.php

- Any hardcoded URLs in JavaScript files
```

#### Step 6B: Set Proper Permissions
```bash
In cPanel File Manager:
1. Right-click on directories
2. Change permissions to 755 (directories)
3. Change permissions to 644 (files)
```

---

### Phase 7: Test Live Website (10 minutes)

#### Step 7A: Test Basic Functions
```bash
1. Go to: https://yourdomain.com (or your domain)
2. Test Student Login:
   - Email: test@example.com
   - Password: test123
3. Test Admin Login:
   - Username: admin
   - Password: admin123
4. Test Course Enrollment:
   - Browse courses
   - Complete enrollment flow
   - Verify database was updated
```

#### Step 7B: Test Advanced Functions
```bash
1. Test Payment Page:
   - Use test credit card numbers
   - Verify payment is processed
   - Check database for enrollment record

2. Test Password Reset:
   - Go to login page
   - Click "Forgot Password"
   - Enter email
   - Check email for reset link
   - Verify you can reset password

3. Test Admin Panel:
   - Login as admin
   - Verify statistics display correctly
   - Test Edit/Delete functionality
```

#### Step 7C: Verify Database Connectivity
```bash
1. In phpMyAdmin, run test query:
   SELECT * FROM users LIMIT 1;
2. Should return test data
3. If error: Check config.php database credentials
```

---

## Common Issues & Solutions

### Issue 1: "Can't connect to database"
```bash
Solution:
1. Check config.php has correct credentials
2. Verify database name matches exactly
3. Check username/password in cPanel MySQL section
4. Ensure user has privileges on database
5. Try connecting via phpMyAdmin to verify
```

### Issue 2: "PHPMailer not found"
```bash
Solution:
1. Run: composer install
2. Verify vendor/autoload.php exists
3. Check require 'vendor/autoload.php' in sendPassword.php
4. If still failing, install manually via cPanel
```

### Issue 3: "Headers already sent"
```bash
Solution:
1. Remove whitespace before <?php in files
2. Use: ob_start() at beginning of file if needed
3. Check for BOM in file encoding
```

### Issue 4: "File upload limits"
```bash
Solution:
1. Check php.ini max upload size
2. Contact InfinityFree support for limits
3. Usually 50MB upload limit is sufficient
```

### Issue 5: "Permission denied" errors
```bash
Solution:
1. Set file permissions to 644
2. Set directory permissions to 755
3. In cPanel File Manager right-click → Change Permissions
```

---

## Post-Deployment

### 1. Security Hardening
```bash
1. Update admin password to strong value
2. Change test user passwords
3. Remove test accounts if desired
4. Enable HTTPS (free with Let's Encrypt on most hosts)
5. Add security headers via .htaccess
```

### 2. Performance Optimization
```bash
1. Enable caching
2. Minimize CSS/JavaScript files
3. Compress images
4. Enable GZIP compression
```

### 3. Backup Strategy
```bash
1. Export database weekly: phpMyAdmin → Export
2. Download files periodically
3. Store backups offline
4. Document backup procedure
```

### 4. Monitoring
```bash
1. Check error logs weekly: cPanel → Error Log
2. Monitor database usage
3. Monitor disk space usage
4. Monitor bandwidth usage
```

---

## GitHub Links for Reference

- **Repository:** https://github.com/sukanya-shetty/p
- **Live Website:** https://yourdomain.com (after deployment)
- **Documentation:** See README.md and SECURITY_AUDIT.md in repository

---

## Support & Troubleshooting

### If you encounter issues:
1. Check error logs in cPanel
2. Review SECURITY_AUDIT.md for code details
3. Verify config.php is correct
4. Test database connection via phpMyAdmin
5. Check file permissions
6. Contact InfinityFree support if needed

### Key Contact Info:
- InfinityFree Support: support@infinityfree.net
- Gmail SMTP Help: https://support.google.com/accounts/answer/185833
- PHP Error Logs: cPanel → Error Log

---

## Success Indicators

✅ Website loads without errors  
✅ Student can register and login  
✅ Courses can be enrolled  
✅ Admin panel shows correct data  
✅ Password reset emails are sent  
✅ Database updates correctly  
✅ No SQL errors in logs  
✅ HTTPS is enabled  

**When all above are complete, deployment is successful!**

---

*For detailed code implementation, refer to SECURITY_AUDIT.md in the repository.*

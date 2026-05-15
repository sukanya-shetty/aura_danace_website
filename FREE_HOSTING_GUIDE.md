# 100% FREE Hosting for Your Aura Dance Website

## Top Free Hosting Options

### Option 1: **Heroku** (BEST for beginners) ⭐⭐⭐⭐⭐
**Status**: Heroku stopped free tier in November 2022, but you can use alternatives

### Option 2: **InfinityFree** (RECOMMENDED) ⭐⭐⭐⭐⭐
**What**: Completely FREE forever hosting with cPanel
- **PHP**: ✅ Yes (PHP 7.4, 8.0, 8.1)
- **MySQL**: ✅ Yes (unlimited databases)
- **Disk Space**: 5 GB free
- **Bandwidth**: Unlimited
- **Domains**: 3 free .tk or .ml domains
- **Cost**: ₹0 (100% FREE forever)
- **Website**: infinityfree.net

**Advantages:**
- No credit card required
- No time limit
- Easy cPanel interface
- Works perfectly for PHP + MySQL

**Disadvantages:**
- Ads on free tier
- Slower than paid hosting
- Need to keep accessing site (inactive account deleted after 4 months)

**Perfect For**: Your student project!

---

### Option 3: **000webhost** (Also Good)
**What**: FREE hosting with generous limits
- **PHP**: ✅ Yes
- **MySQL**: ✅ Yes
- **Disk Space**: 25 GB free
- **Cost**: ₹0
- **Website**: 000webhost.com

---

### Option 4: **GitHub Pages + Vercel** (For static sites)
**What**: Free but limited (only HTML/CSS/JS, no PHP/MySQL)
- **Not suitable for your project** (you need PHP backend)

---

### Option 5: **Render** (Python/Node.js focused)
**What**: Free tier available
- **Suitable**: If you rewrite in Node.js
- **Not suitable**: For PHP projects

---

## BEST RECOMMENDATION: InfinityFree

I recommend **InfinityFree** because:
1. ✅ PHP + MySQL support (exactly what you need)
2. ✅ 100% FREE forever
3. ✅ No credit card required
4. ✅ cPanel interface (easy to use)
5. ✅ Works immediately

---

## Step-by-Step: Host on InfinityFree

### Step 1: Create Account (5 minutes)

1. Go to https://infinityfree.net
2. Click "Sign Up" button
3. Enter:
   - Email address
   - Password (strong password!)
   - Confirm password
4. Click "Create My Account"
5. Verify email (check spam folder)

### Step 2: Create Hosting Account (5 minutes)

1. Log in to InfinityFree
2. Click "Create New Account"
3. Choose free domain or use your own:
   - Option A: Free domain (aura.tk or aura.ml or aura.ga)
   - Option B: Use existing domain (if you have one)
4. Select your domain
5. Click "Create"
6. Wait 5 minutes for setup

### Step 3: Get Access Details (2 minutes)

After account created, you'll see:
- **cPanel URL**: https://panel.infinityfree.net
- **Username**: Your assigned username
- **Password**: Your account password
- **FTP Host**: Usually ftpupload.net
- **FTP Username**: Your username
- **FTP Password**: Same as cPanel password

**Save these somewhere safe!**

### Step 4: Access cPanel (5 minutes)

1. Log in to https://panel.infinityfree.net
2. See your control panel
3. Find "File Manager" - click it
4. Navigate to public_html folder

### Step 5: Upload Website Files (20 minutes)

#### Method A: Using cPanel File Manager (Easiest)

1. In cPanel, click "File Manager"
2. Open "public_html" folder
3. Click "Upload" button
4. Select all files from `c:\wamp64\www\p\`
5. Upload them
6. Done!

#### Method B: Using FTP (Faster for many files)

1. Download FileZilla (free): https://filezilla-project.org
2. File → Site Manager → New Site
3. Enter:
   - Host: ftpupload.net
   - Username: (from InfinityFree)
   - Password: (from InfinityFree)
   - Port: 21
4. Connect
5. Upload all files from left (local) to right (server) public_html

**Files to upload:**
```
All .php files (log.php, adminpanel.php, course.php, etc.)
All .css files (adminstyle.css, style.css, etc.)
All .js files (payscript.js, script.js, etc.)
All images (logo, backgrounds, etc.)
All .html files (bootstrap.html, Login.html, etc.)
```

### Step 6: Create MySQL Database (5 minutes)

1. In cPanel, find "MySQL Databases"
2. Click it
3. Create new database:
   - **Database Name**: aura_dance
   - Click "Create Database"
4. Create new MySQL user:
   - **Username**: aura_admin
   - **Password**: (create strong password)
   - Click "Create User"
5. Add user to database (select both, click "Add")

**Save these credentials:**
```
Database Name: aura_dance
Username: aura_admin
Password: (your password)
```

### Step 7: Import Database (10 minutes)

1. In cPanel, find "phpMyAdmin"
2. Click it
3. Left side: Select "aura_dance" database
4. Click "Import" tab
5. Choose file: (your aura_dance.sql file)
6. Click "Go"
7. Wait for import to complete

**To export database from your local computer:**

On Windows:
1. Open WAMP Menu → MySQL → phpMyAdmin
2. Left side: Select "aura_dance"
3. Click "Export"
4. Select "Quick" export
5. Click "Go"
6. File downloads as "aura_dance.sql"
7. Keep this file for uploading

### Step 8: Update Database Connection (10 minutes)

Your local connection won't work on server!

**Find and update in ALL .php files:**

Change from:
```php
$server="localhost";
$uname="root";
$password="";
$db="aura_dance";
```

Change to:
```php
$server="localhost";
$uname="aura_admin";
$password="(password from step 6)";
$db="aura_dance";
```

**Files to update:**
```
log.php
log1log.php
adminlog.php
course.php
danceform.php
dancecat.php
student.php
num.php
adminpanel.php
studentform.php
pay.php
agecheck.php
cagecheck.php
... (all files with database connection)
```

**Quick way to update all files:**
1. Open each .php file in VS Code
2. Use Find & Replace (Ctrl+H)
3. Find: `$uname="root"`
4. Replace: `$uname="aura_admin"`
5. Replace all occurrences

### Step 9: Re-upload Updated Files (10 minutes)

After updating database credentials:
1. Upload all .php files again to server
2. This overwrites old versions
3. Use cPanel File Manager or FileZilla

### Step 10: Test Your Website (5 minutes)

1. Go to your domain: https://aura.infinityfree.com (or your domain name)
2. Website should load!
3. Test login page
4. Try student registration
5. Try course enrollment
6. Check admin panel

---

## IMPORTANT: Before Going Live on Free Hosting

### Security Issues to Fix:

**Issue 1: Plain Text Passwords** ❌
Your current code stores passwords as plain text (VERY UNSAFE!)

**Current (UNSAFE):**
```php
// log.php - storing password
$password = $_POST['password'];
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

// log1log.php - checking password
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
```

**Should be (SAFE):**
```php
// When registering:
$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

// When logging in:
$password = $_POST['password'];
$sql = "SELECT * FROM users WHERE email='$email'";
$user = fetch data...
if (password_verify($password, $user['password'])) {
    // Login successful
} else {
    // Wrong password
}
```

**Issue 2: SQL Injection** ❌
Your code uses direct $GET/$POST in SQL (VERY VULNERABLE!)

**Current (VULNERABLE):**
```php
$form = $_GET['form'];
$sql = "SELECT * FROM courses WHERE course_name='$form'";  // Hacker can inject SQL!
```

**Should be (SAFE):**
```php
$form = $_GET['form'];
$sql = "SELECT * FROM courses WHERE course_name=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $form);
$stmt->execute();
$result = $stmt->get_result();
```

---

## Complete InfinityFree Setup Checklist

### Before Uploading:
- [ ] Exported database as .sql file
- [ ] All .php files have correct database credentials
- [ ] Tested locally that everything works

### During Setup:
- [ ] Created InfinityFree account
- [ ] Created hosting account
- [ ] Uploaded all website files
- [ ] Created MySQL database
- [ ] Imported database backup
- [ ] Updated database connection in all .php files
- [ ] Re-uploaded updated .php files

### After Going Live:
- [ ] Website loads at domain
- [ ] Login page works
- [ ] Student registration works
- [ ] Course enrollment works
- [ ] Admin panel works
- [ ] Payment processing works

---

## Troubleshooting Free Hosting Issues

### Issue: "Error connecting to database"
**Solution:**
- Check credentials match exactly
- Make sure user is added to database (not just created)
- Database name, username, password must match

### Issue: "White blank page"
**Solution:**
- Check error logs in cPanel
- Enable PHP error display:
  Add to top of .php file:
  ```php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  ```

### Issue: "404 - File not found"
**Solution:**
- Ensure all files uploaded to public_html
- Check file names match (case sensitive on server!)
- Verify no files missing

### Issue: "Images not showing"
**Solution:**
- Ensure image files uploaded too
- Check image paths in code
- Verify folder structure matches local

### Issue: "Account inactive - deleted"
**Solution:**
- InfinityFree deletes accounts inactive 4+ months
- Log in at least once per month to keep active
- Or use paid hosting if long-term needed

---

## Comparison: InfinityFree vs Paid Hosting

| Feature | InfinityFree | Paid Hosting |
|---------|-------------|------------|
| Cost | ₹0 | ₹300-500/month |
| PHP + MySQL | ✅ | ✅ |
| Storage | 5GB | 50GB+ |
| Speed | Slower | Faster |
| Uptime | 99% | 99.9% |
| Support | Limited | 24/7 |
| Best For | Students/Testing | Production |

---

## Next Steps for You

1. **TODAY**: Create InfinityFree account
2. **TODAY**: Export your local database
3. **TOMORROW**: Upload all files
4. **TOMORROW**: Import database
5. **TOMORROW**: Update database credentials
6. **TOMORROW**: Test website

**Then you're LIVE!** 🚀

---

## Quick Links

- **InfinityFree**: https://infinityfree.net
- **FileZilla**: https://filezilla-project.org
- **phpMyAdmin**: https://www.phpmyadmin.net

---

## Questions? 

If something doesn't work:
1. Check InfinityFree knowledge base: https://www.infinityfree.net/kb
2. Try InfinityFree forums: https://infinityfree.net/forums
3. Contact me with error message

Good luck! Your website will be live soon! 🎉

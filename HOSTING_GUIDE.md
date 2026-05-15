# Complete Website Hosting Guide for Beginners

## Part 1: Understanding the Basics

### What is Hosting?
- **Currently**: Your website runs on your local computer (WAMP = Windows, Apache, MySQL, PHP)
- **Hosting**: Renting a server (computer) that runs 24/7 online so people worldwide can access your website
- **Domain**: The web address people type (example: www.auradance.com)

### What You Currently Have:
```
Your Computer (localhost)
  ├── Apache (Web Server) - serves HTML/PHP files
  ├── MySQL (Database) - stores student, course, enrollment data
  ├── PHP (Backend) - processes forms, queries database
  └── Website Files - all your .php, .html, .css, .js files
```

### What You'll Need for Hosting:
```
Hosting Server (Someone else's computer, 24/7 online)
  ├── Apache/Nginx (Web Server)
  ├── MySQL/MariaDB (Database)
  ├── PHP (Backend Language)
  ├── Website Files (uploaded from your computer)
  └── Domain Name (www.yourdomain.com)
```

---

## Part 2: Types of Web Hosting

### 1. **Shared Hosting** (Recommended for beginners) ⭐
- **What**: Your website shares server space with 100s of other websites
- **Cost**: ₹200-500/month ($2-6 USD)
- **Pros**: Cheap, easy to set up, good for small projects
- **Cons**: Slower if other sites get high traffic
- **Best For**: Your Aura Dance website
- **Popular Providers**: 
  - Hostinger
  - Bluehost
  - GoDaddy
  - Namecheap
  - AWS Lightsail (slightly more advanced)

### 2. **VPS Hosting** (More advanced)
- **What**: Your own virtual server (more control)
- **Cost**: ₹500-2000/month
- **Pros**: Better performance, full control
- **Cons**: Needs technical knowledge
- **Best For**: Growing websites

### 3. **Cloud Hosting** (Enterprise)
- **What**: Uses multiple servers automatically
- **Cost**: ₹1000+/month
- **Pros**: Maximum uptime, scalable
- **Cons**: Complex, expensive

---

## Part 3: Step-by-Step Hosting Process

### Step 1: Choose a Hosting Provider
For your first website, I recommend **Hostinger** or **Namecheap**:

**Why Hostinger?**
- Easy WordPress/PHP setup
- One-click installers
- Good customer support
- ₹300-500/month

**Why Namecheap?**
- Cheap domain + hosting bundles
- Good for Indian users
- Easy to manage

### Step 2: Buy a Domain Name
A domain is your website address (e.g., www.auradance.com)

**Domain Registration Process:**
1. Go to Hostinger.com or Namecheap.com
2. Search for your desired domain (example: auradance.com)
3. Check if available (green = available, red = taken)
4. Add to cart
5. Complete payment
6. Domain is registered (usually instant)

**Cost:** ₹500-1500/year for .com domain

**Popular Domain Extensions:**
- .com (most popular)
- .co.in (India specific)
- .in (India generic)
- .academy, .dance (specialty)

### Step 3: Choose Hosting Plan
When buying hosting, select:
- **Disk Space**: 50GB is enough for your website
- **Bandwidth**: 100GB/month is good
- **Database**: At least MySQL support
- **Email Accounts**: Usually included
- **Free SSL Certificate**: Must have (for https://)

### Step 4: Upload Your Website Files

#### Using FTP (File Transfer Protocol):
```
FTP = Method to upload files from your computer to server

Steps:
1. Download FileZilla (Free FTP Client) - filezilla-project.org
2. Get FTP credentials from your hosting provider:
   - FTP Host/Server: ftp.yoursite.com
   - Username: your_username
   - Password: your_password
3. Connect using FileZilla
4. Upload all files from c:\wamp64\www\p\ to public_html folder
```

#### Using cPanel (Easier):
Most hosting providers give you **cPanel** (control panel):
1. Log in to cPanel
2. Go to File Manager
3. Navigate to public_html folder
4. Upload files directly (drag and drop)

### Step 5: Upload Your Database

#### Exporting Database from Local:
```
Your Local Database (aura_dance) needs to move to server

Steps:
1. Open your WAMP MySQL admin
2. Select database "aura_dance"
3. Click "Export" (phpMyAdmin)
4. Download as .sql file
5. Keep this file safe
```

#### Importing Database to Hosting Server:
```
Steps:
1. Log in to cPanel
2. Find "phpMyAdmin" 
3. Create new database with same name (aura_dance)
4. Select the database
5. Click "Import"
6. Upload your .sql file
7. Click "Go" - Database is imported!
```

### Step 6: Update Database Connection

**Important:** Your local connection won't work on server!

**In all your .php files, update:**

```php
// OLD (Local - won't work on server):
$server="localhost";
$uname="root";
$password="";
$db="aura_dance";

// NEW (On hosting server - ask your host):
$server="localhost";  // Usually stays localhost
$uname="your_cpanel_username";  // Get from hosting provider
$password="your_db_password";   // Set during database import
$db="yourusername_aura_dance";  // Often prefixed with username
```

**How to find your credentials:**
1. Log in to cPanel
2. Go to "MySQL Databases"
3. Your database name and username are listed there
4. Password is what you set during import

### Step 7: Configure Email (Optional)
```
For password reset emails to work on server:

1. Go to cPanel → Email Accounts
2. Create email account (e.g., noreply@yourdomain.com)
3. Update SMTP settings in sendPassword.php:
   - SMTP Host: mail.yourdomain.com
   - Username: noreply@yourdomain.com
   - Password: email password you created
```

### Step 8: Test Your Website

```
After uploading everything:

1. Go to your domain: www.yourdomain.com
2. Test login page
3. Try student registration
4. Try course enrollment
5. Check admin panel
6. Test payment flow

If anything breaks, check:
- Database connection errors
- File path issues
- Permission problems
```

---

## Part 4: Common Issues & Solutions

### Issue 1: "Connection refused" Error
**Problem:** Can't connect to database on server
**Solution:** 
- Check database credentials in php files
- Verify database was imported successfully
- Contact hosting support for credentials

### Issue 2: "File not found" Error
**Problem:** Some files aren't loading
**Solution:**
- Ensure all .php, .css, .js files were uploaded
- Check folder structure matches local
- Verify file permissions (usually need to be 644)

### Issue 3: "Permission denied" Error
**Problem:** Can't write files to server
**Solution:**
- Right-click file → Properties → Permissions
- Set to 644 for files, 755 for folders
- Can do this in cPanel File Manager

### Issue 4: Images not showing
**Problem:** .jpg, .png files not displaying
**Solution:**
- Ensure image files are uploaded to same folder
- Check image paths in HTML/PHP are correct
- Upload logo, backgrounds, etc.

---

## Part 5: Security Checklist

### Before Going Live:

- [ ] Change all database passwords
- [ ] Remove any test/debug code
- [ ] Set file permissions correctly (644 files, 755 folders)
- [ ] Enable HTTPS/SSL certificate (usually free with hosting)
- [ ] Add password hashing to login (currently plain text - fix!)
- [ ] Validate all user inputs (prevent SQL injection)
- [ ] Regular database backups
- [ ] Monitor website performance

### Security Issue in Current Code:
```php
// VULNERABLE - Do NOT use on live server:
$sql="SELECT * FROM users WHERE email='$email' AND password='$password'";

// SAFE - Use this instead:
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
// Store hashed password in database
// Verify with: password_verify($password, $hashed_password)
```

---

## Part 6: Post-Launch Maintenance

### Daily:
- Monitor website uptime (use UptimeRobot - free)
- Check for errors in logs

### Weekly:
- Backup database
- Review user registrations
- Check payment records

### Monthly:
- Review analytics
- Update security patches
- Performance optimization

### Annually:
- Renew domain
- Renew SSL certificate
- Plan upgrades

---

## Part 7: Quick Reference Checklist

### Before Hosting:
- [ ] Code tested and working locally
- [ ] All database tables created
- [ ] Sample data inserted
- [ ] All .php files have correct database connection
- [ ] All images/assets in correct folders

### During Hosting Setup:
- [ ] Domain registered
- [ ] Hosting plan purchased
- [ ] All files uploaded via FTP
- [ ] Database exported and imported
- [ ] Database credentials updated in .php files
- [ ] Website tested on live domain

### After Going Live:
- [ ] Email testing
- [ ] Admin features verified
- [ ] Student enrollment tested end-to-end
- [ ] Payment processing verified
- [ ] Analytics/monitoring setup
- [ ] Backup system configured

---

## Part 8: Recommended Hosting Providers for India

### Option 1: Hostinger
- **Pros**: Cheapest, easy setup, good support
- **Cost**: ₹299/month (promotional)
- **Website**: hostinger.in
- **Rating**: ⭐⭐⭐⭐

### Option 2: Namecheap
- **Pros**: Domain + hosting bundles, cheap
- **Cost**: ₹2000-3000/year (with domain)
- **Website**: namecheap.com
- **Rating**: ⭐⭐⭐⭐

### Option 3: Bluehost
- **Pros**: Easy, WordPress optimized
- **Cost**: $2.95-6/month
- **Website**: bluehost.com
- **Rating**: ⭐⭐⭐⭐

### Option 4: AWS Lightsail (Most scalable)
- **Pros**: Powerful, 1 year free, enterprise-grade
- **Cost**: ₹500+/month after free trial
- **Website**: aws.amazon.com
- **Rating**: ⭐⭐⭐⭐⭐

---

## Summary

```
Hosting Workflow:
1. Choose hosting provider (Hostinger, Namecheap)
2. Buy domain (auradance.com)
3. Buy hosting plan
4. Export local database (aura_dance)
5. Upload website files via FTP/cPanel
6. Import database to server
7. Update database connection credentials
8. Test everything on live domain
9. Monitor and maintain
```

Your Aura Dance website is ready to go live! 🚀

**Next Steps:**
1. Choose hosting provider
2. Buy domain + hosting
3. Contact me for FTP upload guide
4. Share your domain and I'll verify everything works!

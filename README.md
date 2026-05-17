# Aura Dance Website

A comprehensive dance course booking and event management platform for online enrollment.

## 📋 Project Overview

Aura is a full-stack web application designed to streamline dance course enrollment, student management, and event booking. It features a professional admin dashboard for managing categories, courses, students, and tracking revenue.

## ✨ Features

### For Students
- **User Registration & Login**: Secure authentication with password hashing
- **Browse Dance Categories**: View available dance forms (Bharatanatyam, Kathak, Hip-Hop, Ballet, Salsa, Fusion, Break Dance)
- **Course Enrollment**: Select courses, fill details, and proceed to payment
- **Online Payment**: Secure payment processing integration
- **Event Booking**: Book dance events (Sangeet, Bollywood, Fusion)

### For Admins
- **Admin Dashboard**: Key metrics and statistics
  - Total Students
  - Total Courses
  - Total Enrollments
  - Total Revenue
- **Category Management**: Add, edit, delete dance categories
- **Course Management**: Manage courses with instructor details, duration, and fees
- **Student Management**: View all registered students and their enrollments
- **Enrollment Tracking**: Track student enrollments by course and category
- **Revenue Dashboard**: Monitor earnings from courses and events
- **Event Management**: Manage events and bookings

## 🛠️ Technologies Used

### Backend
- **PHP 7+**: Server-side scripting
- **MySQL**: Relational database
- **MySQLi**: Database connection with prepared statements

### Frontend
- **HTML5**: Markup structure
- **CSS3**: Custom styling
- **Bootstrap 5.0.2**: Responsive UI framework
- **JavaScript**: Client-side interactivity
- **jQuery 3.7.1**: DOM manipulation

### Libraries & Tools
- **PHPMailer v6.9**: SMTP-based email for password reset
- **Composer**: PHP dependency management
- **Font Awesome 5.15.4**: Icon library

### Security
- **Password Hashing**: BCRYPT algorithm for secure password storage
- **Prepared Statements**: Prevention of SQL injection
- **Session Management**: Secure session-based authentication

## 📁 Project Structure

```
aura-dance-website/
├── admin/
│   └── adminpanel.html
├── vendor/
│   ├── autoload.php
│   └── phpmailer/
├── *.php                 (Backend files)
│   ├── log.php           (Student registration)
│   ├── log1log.php       (Student login)
│   ├── adminlog.php      (Admin login)
│   ├── adminpanel.php    (Admin dashboard)
│   ├── course.php        (Course details)
│   ├── student.php       (Student list)
│   ├── pay.php           (Payment processing)
│   └── ... (40+ more PHP files)
├── *.html                (Frontend pages)
│   ├── Login.html
│   ├── bootstrap.html
│   └── ... (more HTML files)
├── *.css                 (Styling)
│   ├── adminstyle.css
│   ├── style.css
│   └── ... (more CSS files)
├── *.js                  (JavaScript)
│   ├── payscript.js
│   ├── script.js
│   └── ... (more JS files)
├── README.md             (This file)
└── HOSTING_GUIDE.md      (Deployment instructions)
```

## 🗄️ Database Schema

### Tables
- **users**: User accounts (registration, login)
- **students**: Student information (name, email, phone, age, address)
- **courses**: Dance courses (course_name, category, instructor, duration, fee)
- **enrollments**: Course enrollments (student_id, course_id, enrollment_date)
- **payments**: Payment records (student_id, course_id, amount, payment_date)
- **category**: Dance categories (Bharatanatyam, Kathak, Hip-Hop, etc.)
- **events**: Dance events (event_name, event_date, location, capacity, price)
- **bookings**: Event bookings (student_id, event_id, booking_date, amount)

## 🚀 Installation

### Local Setup (WAMP)

1. **Install WAMP**
   - Download from wampserver.com
   - Install with MySQL and PHP 7+

2. **Clone Project**
   ```bash
   git clone https://github.com/sukanya-shetty/p.git
   cd p
   ```

3. **Create Database**
   ```sql
   CREATE DATABASE aura_dance;
   ```

4. **Import Database Schema**
   - Open phpMyAdmin
   - Select `aura_dance` database
   - Import `aura_dance.sql` file

5. **Update Database Credentials**
   - Open all `.php` files
   - Update connection details:
   ```php
   $server='localhost';
   $uname='root';
   $password='';
   $db='aura_dance';
   ```

6. **Start WAMP Server**
   - Start Apache and MySQL services

7. **Access Application**
   ```
   http://localhost/p
   ```

### Online Hosting (InfinityFree)

See [HOSTING_GUIDE.md](HOSTING_GUIDE.md) for complete deployment instructions.

## 📝 Usage

### Student Workflow

1. **Sign Up**
   - Click Login → Sign up tab
   - Enter email, password, confirm password
   - Create account

2. **Browse Courses**
   - Home → Available Dance Courses
   - Select category
   - Choose course and click "Enroll Now"

3. **Fill Details**
   - Enter name, email, phone, address, district, age
   - Select level (Beginner, Intermediate, Advanced)
   - Select gender

4. **Payment**
   - Enter card details (for testing, use dummy card)
   - Click "Register" to complete payment

5. **Enrollment Complete**
   - Receive confirmation
   - View in student dashboard

### Admin Workflow

1. **Admin Login**
   - Go to admin login page
   - Username: `admin` (or your admin username)
   - Password: (your admin password)

2. **Dashboard**
   - View key metrics (students, courses, enrollments, revenue)
   - See course distribution by category

3. **Manage Categories**
   - Dance Forms → View Categories
   - Edit or delete categories
   - Add new categories

4. **Manage Courses**
   - Add new courses to categories
   - Edit course details (name, instructor, duration, fee)
   - Delete courses

5. **View Students**
   - Students → Select category → Select course
   - View all enrolled students
   - See student details (name, email, phone, age, address)

6. **Track Earnings**
   - Earnings → View revenue
   - See course-wise and event-wise earnings
   - Track payment status

## 🔐 Security Features

- ✅ Password hashing using BCRYPT
- ✅ Prepared statements to prevent SQL injection
- ✅ Session-based authentication
- ✅ HTTPS-ready with SSL support
- ✅ Email verification for password reset
- ✅ Input validation on forms

## 🧪 Test Credentials

### Student Account
- Email: `sukanya@gmail.com`
- Password: `password123`

### Admin Account
- Username: `admin`
- Password: `admin123`

## 📊 Key Metrics

- **Users**: 3 students registered
- **Courses**: 3 available courses
- **Enrollments**: 4 active enrollments
- **Revenue**: ₹44,000 total

## 🤝 Contributing

This is a student project. Contributions and suggestions are welcome!

## 📝 License

MIT License - Free to use and modify

## 👤 Author

**Sukanya Shetty**
- GitHub: [@sukanya-shetty](https://github.com/sukanya-shetty)
- Email: sukanyashetty1019@gmail.com

## 📚 Learning Outcomes

This project demonstrates:
- Full-stack web development (PHP, MySQL, HTML, CSS, JavaScript)
- Database design and normalization
- Authentication and security
- CRUD operations
- Payment integration
- Admin dashboard development
- Responsive UI design with Bootstrap
- Version control with Git & GitHub

## 🔗 Live Demo

Coming soon! Website hosted on InfinityFree.

## 📞 Support

For issues or questions, please create an issue on GitHub:
https://github.com/sukanya-shetty/p/issues

---

**Last Updated**: May 17, 2026

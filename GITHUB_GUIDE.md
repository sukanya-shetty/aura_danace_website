# Complete GitHub Guide for Beginners (+ Interview Questions)

## Part 1: GitHub Basics

### What is Git?
- **Git**: A tool to track changes in your code
- **When**: You save a file version with a note saying "what changed"
- **Why**: You can go back to old versions if something breaks

### What is GitHub?
- **GitHub**: Online storage for your code using Git
- **Like**: Dropbox but for programmers + social network
- **URL**: github.com

### Git vs GitHub
```
Git = Tool on your computer (offline)
GitHub = Online service to store your code (online backup)

Both together = Version control + Cloud backup
```

---

## Part 2: Key Concepts (Interview Questions!)

### 1. **Repository (Repo)**
- **What**: A folder that contains your entire project
- **Example**: Your `aura_dance` website = 1 repository
- **Interview Q**: "What is a repository?"
- **Answer**: "A repository is a folder that tracks all versions of your code using Git"

### 2. **Commit**
- **What**: Saving a version with a message
- **Example**: "Fixed password security", "Added admin dashboard"
- **Interview Q**: "What is a commit?"
- **Answer**: "A commit is a snapshot of your code at a specific time with a description of changes"

```
Commit = Save game checkpoint
Message = What you did in that level
```

### 3. **Push**
- **What**: Upload your commits to GitHub
- **From**: Your computer → GitHub server
- **Interview Q**: "What is push?"
- **Answer**: "Push means uploading your local commits to GitHub server"

### 4. **Pull**
- **What**: Download latest code from GitHub
- **From**: GitHub server → Your computer
- **Interview Q**: "When would you use pull?"
- **Answer**: "When working with team members, pull gets their latest changes"

### 5. **Branch**
- **What**: Separate version of your code
- **Example**: Create "new-feature" branch, keep "main" branch safe
- **Interview Q**: "What is a branch?"
- **Answer**: "A branch is an independent line of development. You can work on new features without affecting the main code"

### 6. **Merge**
- **What**: Combine changes from one branch to another
- **Interview Q**: "What is merge?"
- **Answer**: "Merge is combining code from one branch into another branch"

---

## Part 3: GitHub Workflow

```
Your Computer (Local)          GitHub Server (Cloud)
     ↓                              ↓
 Write Code      ----Commit--→   GitHub Repo
 Save Changes    ----Push----→   (Your code backup)
 Make Commits    ←---Pull-----   (Get others' changes)
```

---

## Part 4: Step-by-Step - Create GitHub Account

### Step 1: Create Account (2 minutes)

1. Go to **https://github.com**
2. Click **"Sign up"** button (top right)
3. Enter:
   - **Email**: Your email address
   - **Password**: Strong password
   - **Username**: Something cool (aura-dance, sukanya-dev, etc.)
4. Click **"Create account"**
5. Verify email (check inbox)
6. Account created! ✅

---

## Part 5: Install Git on Your Computer

### Step 1: Download Git

1. Go to **https://git-scm.com**
2. Click **"Download for Windows"**
3. Install it (keep defaults, just click Next-Next-Finish)

### Step 2: Verify Installation

Open Command Prompt (PowerShell) and type:
```
git --version
```

You should see: `git version 2.x.x`

---

## Part 6: First Time Git Setup

### Open PowerShell and run:

```powershell
git config --global user.name "Your Name"
git config --global user.email "your.email@gmail.com"
```

Example:
```powershell
git config --global user.name "Sukanya"
git config --global user.email "sukanya@gmail.com"
```

This tells Git who YOU are!

---

## Part 7: Push Your Aura Dance Project to GitHub

### Step 1: Create Repository on GitHub (5 minutes)

1. Log in to https://github.com
2. Click **"+"** icon (top right) → **"New repository"**
3. Fill in:
   - **Repository name**: `aura-dance-website`
   - **Description**: `A dance course booking platform for online enrollment`
   - **Visibility**: Select **"Public"** (so interview people can see it!)
   - **Initialize with README**: Check this box
4. Click **"Create repository"**
5. You now have an empty GitHub repo! ✅

### Step 2: Clone Repository to Your Computer (5 minutes)

1. On GitHub repo page, click **"Code"** button (green button)
2. Copy the HTTPS link (looks like: https://github.com/username/aura-dance-website.git)
3. Open PowerShell
4. Navigate to where you want to store it:
   ```
   cd C:\Users\YourName\Documents
   ```
5. Clone (download) the repo:
   ```
   git clone https://github.com/USERNAME/aura-dance-website.git
   ```
6. Navigate into folder:
   ```
   cd aura-dance-website
   ```

### Step 3: Copy Your Project Files (10 minutes)

1. Copy all files from `C:\wamp64\www\p\` (your project)
2. Paste into `C:\Users\YourName\Documents\aura-dance-website\` folder
3. Include:
   - All .php files
   - All .css files
   - All .js files
   - All images
   - All .html files

### Step 4: Check Git Status

```powershell
git status
```

You'll see all your files listed as "Untracked" (not yet saved)

### Step 5: Add Files to Git

```powershell
git add .
```

The dot (.) means "add all files"

### Step 6: Commit Your Files (with message)

```powershell
git commit -m "Initial commit: Aura Dance website with admin panel and course enrollment"
```

The message describes what you're saving

### Step 7: Push to GitHub

```powershell
git push origin main
```

Wait... it will ask for GitHub credentials:
- Username: Your GitHub username
- Password: Your GitHub password (or Personal Access Token)

### Step 8: Verify on GitHub

1. Go to https://github.com/yourusername/aura-dance-website
2. You should see all your files! ✅
3. Share this link in your resume!

---

## Part 8: Common Git Commands (Interview Prep!)

### Check status
```
git status
```
Shows which files changed

### Add files
```
git add .
```
Stage all files for commit

### Commit changes
```
git commit -m "Your message here"
```
Save a version with description

### Push to GitHub
```
git push origin main
```
Upload to GitHub

### Pull latest changes
```
git pull origin main
```
Download latest from GitHub

### See commit history
```
git log
```
Shows all your commits

### Create new branch
```
git checkout -b feature-name
```
Create separate version to work on

### Switch to main branch
```
git checkout main
```
Go back to main code

---

## Part 9: GitHub Profile Tips (For Interview!)

### Make Your Profile Look Professional:

1. Go to https://github.com/settings/profile
2. Add:
   - **Bio**: "Full Stack Developer | Dance Enthusiast | Student"
   - **Location**: Your city
   - **Website**: (if you have one)
   - **Profile Picture**: Your photo

3. Pin your best project (aura-dance-website):
   - Go to your profile
   - Click repository
   - Click "Pin" button

### Your GitHub URL to share:
```
https://github.com/yourusername
```

Put this in your resume and LinkedIn!

---

## Part 10: Interview Questions About GitHub

### Q1: "What is Git?"
**Answer**: "Git is a version control system that tracks changes in code. It allows me to save different versions of my project and revert if needed."

### Q2: "What is GitHub?"
**Answer**: "GitHub is a cloud platform where I can store my Git repositories online. It's like Dropbox for code, and also lets me collaborate with team members."

### Q3: "Explain commit, push, pull"
**Answer**: 
- "Commit: Save a version of my code locally with a description"
- "Push: Upload commits from my computer to GitHub"
- "Pull: Download latest code from GitHub to my computer"

### Q4: "What is a branch?"
**Answer**: "A branch is a separate version of code. Main branch is production-ready, while feature branches let me work on new features without affecting main code."

### Q5: "Why use version control?"
**Answer**: 
- "Track changes over time"
- "Revert to previous versions if something breaks"
- "Collaborate with team members"
- "Maintain code history and documentation"

### Q6: "Tell me about your project on GitHub"
**Answer**: "I built an Aura Dance website using PHP and MySQL. It has student registration, course enrollment, admin dashboard for managing courses and students, and event booking system. The project demonstrates full-stack development with both frontend and backend."

### Q7: "How many commits do you have?"
**Answer**: "I have X commits tracking the development from initial setup through adding features like payment processing and admin functionality."

---

## Part 11: .gitignore File (Best Practice)

Some files should NOT be on GitHub (passwords, databases, etc)

Create file: `.gitignore`

Add this content:
```
# Credentials (NEVER push these!)
config.php
.env
*.log

# System files
.DS_Store
Thumbs.db

# IDE files
.vscode/
.idea/

# Database backups
*.sql
*.bak
```

---

## Part 12: Complete Workflow for Your Project

### First Time:
```
1. Create GitHub account
2. Create new repository (aura-dance-website)
3. Clone to computer
4. Copy your files
5. git add .
6. git commit -m "Initial: Aura Dance website"
7. git push origin main
```

### Next Time (Adding Features):
```
1. Make changes to your code
2. git add .
3. git commit -m "Added feature XYZ"
4. git push origin main
5. Changes visible on GitHub!
```

### With Branches (Professional):
```
1. git checkout -b new-feature
2. Make changes
3. git add .
4. git commit -m "Added new feature"
5. git push origin new-feature
6. Create Pull Request on GitHub
7. Merge to main branch
```

---

## Part 13: What to Push to GitHub

### YES - Push These:
- ✅ .php files
- ✅ .html files
- ✅ .css files
- ✅ .js files
- ✅ README.md (project description)
- ✅ Images (but resize first)
- ✅ .gitignore file

### NO - Don't Push These:
- ❌ Database passwords
- ❌ Personal credentials
- ❌ node_modules/ folder
- ❌ .env files
- ❌ Compiled/build files

---

## Part 14: README.md (Very Important!)

Create file: `README.md` in your project root

Content example:
```markdown
# Aura Dance Website

An online dance course booking and event management platform.

## Features
- Student Registration & Login
- Course Enrollment with Payment Processing
- Admin Dashboard
- Category and Course Management
- Event Booking System
- Student Enrollment Tracking

## Technologies Used
- **Backend**: PHP 7+
- **Database**: MySQL
- **Frontend**: HTML, CSS, JavaScript, Bootstrap 5
- **Authentication**: Session-based with password hashing

## Installation

### Local Setup
1. Install WAMP/LAMP
2. Extract project files
3. Create database: `aura_dance`
4. Import database: `aura_dance.sql`
5. Update database credentials in PHP files
6. Access at: http://localhost/p

### Hosting Setup
See HOSTING_GUIDE.md for InfinityFree deployment

## Project Structure
```
project/
├── admin/
├── vendor/
├── *.php (backend files)
├── *.html (frontend pages)
├── *.css (styling)
├── *.js (functionality)
└── README.md
```

## Usage

### For Students:
1. Sign Up
2. Browse Dance Categories
3. Select Course
4. Fill Details
5. Make Payment
6. Enroll

### For Admins:
1. Log in with credentials
2. Manage Categories & Courses
3. View Student List
4. Track Enrollments
5. View Earnings

## Author
Sukanya

## License
MIT License
```

---

## Part 15: Interview Checklist

### Before Interview:
- [ ] GitHub account created
- [ ] Project pushed to GitHub
- [ ] README.md written well
- [ ] Profile picture added
- [ ] Bio written
- [ ] Project pinned on profile
- [ ] GitHub link in resume
- [ ] Website hosted on InfinityFree
- [ ] Website link in resume

### During Interview:
- [ ] Show GitHub repository
- [ ] Explain project structure
- [ ] Walk through code
- [ ] Discuss technology choices
- [ ] Show live hosted website
- [ ] Explain commits and version control
- [ ] Answer GitHub questions confidently

---

## Summary

```
GitHub for Interview:
1. Shows your work publicly
2. Proves version control knowledge
3. Demonstrates project management
4. Makes you look professional
5. Easy to share with employers

Don't neglect GitHub - it's a BIG part of interviews!
```

---

## Action Plan

### TODAY:
1. Create GitHub account
2. Download Git
3. Configure Git (name + email)

### TOMORROW:
1. Create repository on GitHub
2. Clone to computer
3. Copy project files
4. First commit + push

### RESULT:
Your project on GitHub + Website hosted + Interview ready! 🚀

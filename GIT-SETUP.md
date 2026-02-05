# Git & GitHub Setup Guide

Quick guide to push this project to GitHub.

## 🚀 Push to GitHub

### 1. Initialize Git Repository

```bash
cd /home/rexywijaya/wordpress/personal-portofolio

# Initialize git
git init

# Check status
git status
```

### 2. Create GitHub Repository

1. Go to https://github.com
2. Click "New repository" or "+"
3. Fill in:
   - **Repository name**: `personal-portfolio-wordpress-theme`
   - **Description**: `A modern WordPress portfolio theme with markdown support, real-time preview, and secure authentication`
   - **Visibility**: Public (so recruiters can see it)
   - **DO NOT** initialize with README (we already have one)
4. Click "Create repository"

### 3. Add Files to Git

```bash
# Add all files
git add .

# Check what will be committed
git status

# Create first commit
git commit -m "Initial commit: Personal Portfolio WordPress Theme"
```

### 4. Connect to GitHub

```bash
# Add remote repository (replace YOUR_USERNAME)
git remote add origin https://github.com/YOUR_USERNAME/personal-portfolio-wordpress-theme.git

# Verify remote
git remote -v

# Push to GitHub
git branch -M main
git push -u origin main
```

## 📝 Customize Before Pushing

1. **Update README.md** - Replace placeholder links:
   - `yourusername` → your GitHub username
   - `Your Name` → your actual name
   - Add screenshots (optional but recommended)

2. **Add Repository Topics** (after pushing):
   - `wordpress`, `php`, `docker`, `markdown`, `portfolio`

## 🔄 Making Updates

```bash
# Make changes to your code
git add .
git commit -m "Add new feature"
git push
```

That's it! Your project is now on GitHub.

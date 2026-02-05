<div align="center">

# 🎨 Personal Portfolio WordPress Theme

### A Modern, Full-Stack WordPress Theme for Developers & Creators

[![WordPress](https://img.shields.io/badge/WordPress-5.0%2B-21759b?logo=wordpress)](https://wordpress.org/)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-777bb4?logo=php)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-GPL%20v2-blue.svg)](LICENSE)
[![Docker](https://img.shields.io/badge/Docker-Ready-2496ed?logo=docker)](https://www.docker.com/)

[Features](#-features) • [Quick Start](#-quick-start) • [Demo](#-demo) • [Documentation](#-documentation) • [Contributing](#-contributing)

</div>

---

## 📖 Overview

A production-ready WordPress theme designed for developers and creators who want a clean, modern portfolio with powerful content management. Features include markdown support, real-time preview, secure authentication, and a beautiful responsive UI built with modern web standards.

## ✨ Features

### Core Functionality
- 📝 **Markdown Editor** - Write content using markdown with live preview powered by Marked.js
- 🖼️ **Image Management** - Drag-and-drop image upload with automatic optimization
- ⚡ **Real-time Preview** - See your content rendered as you type
- 🔐 **Secure Authentication** - Role-based access control with WordPress nonces
- ✏️ **CRUD Operations** - Full create, read, update, delete for portfolio items

### Design & UX
- 🎨 **Modern UI** - Clean, professional design with gradient hero sections
- 📱 **Fully Responsive** - Mobile-first design that works on all devices
- 🌈 **Customizable** - CSS variables for easy theming
- ♿ **Accessible** - Semantic HTML with ARIA labels
- ⚡ **Fast Loading** - Optimized CSS and vanilla JavaScript (no jQuery)

### Developer Experience
- 🐳 **Docker Ready** - One-command setup with Docker Compose
- 🔧 **wp-env Compatible** - Works with WordPress CLI tools
- 📦 **Zero Dependencies** - No complex build process required
- 🧪 **Clean Code** - Well-documented, PSR-compliant PHP
- 🔒 **Security First** - Input sanitization, CSRF protection, XSS prevention

## 🚀 Quick Start

### Prerequisites
- Docker & Docker Compose (recommended) **OR**
- WordPress 5.0+ with PHP 7.4+

### Option 1: Docker (Fastest)

```bash
# Clone the repository
git clone https://github.com/yourusername/personal-portfolio-theme.git
cd personal-portfolio-theme

# Start WordPress with Docker
docker-compose up -d

# Wait 30 seconds, then open http://localhost:8080
```

**Complete setup in browser:**
1. Visit http://localhost:8080 and complete WordPress installation
2. Go to Appearance → Themes → Activate "Personal Portfolio"
3. Create pages: "Login" (template: Login Page) and "New Post" (template: New Post Page)
4. Settings → Permalinks → Select "Post name"
5. Start posting! 🎉

### Option 2: Using wp-env (WordPress CLI)

```bash
# Install wp-env globally (requires Node.js & Docker)
npm install -g @wordpress/env

# Start WordPress
wp-env start

# Access at http://localhost:8888
# Default credentials: admin / password
```

### Option 3: Manual Installation (XAMPP/MAMP)

1. **Install WordPress** on your local server
2. **Copy theme folder** to `wp-content/themes/`
3. **Activate theme** in WordPress Admin
4. **Create pages**: "Login" (template: Login Page) and "New Post" (template: New Post Page)
5. **Set permalinks** to "Post name" in Settings → Permalinks

## 📸 Demo

### Homepage - Portfolio Grid
![Portfolio Homepage](https://via.placeholder.com/800x400/667eea/ffffff?text=Portfolio+Grid+View)

### Markdown Editor with Live Preview
![Markdown Editor](https://via.placeholder.com/800x400/764ba2/ffffff?text=Markdown+Editor+%26+Preview)

### Responsive Design
![Responsive](https://via.placeholder.com/800x400/2563eb/ffffff?text=Mobile+Responsive)

> **Note**: Replace placeholder images with actual screenshots of your theme

## 📚 Usage

### Creating Your First Portfolio Item

```markdown
# Example Portfolio Post

## Project Overview
This is a **sample** portfolio item written in *markdown*.

### Technologies Used
- WordPress
- PHP
- JavaScript
- Docker

### Code Example
```php
function my_custom_function() {
    return "Hello World!";
}
```

![Project Screenshot](https://example.com/image.jpg)
```

### For Maintainers

**Login** → **New Post** → Write content in markdown → **Upload image** → **Publish**

**Edit/Delete**: Click any portfolio item → Use admin controls when logged in

### For Visitors

- Browse portfolio items on homepage
- Click to read full articles
- Enjoy responsive, fast-loading experience

## 🛠️ Technical Stack

| Technology | Purpose |
|------------|----------|
| WordPress 5.0+ | CMS Framework |
| PHP 7.4+ | Backend Logic |
| MySQL/MariaDB | Database |
| Marked.js | Markdown Parsing |
| Vanilla JavaScript | Frontend Interactions |
| CSS3 (Variables) | Styling & Theming |
| Docker | Containerization |

## 📂 Project Structure

```
personal-portfolio/
├── 📄 style.css                 # Main stylesheet with CSS variables
├── ⚙️ functions.php             # Theme setup & custom post types
├── 🏠 index.php                 # Homepage template (portfolio grid)
├── 📋 header.php                # Site header with navigation
├── 📋 footer.php                # Site footer
├── 🔐 page-login.php            # Maintainer login template
├── ✏️ page-new-post.php         # Create/edit portfolio items
├── 📄 single-portfolio.php      # Individual portfolio display
├── 🐳 docker-compose.yml        # Docker setup
├── 🔧 .wp-env.json              # wp-env configuration
├── 📖 README.md                 # This file
├── 📖 SETUP-GUIDE.md            # Detailed installation guide
└── 🚀 quick-start.sh            # Automated setup script
```

## 🎨 Customization

### Theme Colors

Easy customization using CSS variables in `style.css`:

```css
:root {
  --primary-color: #2563eb;      /* Brand color */
  --secondary-color: #1e40af;    /* Hover states */
  --text-dark: #1f2937;          /* Body text */
  --text-light: #6b7280;         /* Meta text */
  --bg-light: #f9fafb;           /* Backgrounds */
}
```

### Hero Gradient

```css
.hero {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
```

### Custom Fonts

Add Google Fonts in `header.php` and update CSS:

```css
body {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}
```

## 🔒 Security Features

- ✅ **CSRF Protection** - WordPress nonces on all forms
- ✅ **XSS Prevention** - All outputs sanitized and escaped
- ✅ **SQL Injection Protection** - Prepared statements via WordPress API
- ✅ **Role-Based Access** - Only maintainers can create/edit/delete
- ✅ **Input Validation** - Server-side validation on all user inputs
- ✅ **Secure File Uploads** - WordPress media handling with type validation

## 🧪 Testing

### Manual Testing Checklist

- [ ] Install theme via WordPress admin
- [ ] Create portfolio items with markdown
- [ ] Upload images (various formats)
- [ ] Test on mobile devices
- [ ] Verify role-based access control
- [ ] Test edit/delete functionality
- [ ] Check responsive design breakpoints

### Browser Compatibility

- ✅ Chrome/Edge (Chromium) 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Mobile browsers (iOS Safari, Chrome Mobile)

## 🤝 Contributing

Contributions are welcome! Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details.

### Development Workflow

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Make your changes
4. Test thoroughly
5. Commit (`git commit -m 'Add amazing feature'`)
6. Push to branch (`git push origin feature/amazing-feature`)
7. Open a Pull Request

### Code Standards

- Follow WordPress Coding Standards
- Use meaningful variable/function names
- Comment complex logic
- Keep functions small and focused

## 🐛 Issues & Support

- 🐞 Found a bug? [Open an issue](https://github.com/yourusername/personal-portfolio-theme/issues)
- 💡 Have a feature idea? [Start a discussion](https://github.com/yourusername/personal-portfolio-theme/discussions)
- 📧 Need help? Check [WordPress documentation](https://developer.wordpress.org/themes/)

## 📈 Roadmap

- [ ] Add category/tag support
- [ ] Implement search functionality
- [ ] Dark mode toggle
- [ ] REST API endpoints
- [ ] Automated testing with PHPUnit
- [ ] Gutenberg block editor support
- [ ] Multi-language support (i18n)

## 📄 License

This project is licensed under the GNU General Public License v2 or later - see the [LICENSE](LICENSE) file for details.

## 👨‍💻 Author

**Your Name**
- GitHub: [@yourusername](https://github.com/yourusername)
- LinkedIn: [Your Name](https://linkedin.com/in/yourprofile)
- Portfolio: [yourwebsite.com](https://yourwebsite.com)

## 🙏 Acknowledgments

- [WordPress](https://wordpress.org/) - CMS platform
- [Marked.js](https://marked.js.org/) - Markdown parser
- [Docker](https://www.docker.com/) - Containerization
- Modern UI/UX principles from [dribbble](https://dribbble.com/) and [awwwards](https://www.awwwards.com/)

---

<div align="center">

**⭐ Star this repo if you find it helpful!**

Made with ❤️ by [Your Name](https://github.com/yourusername)

</div>

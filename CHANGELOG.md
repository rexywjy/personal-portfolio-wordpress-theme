# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Planned
- Category/tag support for portfolio items
- Search functionality
- Dark mode toggle
- REST API endpoints
- Gutenberg block editor support
- Multi-language support (i18n)

## [1.0.0] - 2026-02-05

### Added
- Custom portfolio post type with full CRUD operations
- Markdown editor with live preview using Marked.js
- Secure authentication system with role-based access control
- Image upload with featured image support
- Responsive grid layout for portfolio items
- Docker Compose setup for local development
- wp-env configuration for WordPress CLI
- Comprehensive documentation (README, SETUP-GUIDE, ARCHITECTURE)
- Security features (nonces, sanitization, escaping)
- Modern UI with CSS variables for easy customization
- Mobile-first responsive design

### Security
- CSRF protection via WordPress nonces
- XSS prevention through output escaping
- SQL injection protection using prepared statements
- Role-based access control for maintainers
- Input validation and sanitization
- Secure file upload handling

### Documentation
- Installation guide with multiple setup options
- Architecture documentation
- Contributing guidelines
- Git setup instructions
- Code standards and best practices

---

## Version Format

- **MAJOR** version when you make incompatible API changes
- **MINOR** version when you add functionality in a backwards compatible manner
- **PATCH** version when you make backwards compatible bug fixes

## Categories

- **Added** for new features
- **Changed** for changes in existing functionality
- **Deprecated** for soon-to-be removed features
- **Removed** for now removed features
- **Fixed** for any bug fixes
- **Security** in case of vulnerabilities

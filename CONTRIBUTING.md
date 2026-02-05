# Contributing to Personal Portfolio WordPress Theme

Thank you for your interest in contributing! This document provides guidelines and instructions for contributing to this project.

## 🌟 How to Contribute

### Reporting Bugs

Before creating bug reports, please check existing issues. When creating a bug report, include:

- **Description**: Clear and concise description of the bug
- **Steps to Reproduce**: Detailed steps to reproduce the behavior
- **Expected Behavior**: What you expected to happen
- **Screenshots**: If applicable, add screenshots
- **Environment**:
  - WordPress version
  - PHP version
  - Browser and version
  - Operating system

### Suggesting Features

Feature requests are welcome! Please:

- Check if the feature has already been requested
- Provide a clear description of the feature
- Explain why this feature would be useful
- Include examples or mockups if possible

### Pull Requests

1. **Fork the repository** and create your branch from `main`
2. **Make your changes** following our coding standards
3. **Test thoroughly** - ensure nothing breaks
4. **Update documentation** if needed
5. **Write meaningful commit messages**
6. **Submit your pull request**

## 💻 Development Setup

```bash
# Clone your fork
git clone https://github.com/yourusername/personal-portfolio-theme.git
cd personal-portfolio-theme

# Start development environment
docker-compose up -d

# Make changes to the code
# Test in browser at http://localhost:8080
```

## 📝 Coding Standards

### PHP

- Follow [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/)
- Use meaningful variable and function names
- Add PHPDoc comments for functions
- Sanitize all inputs, escape all outputs
- Use WordPress functions over native PHP when available

**Example:**
```php
/**
 * Get portfolio items with custom query
 *
 * @param int $limit Number of items to retrieve
 * @return WP_Query Portfolio query object
 */
function portfolio_get_items( $limit = 10 ) {
    $args = array(
        'post_type'      => 'portfolio',
        'posts_per_page' => absint( $limit ),
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    
    return new WP_Query( $args );
}
```

### CSS

- Use CSS variables for colors and spacing
- Mobile-first approach
- BEM naming convention where appropriate
- Keep specificity low
- Comment complex sections

**Example:**
```css
/* Portfolio Grid Layout */
.portfolio-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
  gap: 2rem;
}

@media (max-width: 768px) {
  .portfolio-grid {
    grid-template-columns: 1fr;
  }
}
```

### JavaScript

- Use modern ES6+ syntax
- Prefer vanilla JavaScript over libraries
- Add comments for complex logic
- Handle errors gracefully

**Example:**
```javascript
/**
 * Update markdown preview
 * @param {string} markdown - Raw markdown content
 */
function updatePreview(markdown) {
    const preview = document.getElementById('markdownPreview');
    if (typeof marked !== 'undefined' && preview) {
        preview.innerHTML = marked.parse(markdown);
    }
}
```

## 🧪 Testing

Before submitting a PR, test:

- [ ] Fresh WordPress installation
- [ ] Theme activation
- [ ] Creating portfolio items
- [ ] Image uploads
- [ ] Markdown rendering
- [ ] Edit/delete functionality
- [ ] Mobile responsiveness
- [ ] Different browsers

## 📋 Commit Message Guidelines

Use clear, descriptive commit messages:

```
feat: add dark mode toggle
fix: resolve image upload issue on mobile
docs: update installation instructions
style: improve responsive grid layout
refactor: optimize markdown parsing
```

**Format:**
- `feat:` - New feature
- `fix:` - Bug fix
- `docs:` - Documentation changes
- `style:` - Code style/formatting
- `refactor:` - Code refactoring
- `test:` - Adding tests
- `chore:` - Maintenance tasks

## 🔍 Code Review Process

1. All submissions require review
2. Maintainers may request changes
3. Once approved, maintainers will merge
4. Keep PRs focused and small when possible

## 📜 License

By contributing, you agree that your contributions will be licensed under the GPL v2 license.

## ❓ Questions?

Feel free to:
- Open an issue for clarification
- Start a discussion
- Contact the maintainers

---

Thank you for contributing! 🎉

# Architecture Documentation

## 🏗️ System Architecture

This document describes the technical architecture of the Personal Portfolio WordPress Theme.

## Overview

The theme follows a traditional WordPress theme architecture with custom post types, template hierarchy, and modern frontend enhancements.

```
┌─────────────────────────────────────────────────────────────┐
│                         Browser                              │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐      │
│  │   HTML/CSS   │  │  JavaScript  │  │  Marked.js   │      │
│  └──────────────┘  └──────────────┘  └──────────────┘      │
└─────────────────────────────────────────────────────────────┘
                            ↕
┌─────────────────────────────────────────────────────────────┐
│                    WordPress Core                            │
│  ┌──────────────────────────────────────────────────────┐   │
│  │              Template System                          │   │
│  │  • header.php    • index.php    • footer.php        │   │
│  │  • single-portfolio.php  • page-*.php               │   │
│  └──────────────────────────────────────────────────────┘   │
│  ┌──────────────────────────────────────────────────────┐   │
│  │              Theme Functions                          │   │
│  │  • Custom Post Types  • Form Handlers               │   │
│  │  • Security/Nonces   • Media Management             │   │
│  └──────────────────────────────────────────────────────┘   │
└─────────────────────────────────────────────────────────────┘
                            ↕
┌─────────────────────────────────────────────────────────────┐
│                    Database (MySQL)                          │
│  • wp_posts (portfolio items)  • wp_postmeta               │
│  • wp_users (authentication)   • wp_options                │
└─────────────────────────────────────────────────────────────┘
```

## Component Architecture

### 1. Custom Post Type: Portfolio

**Registration** (`functions.php`):
```php
register_post_type('portfolio', [
    'public' => true,
    'supports' => ['title', 'editor', 'thumbnail', 'author'],
    'has_archive' => false,
]);
```

**Database Schema**:
- Stored in `wp_posts` table with `post_type = 'portfolio'`
- Featured images stored as post meta
- Author information linked via `post_author`

### 2. Template Hierarchy

```
Request Flow:
├── Homepage (/)
│   └── index.php (displays all portfolio items)
│
├── Single Portfolio (/portfolio/{slug})
│   └── single-portfolio.php
│
├── Login Page (/login)
│   └── page-login.php (Template: Login Page)
│
└── New Post Page (/new-post)
    └── page-new-post.php (Template: New Post Page)
```

### 3. Authentication & Authorization

**Flow Diagram**:
```
User Login Request
    ↓
wp_signon() [WordPress Core]
    ↓
Check Capabilities (edit_posts)
    ↓
    ├── Success → Create Session → Redirect to /new-post
    └── Failure → Redirect to /login?error=failed
```

**Security Layers**:
1. **Nonce Verification**: CSRF protection on all forms
2. **Capability Check**: `current_user_can('edit_posts')`
3. **Input Sanitization**: `sanitize_text_field()`, `wp_kses_post()`
4. **Output Escaping**: `esc_html()`, `esc_url()`, `esc_attr()`

### 4. Form Processing

**Create Portfolio Item Flow**:
```
1. User submits form (page-new-post.php)
    ↓
2. POST to admin-post.php?action=portfolio_new_post
    ↓
3. Handler: portfolio_handle_new_post()
    ↓
4. Validate nonce & capabilities
    ↓
5. Sanitize inputs
    ↓
6. wp_insert_post() → Create post
    ↓
7. media_handle_upload() → Process image
    ↓
8. set_post_thumbnail() → Set featured image
    ↓
9. Redirect with success/error message
```

### 5. Markdown Processing

**Client-Side** (Real-time preview):
```javascript
marked.parse(markdown) → HTML
```

**Server-Side** (Storage):
- Content stored as-is in `post_content`
- Rendered on display using `the_content()` or `marked.parse()`

### 6. Frontend Architecture

**CSS Organization**:
```css
:root                    /* CSS Variables */
  ↓
Reset/Base Styles       /* *, body, etc. */
  ↓
Layout Components       /* .container, header, footer */
  ↓
Portfolio Components    /* .portfolio-grid, .portfolio-item */
  ↓
Form Components        /* .form-group, .btn */
  ↓
Responsive Queries     /* @media */
```

**JavaScript Modules**:
```javascript
// No build step - vanilla JS
- Markdown preview (page-new-post.php)
- Image preview (page-new-post.php)
- Edit form toggle (single-portfolio.php)
- Content rendering (single-portfolio.php)
```

## Data Flow

### Creating a Portfolio Item

```
User Input (Form)
    ↓
[JavaScript] Image preview + Markdown preview
    ↓
[PHP] Form submission → admin-post.php
    ↓
[PHP] portfolio_handle_new_post()
    ├── Nonce verification
    ├── Capability check
    ├── Data sanitization
    └── wp_insert_post()
            ↓
        [Database] wp_posts table
            ├── post_title
            ├── post_content (markdown)
            ├── post_type = 'portfolio'
            └── post_status = 'publish'
            ↓
        [PHP] media_handle_upload()
            ↓
        [Database] wp_postmeta
            └── _thumbnail_id
                ↓
            [Redirect] → Success/Error page
```

### Displaying Portfolio Items

```
[Request] Homepage (/)
    ↓
[PHP] index.php
    ↓
[PHP] WP_Query(['post_type' => 'portfolio'])
    ↓
[Database] Query wp_posts
    ↓
[PHP] Loop through results
    ├── the_title()
    ├── the_post_thumbnail()
    ├── the_content() / excerpt
    └── get_permalink()
        ↓
    [HTML] Render portfolio grid
        ↓
    [CSS] Style with .portfolio-grid
        ↓
    [Browser] Display to user
```

## File Responsibilities

| File | Purpose | Key Functions |
|------|---------|---------------|
| `functions.php` | Theme setup, post types, handlers | `portfolio_register_post_type()`, `portfolio_handle_new_post()` |
| `index.php` | Homepage display | Queries and displays all portfolio items |
| `single-portfolio.php` | Single item view | Displays full content, edit/delete controls |
| `page-login.php` | Authentication | Login form, error handling |
| `page-new-post.php` | Content creation | Form with markdown editor, image upload |
| `header.php` | Site header | Navigation, login/logout links |
| `footer.php` | Site footer | Copyright, credits |
| `style.css` | All styling | CSS variables, responsive design |

## Security Architecture

### Input Validation
```php
// Nonce verification
wp_verify_nonce($_POST['nonce'], 'action_name')

// Capability check
current_user_can('edit_posts')

// Sanitization
sanitize_text_field()  // For text
wp_kses_post()         // For HTML content
absint()               // For integers
```

### Output Escaping
```php
esc_html()   // Plain text
esc_url()    // URLs
esc_attr()   // HTML attributes
wp_kses()    // Allowed HTML tags
```

### File Upload Security
```php
// WordPress handles:
- File type validation
- Filename sanitization
- Upload directory permissions
- Size limits
```

## Performance Considerations

1. **No Build Process**: Vanilla JS, no webpack/bundling
2. **Minimal Dependencies**: Only Marked.js from CDN
3. **Efficient Queries**: Uses `WP_Query` with specific args
4. **CSS Variables**: Runtime theming without preprocessing
5. **Lazy Loading**: Images can be lazy-loaded (future enhancement)

## Extensibility Points

### Hooks Available
```php
// Actions
add_action('after_setup_theme', 'custom_function');
add_action('wp_enqueue_scripts', 'custom_scripts');

// Filters
add_filter('the_content', 'custom_content_filter');
```

### Child Theme Support
- All templates can be overridden
- CSS variables for easy customization
- `functions.php` extensible via hooks

## Docker Architecture

```yaml
Services:
├── db (MariaDB)
│   └── Port: 3306 (internal)
├── wordpress
│   ├── Port: 8080 → 80
│   └── Volume: ./ → /wp-content/themes/personal-portofolio
└── phpmyadmin
    └── Port: 8081 → 80
```

## Future Architecture Improvements

- [ ] REST API endpoints for portfolio items
- [ ] Gutenberg block support
- [ ] Caching layer (Redis/Memcached)
- [ ] CDN integration for assets
- [ ] WebP image conversion
- [ ] Service worker for offline support

---

**Last Updated**: 2026-02-05
**Version**: 1.0.0

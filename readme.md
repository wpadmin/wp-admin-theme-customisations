# WP-Admin Theme Customisations

WordPress plugin for theme customisations: custom CSS, JS, templates, and functions.

**Author:** Zhenya Sh.

**Version:** 1.1.0

**Requires:** WordPress 6.0+, PHP 7.4+

**Tested:** WordPress 6.7

## Features

- Custom CSS styles
- JavaScript files (plain JS and jQuery-dependent)
- WordPress template overrides
- WooCommerce template overrides
- Custom functions via separate file
- Namespace-based architecture

## Structure

```text
wp-admin-theme-customisations/
├── wp-admin-theme-customisations.php    # Main plugin file
├── assets/
│   ├── css/
│   │   └── style.css                    # Custom CSS
│   └── js/
│       ├── custom.js                    # Plain JavaScript
│       └── jquery-custom.js             # jQuery-dependent
└── custom/
    ├── functions.php                    # Custom functions
    └── templates/                       # Template overrides
        ├── page.php                     # WordPress templates
        ├── single.php
        └── woocommerce/                 # WooCommerce templates
            ├── cart/
            └── checkout/
```

## Installation

1. Upload to `/wp-content/plugins/`
2. Activate via WordPress admin
3. Add custom code to files in `assets/` and `custom/` directories

## Usage

### Custom CSS

Place styles in `assets/css/style.css`

### Custom JavaScript

- Plain JS: `assets/js/custom.js`
- jQuery: `assets/js/jquery-custom.js`

### Custom Functions

Add functions to `custom/functions.php`

### Template Overrides

- WordPress: `custom/templates/[template-name].php`
- WooCommerce: `custom/templates/woocommerce/[template-path]`

## Development

**Namespace:** `ZHSH\ThemeCustomisations`

**Prefix:** `ZHSH_TC`

**Text Domain:** `zhsh-theme-customisations`

## License

GPL v2 or later

## Links

[GitHub Repository](https://github.com/wpadmin/wp-admin-theme-customisations)

# My Plugin

A production-ready WordPress Plugin Starter Kit with full OOP architecture.

## Features

- **Singleton Pattern**: Core class ensures only one instance runs.
- **Loader System**: Decouples hook registration from business logic.
- **Settings API**: Integrated settings page with 다양한 field types.
- **Database CRUD**: Ready-to-use DB layer with `$wpdb->prepare()`.
- **AJAX & REST API**: Scaffolding for both traditional AJAX and modern REST endpoints.
- **Admin & Public Separation**: Clean separation of styles, scripts, and logic.
- **Security First**: Nonce verification, capability checks, and proper escaping/sanitization.
- **i18n Ready**: Fully translatable with POT file provided.

## Installation

### Manual Installation
1. Download the plugin as a ZIP.
2. Go to **Plugins -> Add New -> Upload** in your WordPress dashboard.
3. Select the ZIP file and click **Install Now**.
4. Activate the plugin.

### GitHub Clone
1. Navigate to your `wp-content/plugins` directory.
2. Run: `git clone https://github.com/YOUR_USERNAME/my-plugin.git`
3. Activate the plugin via WordPress Admin.

## How to Rename / Rebrand

To use this starter kit for your own project, perform the following find-and-replace (case-sensitive):

1. **`my-plugin`** -> `your-plugin-slug`
2. **`my_plugin_`** -> `your_prefix_` (for functions/variables)
3. **`My_Plugin_`** -> `Your_Prefix_` (for classes)
4. **`MY_PLUGIN_`** -> `YOUR_PREFIX_` (for constants)
5. **`My Plugin`** -> `Your Plugin Name`

Don't forget to rename the main file `my-plugin.php` to your slug.

## Folder Structure

- `admin/`: Admin-side logic, styles, and templates.
- `public/`: Public-facing logic, styles, and templates.
- `includes/`: Core architecture classes and utility helpers.
- `languages/`: Translation files (.pot).
- `assets/`: Media files for WP.org (banners, icons).

## Hooks Reference

### Actions
- `my_plugin_before_render`: Fired before the shortcode is rendered.
- `my_plugin_after_save_settings`: Fired after settings are updated.

### Filters
- `my_plugin_filter_data`: Filter the data before DB insertion.

## Contributing

Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct and the process for submitting pull requests.

## License

This project is licensed under the GPL v2 or later. See the [LICENSE](LICENSE) file for details.

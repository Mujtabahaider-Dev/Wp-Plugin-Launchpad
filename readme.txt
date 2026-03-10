=== My Plugin ===
Contributors: yourname
Donate link: https://yourwebsite.com/donate
Tags: starter, oop, developer, framework
Requires at least: 5.8
Tested up to: 6.4
Stable tag: 1.0.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A production-ready WordPress Plugin Starter Kit with full OOP architecture.

== Description ==

This plugin is a professional starter kit for WordPress developers who want to build high-quality, scalable plugins using Object-Oriented Programming (OOP) principles. 

Key benefits include:
- **Singleton Pattern**: Core class ensures only one instance runs.
- **Loader System**: Decouples hook registration from business logic.
- **Settings API**: Integrated settings page with various field types.
- **Database CRUD**: Ready-to-use DB layer with `$wpdb->prepare()`.
- **AJAX & REST API**: Scaffolding for both traditional AJAX and modern REST endpoints.
- **Security First**: Nonce verification, capability checks, and proper escaping/sanitization.
- **i18n Ready**: Fully translatable.

== Installation ==

1. Upload the `my-plugin` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Accessible via the 'My Plugin' menu in the admin dashboard.

== Frequently Asked Questions ==

= How do I rename the plugin? =
Follow the Find & Replace guide in the `README.md` file (for GitHub) or the internal comments.

== Screenshots ==

1. The main admin dashboard showing quick actions.
2. The settings page built with the Settings API.

== Changelog ==

= 1.0.0 =
* Initial release of My Plugin Starter Kit.

# Bootstrap 5 and Elite Admin Theme Integration

This directory contains files for upgrading the PPV1 codebase from Bootstrap 3/4 to Bootstrap 5, using the Elite Admin theme. The upgrade is designed to be backwards compatible, ensuring that existing functionality continues to work while the styling is modernized.

## Files Included

- **bootstrap.min.css**: Core Bootstrap 5 CSS file
- **bootstrap.bundle.min.js**: Core Bootstrap 5 JavaScript file (includes Popper.js)
- **elite-admin.css**: Custom CSS for Elite Admin theme
- **elite-utilities.css**: Additional utility classes for the Elite Admin theme
- **fonts.css**: Google Fonts import (Nunito Sans)
- **bootstrap-migration.css**: Helper CSS for backward compatibility with Bootstrap 3/4
- **bootstrap-migrate.js**: Helper JavaScript for backward compatibility with Bootstrap 3/4

## Implementation Status

The following files have been updated to use Bootstrap 5:

1. **application/views/auth/login.php**: Login page styled with Bootstrap 5 and Elite Admin theme
2. **application/modules/home/views/dashboard.php**: Main template header with Bootstrap 5 CSS
3. **application/modules/home/views/footer.php**: Template footer with Bootstrap 5 JavaScript

## Migration Plan for Remaining Modules

For a complete migration, the following steps should be taken:

1. **Template Files**: All template files have been updated:
   - dashboard.php: Contains header/meta tags and CSS references
   - footer.php: Contains JavaScript references

2. **Module Views**: Each module view will need to be updated:
   - Replace Bootstrap 3/4 specific classes with Bootstrap 5 equivalents
   - Update any JavaScript that uses Bootstrap plugins

3. **Priority Modules**: Focus on these modules first:
   - Dashboard (home)
   - Patient
   - Doctor
   - Appointment
   - Schedule
   - Reports

## Major Class Name Changes in Migration

### Form Controls
- `.form-group` is removed, use margin utilities like `.mb-3` instead
- Use `.form-control-lg` and `.form-control-sm` for sizing
- Checkboxes and radios use new markup

### Buttons
- `.btn-default` is now `.btn-light`
- Button outlines classes now use `.btn-outline-*`

### Navbar
- `.navbar-expand-*` is required for responsive navbars
- `.navbar-dark` and `.navbar-light` for color schemes
- `.mr-auto` is now `.me-auto` (margin-right to margin-end)

### Cards
- `.card-block` is now `.card-body`
- `.card-title` and `.card-subtitle` spacing adjusted
- `.card-group`, `.card-deck`, and `.card-columns` behavior changes

### Dropdowns
- Data attributes changed from `data-toggle` to `data-bs-toggle`
- Other data attributes prefixed with `data-bs-`

### Modals
- Modal markup simplified
- Data attributes changed from `data-toggle="modal"` to `data-bs-toggle="modal"`

## How to Update a Specific Module

1. Identify Bootstrap 3/4 classes in the HTML
2. Replace with Bootstrap 5 equivalents using the migration guide
3. Update any JavaScript that uses Bootstrap plugins to use the new syntax
4. Test all interactive elements (dropdowns, modals, tooltips, etc.)

## Additional Resources

- [Bootstrap 5 Documentation](https://getbootstrap.com/docs/5.0/getting-started/introduction/)
- [Bootstrap 5 Migration Guide](https://getbootstrap.com/docs/5.0/migration/)
- [Elite Admin Theme Documentation](#) 
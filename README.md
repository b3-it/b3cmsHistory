# b3cmshistory

**b3cmsHistory** is a module for OpenMage that enables automatic versioning of CMS pages and CMS blocks.
Changes to content are automatically logged so that previous versions can be viewed, compared and, if necessary, restored at any time.
Administration is carried out conveniently via the admin interface.

---

## Requirements

- OpenMage >= 19.0
- PHP 7.4 and above 
- Composer (optional, for installation via Composer)

---

## Installation

### Variante 1: Manuell

1. Clone or download repository:
   ```bash
   git clone https://github.com/b3-it/b3cmsHistory.git
   ```

2. Copy files to the Magento root directory.

3. Clear cache and reload admin panel:
   ```bash
   php shell/cache.php clean
   ```

### Variante 2: Composer

```bash
composer config repositories.cmshistory vcs https://github.com/b3-it/b3cmsHistory.git
```

```bash
composer require b3it/cmshistory:^1.0
```

> Note: Make sure your `composer.json` repository is set up correctly if the package is not available via Packagist.

---

## Use

After installation, you will find an additional tab **History** in the admin area for CMS pages and CMS blocks.

### Functions

- Automatic saving of changes each time CMS content is saved
- History display with timestamps and authors
- Comparison view between two versions (Diff)
- Restore older versions with one click

### Example

1. Edit a CMS page, e.g. `Home Page`, and save the changes.
2. Go to the admin area under **CMS > Pages > Home Page > History**.
3. View the saved versions, compare content or restore a previous version.

---

## Contribute

If you have any questions or problems, please create an [Issue](https://github.com/b3-it/b3cmsHistory/issues) or submit pull requests.

---

# Post Deploy

A Drupal module that provides a Drush command to run post-deployment cleanup tasks.

## What It Does

The `drush postdeploy` (alias: `drush pd`) command performs the following:

1. **Truncates the `authmap` table** — clears external authentication mappings (requires the `externalauth` module; skipped if not installed)
2. **Clears `update_fetch_task` entries** — removes stale update fetch task records from the `key_value` table

## Requirements

- Drupal 10 or 11
- Drush

## Installation

Since this module is hosted on GitHub and not on Packagist, you need to add the repository to your project's `composer.json`:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/itcon-inc/postdeploy.git"
        }
    ]
}
```

Then require the package:

```bash
composer require drupal/postdeploy
```

Enable the module:

```bash
drush en postdeploy
```

## Usage

```bash
drush postdeploy
```

Or using the alias:

```bash
drush pd
```

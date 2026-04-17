# Pretty Code

**Pretty Code** is a githook-driven collection of formatter configurations for PHP, CSS, HTML, and JavaScript. It is designed for both **Roots Bedrock + Sage** and **Statamic** projects.

When this package is updated, running `npm update` will pull in the latest configuration changes, minus anything you've overridden in your project.

## Table of Contents

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Initialization](#initialization)
4. [Commands](#commands)
5. [Updating](#updating)
6. [PHP Formatting](#php-formatting)
7. [Formatters](#formatters)
8. [Supported File Types](#supported-file-types)
9. [Configuration Files](#configuration-files)
10. [Customization per Project](#customization-per-project)
11. [Troubleshooting](#troubleshooting)
12. [Uninstalling](#uninstalling)

## Requirements

- Node 20+
- PHP 8.1+ (for PHP formatting)
- Laravel Pint (included in Bedrock/Sage and Statamic)

## Installation

```sh
npm install --save-dev @lform/pretty-code
```

After installing, you'll see a reminder to run the init command.

## Initialization

Run the init command to scaffold the project. It copies all configuration files to the project root, configures git hooks, and adds `pretty:format`, `pretty:format:prettier`, `pretty:format:pint`, and `pretty:check` scripts to `package.json`.

```sh
npx pretty-code init
```

Existing config files are overwritten — use `git diff` to review changes before committing. Pass `--suggest` to write new configs as `.suggestions.*` files alongside your existing ones instead:

```sh
npx pretty-code init --suggest
```

## Commands

```sh
# Run all formatters
npm run pretty:format

# Prettier only — JS, CSS, HTML, Blade, Antlers, JSON, YAML, etc.
npm run pretty:format:prettier

# Pint only — PHP files
npm run pretty:format:pint

# Check formatting without writing (useful in CI)
npm run pretty:check
```

## Updating

When a new version of Pretty Code is released, update the package and then run:

```sh
npx pretty-code update
```

This overwrites your config files with the latest package versions. Use `git diff` to review and selectively revert any changes you want to keep. Pass `--suggest` to write updated configs as `.suggestions.*` files instead:

```sh
npx pretty-code update --suggest
```

## PHP Formatting

### Laravel Pint (recommended)

[Laravel Pint](https://laravel.com/docs/pint) is the recommended PHP formatter and is included by default in both **Roots Bedrock + Sage** and **Statamic** — no separate install needed for those projects. The `pint.json` config file is copied to your project root during `init`.

### PHP CS Fixer (alternative)

For projects that cannot use Laravel Pint, a `.php-cs-fixer.php` baseline configuration is included in the package as a reference. To use it:

1. Install PHP CS Fixer:

```sh
composer require --dev friendsofphp/php-cs-fixer
```

2. Copy the baseline config to your project root:

```sh
cp node_modules/@lform/pretty-code/.php-cs-fixer.php .php-cs-fixer.php
```

3. Update `.lintstagedrc.json` to replace the Pint rule with PHP CS Fixer:

```json
"*.php": "vendor/bin/php-cs-fixer fix"
```

4. Update the `pretty:format:php` script in `package.json`:

```json
"pretty:format:php": "vendor/bin/php-cs-fixer fix"
```

## Formatters

- [Pint](https://laravel.com/docs/pint) — PHP formatting (included in Bedrock/Sage and Statamic)
- [Prettier](https://prettier.io/) — JS, CSS, HTML, Blade, Antlers, and more

## Supported File Types

| Extension | Tool |
|---|---|
| `php` | Pint |
| `blade.php` | Prettier |
| `antlers.html`, `antlers.php` | Prettier |
| `js`, `jsx`, `ts`, `tsx` | Prettier |
| `css`, `scss`, `pcss` | Prettier |
| `html`, `htm` | Prettier |
| `json` | Prettier |
| `yaml`, `yml` | Prettier |

## Configuration Files

| File | Description |
|---|---|
| `.prettierrc.json` | Prettier configuration |
| `.prettierignore` | Files excluded from Prettier |
| `.lintstagedrc.json` | Pre-commit hook rules |
| `.editorconfig` | Editor-wide formatting defaults |
| `.githooks/` | Git hook scripts |
| `pint.json` | Laravel Pint configuration |
| `.php-cs-fixer.php` | PHP CS Fixer baseline (reference — copy manually if needed) |

## Customization Per Project

To customize the formatters per project:

1. Copy the specific configuration files from the Pretty Code package root to the project root. Only copy the ones you need — these will no longer receive updates via the package manager.
2. Modify the copied configuration files as needed.
3. The formatters will automatically pick up configuration files in the project root directory.

To undo customizations, delete the project-level config files and they will fall back to the package defaults.

## Troubleshooting

### Disconnecting & Reconnecting the Git Hook

If you need to disable or re-enable the automated pre-commit hook:

```sh
# Disable:
git config core.hooksPath ".git/hooks"

# Re-enable:
git config core.hooksPath ".githooks"
```

## Uninstalling

1. Delete any config files copied to the project root
2. Delete the `.githooks` directory
3. Run `git config core.hooksPath .git/hooks`
4. Run `npm remove @lform/pretty-code`
5. Remove the `pretty:format`, `pretty:check`, and `pretty:format:php` scripts from `package.json`

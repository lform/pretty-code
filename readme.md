# Pretty Code

**Pretty Code** is a githook-driven collection of formatter configurations for PHP, CSS, HTML, and JavaScript. It is designed for both **Roots Bedrock + Sage** and **Statamic** projects, both of which include Laravel Pint as a Composer dev dependency.

When this package is updated, running `npm update` will pull in the latest configuration changes, minus anything you've overridden in your project.

## Table of Contents

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Initialization](#initialization)
4. [Commands](#commands)
5. [Customization per Project](#customization-per-project)
6. [Troubleshooting](#troubleshooting)
7. [Uninstalling](#uninstalling)

## Requirements

- Environments: OSX, Linux, WSL
- PHP 8.1+
- Node 20+
- Laravel Pint (included in Bedrock/Sage and Statamic — no separate install needed)

## Installation

> **Note:** The NPM package must be installed to use the githook-driven formatters. The Composer package is optional — it provides a `pretty:format:php` script shortcut and copies `pint.json` during init.

This package is designed to work in Linux and OSX environments. Windows is not supported at this time.

### NPM

```sh
npm install --save-dev @lform/pretty-code
```

### Composer (optional)

```sh
composer require --dev lform/pretty-code
```

## Initialization

Once the package is installed, run the initialization command to scaffold the project.

If a config file already exists, the init script will copy the package version alongside it as `{filename}.suggestions.{ext}` (e.g. `.prettierrc.suggestions.json`) for manual review and merging.

Commit all new files and changes to git once everything is confirmed working.

### NPM

```sh
npx pretty-code init
```

Copies `.lintstagedrc.json`, `.prettierrc.json`, `.prettierignore`, `.editorconfig`, and `.githooks/` to the project root, configures `core.hooksPath`, and adds `pretty:format`, `pretty:check`, and `pretty:format:php` scripts to `package.json`.

### Composer (optional)

```sh
vendor/bin/pretty-code init
```

Copies `pint.json` to the project root and adds a `pretty:format:php` script to `composer.json`.

## Commands

```sh
# Prettier — formats JS, CSS, HTML, Blade, Antlers, JSON, YAML, etc.
npm run pretty:format

# Check formatting without writing (useful in CI)
npm run pretty:check

# Pint — formats PHP files
npm run pretty:format:php

# Pint via Composer
composer pretty:format:php
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

| File | Copied by |
|---|---|
| `.prettierrc.json` | NPM init |
| `.prettierignore` | NPM init |
| `.lintstagedrc.json` | NPM init |
| `.editorconfig` | NPM init |
| `.githooks/` | NPM init |
| `pint.json` | Composer init |
| `.php-cs-fixer.php` | — (baseline reference, not copied) |

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

### OSX: `realpath` not found

The initialization scripts require `realpath`, which may be missing on OSX. Install via Homebrew:

```sh
brew install coreutils
```

## Uninstalling

1. Delete any config files copied to the project root
2. Delete the `.githooks` directory
3. Run `git config core.hooksPath .git/hooks`
4. Run `npm remove @lform/pretty-code`
5. Run `composer remove lform/pretty-code` (if installed)
6. Remove the `pretty:format`, `pretty:check`, and `pretty:format:php` scripts from `package.json` and `composer.json`

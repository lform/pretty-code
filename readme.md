# Pretty Code

**Pretty Code** is a githook-driven collection of formatter configurations for PHP, CSS, HTML, and JavaScript. It is designed for both **Roots Bedrock + Sage** and **Statamic** projects, both of which include Laravel Pint as a Composer dev dependency.

When this package is updated, running `npm update` will pull in the latest configuration changes, minus anything you've overridden in your project.

### Table of Contents

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Initialization](#initialization)
4. [Commands](#commands)
5. [Customization per Project](#customization-per-project)

## Requirements

* Environments: OSX, Linux, WSL
* PHP 8.1+
* Node 20+
* Laravel Pint (included in Bedrock/Sage and Statamic — no separate install needed)

## Installation

> IMPORTANT: The NPM part of the package must be installed to use the githook-driven formatters. The Composer package is optional — it provides a `format:php` script shortcut and the `.php-cs-fixer.php` baseline config.

This package is designed to work in Linux and OSX environments. Windows is not supported at this time.

### NPM Installation

```sh
npm install --save-dev @lform/pretty-code
```

### Composer Installation (optional)

```sh
composer require --dev lform/pretty-code
```

## Initialization

Once the package is installed, run the initialization commands to scaffold the project.

Commit all new files and changes to git once everything is confirmed working.

### NPM Initialization

```sh
npx pretty-code init
```

### Composer Initialization (optional)

```sh
vendor/bin/pretty-code init
```

### Initialization Steps (Manual Alternative)

1. Copy `.lintstagedrc.json` to the project root (if it doesn't already exist)
2. Copy `.prettierrc.json` to the project root (if it doesn't already exist)
3. Copy `.prettierignore` to the project root (if it doesn't already exist)
4. Copy `pint.json` to the project root (if it doesn't already exist)
5. Copy `.editorconfig` to the project root (if it doesn't already exist)
6. Copy the `.githooks` directory to the project root (if it doesn't already exist)
7. Configure the project git repo `core.hooksPath` to use the `.githooks` directory
8. Add `pretty:format`, `pretty:check`, and `pretty:format:php` scripts to `package.json`

For Composer, initialization adds a `pretty:format:php` script shortcut to `composer.json`.

### Troubleshooting

#### Disconnecting & Reconnecting the Automations

If you need to disable or re-enable the automated git hooks:

```sh
# Disable automations:
git config core.hooksPath ".git/hooks"

# Re-enable automations:
git config core.hooksPath ".githooks"
```

#### OS Issues

On OSX, you may need to install `coreutils` since the initialization scripts use the `realpath` command:

```sh
brew install coreutils
```

### Uninstalling

1. Delete any custom formatter configs copied to the project root
2. Delete the `.githooks` directory
3. Run `git config core.hooksPath .git/hooks`
4. Run `npm remove @lform/pretty-code`
5. Run `composer remove lform/pretty-code` (if installed)
6. Remove the `format` scripts from `package.json` and `composer.json`

## Formatters

- [Pint](https://laravel.com/docs/pint) — PHP formatting (included in Bedrock/Sage and Statamic)
- [Prettier](https://prettier.io/) — JS, CSS, HTML, Blade, Antlers, and more

## Supported File Types

- antlers.html
- antlers.php
- blade.php
- css
- html, htm
- js
- jsx
- json
- pcss
- php
- scss
- ts
- tsx
- yaml, yml

## Commands

### Format

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

## Customization Per Project

To customize the formatters per project:

1. Copy the specific configuration files from the Pretty Code package root to the project root. Only copy the ones you need — these will no longer receive updates via the package manager.
2. Modify the copied configuration files as needed.
3. The formatters will automatically pick up configuration files in the project root directory.

To undo customizations, delete the project-level config files and they will fall back to the package defaults.

## Configuration Files

- `.prettierrc.json`
- `.prettierignore`
- `pint.json`
- `.php-cs-fixer.php` (baseline reference — not used by default, Pint is preferred)

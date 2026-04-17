# Pretty Code

**Pretty Code** enforces consistent code formatting across all your projects automatically on commit. It provides a single source of truth for Prettier and Laravel Pint configurations, designed for **Roots Bedrock + Sage** and **Statamic** projects.

## Table of Contents

1. [Requirements](#requirements)
2. [Installation & Setup](#installation--setup)
3. [Commands](#commands)
4. [Updating](#updating)
5. [PHP Formatting](#php-formatting)
6. [Supported File Types](#supported-file-types)
7. [Configuration Files](#configuration-files)
8. [Customization per Project](#customization-per-project)
9. [Troubleshooting](#troubleshooting)
10. [Uninstalling](#uninstalling)

## Requirements

- Environments: OSX, Linux, WSL, Windows
- Node 20+
- PHP 8.1+ (for PHP formatting)

## Installation & Setup

### Installation

```sh
npm install --save-dev @lform/pretty-code
```

After installing, the package prints a reminder to run the init command.

### Initialization

```sh
npx pretty-code init
```

Run the init command to scaffold the project. It copies the following config files to the project root, configures git hooks, and adds `pretty:format`, `pretty:format:prettier`, `pretty:format:pint`, and `pretty:check` scripts to `package.json`:

- `.prettierrc.json`, `.prettierignore`
- `.lintstagedrc.json`
- `.editorconfig`
- `.githooks/`
- `pint.json`

Existing config files are overwritten — use `git diff` to review changes before committing. Pass `--suggest` to write new configs as suggestion files alongside your existing ones instead. In `--suggest` mode, Pretty Code does not update your git hooks path or rewrite `package.json` scripts:

```sh
npx pretty-code init --suggest
```

This writes:

- `.lintstagedrc.suggestions.json`
- `.prettierrc.suggestions.json`
- `.prettierignore.suggestions`
- `.editorconfig.suggestions`
- `pint.suggestions.json`
- `.githooks.suggestions/`

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

When a new version of Pretty Code is released, update the package then run:

```sh
npm update @lform/pretty-code
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

4. Update the `pretty:format:pint` script in `package.json`:

```json
"pretty:format:pint": "vendor/bin/php-cs-fixer fix"
```

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

To customize formatting for a specific project, copy the relevant config file from `node_modules/@lform/pretty-code/` to the project root and modify it as needed. Only copy what you need — copied files will no longer receive updates from the package manager.

To undo a customization, delete the project-level config file and it will fall back to the package default.

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
5. Remove the `pretty:format`, `pretty:format:prettier`, `pretty:format:pint`, and `pretty:check` scripts from `package.json`

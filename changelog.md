# Changelog

All notable changes to this project will be documented in this file.

## [2.0.1] — 2026-04-17

### Added
- Node.js init script replaces bash scripts — no more `realpath` dependency or macOS Homebrew workaround required
- `update` subcommand (`npx pretty-code update`) pulls in the latest config files and overwrites existing ones for review via `git diff`
- `--suggest` flag for both `init` and `update` — writes configs as `.suggestions.*` files instead of overwriting, for projects that prefer manual merging
- `postinstall` hook prints a setup reminder after `npm install`
- `pretty:format:prettier` script (Prettier only)
- `pretty:format:pint` script (Pint only)
- `pretty:format` now runs both formatters in sequence

### Changed
- Config files are overwritten by default during `init` and `update` — use `git diff` to review changes
- `pint.json` is now copied during `npx pretty-code init` (previously required the Composer package)
- Renamed `pretty:format:php` to `pretty:format:pint`

### Removed
- Composer package (`lform/pretty-code`) — the npm package now handles everything
- Bash init scripts (`bin/npm/pretty-code`, `bin/composer/pretty-code`)

---

## [2.0.0] — 2026-04-17

Major refactor replacing ESLint and Stylelint with Prettier as the primary formatter.

### Added
- Prettier as the primary formatter for JS, CSS, HTML, JSON, YAML, Blade, and Antlers
- `prettier-plugin-blade` for Laravel Blade formatting
- `prettier-plugin-tailwindcss` for Tailwind CSS class ordering
- `pint.json` configuration for Laravel Pint
- `.php-cs-fixer.php` baseline config included as a reference (not copied during init)
- Suggestions file behavior during `init` — existing configs are not overwritten

### Changed
- Init script rewrites `package.json` scripts using `npm pkg set`
- Updated `.prettierrc.json` with file-specific overrides for Blade, Antlers, HTML, and YAML
- Updated `.prettierignore` to exclude minified files, build artifacts, and CMS directories
- Updated `.editorconfig` with per-language indentation overrides

### Removed
- ESLint configuration and dependency
- Stylelint configuration and dependency

---

## [1.2.0] — 2025-08-26

### Changed
- Stylelint: removed warning for underscores in SCSS includes to avoid build issues in Vite and Statamic environments
- Linter initialization moved out of the `init` command — linters are no longer automatically wired up during project setup

---

## [1.1.4] — 2024-06-11

### Fixed
- Corrected file paths in `.lintstagedrc.json`

---

## [1.1.3] — 2024-06-11

### Fixed
- Corrected file paths in `.lintstagedrc.json`
- Updated README with instructions for disconnecting and reconnecting the git hook

---

## [1.1.2] — 2024-06-11

### Fixed
- Increased ESLint `max-nested-callbacks` limit to resolve errors on valid code

---

## [1.1.1] — 2024-05-22

### Added
- Antlers support via `prettier-plugin-antlers` (`.antlers.html`, `.antlers.php`)
- Lock files (`*-lock.json`) added to `.prettierignore`

### Fixed
- ESLint `arrow-parens` rule set to `always` for consistency
- Resolved variable name bug in npm bin script

---

## [1.1.0] — 2024-05-20

### Added
- `.editorconfig` is now copied during `init`
- Antlers (`.antlers.html`, `.antlers.php`) added to lint-staged rules
- YAML added to `.editorconfig`

### Changed
- Lint-staged: formats before linting, removed JSON-specific linting, consolidated file rules
- All `node_modules/.bin` references updated to use `npx`
- Script commands made less opinionated — glob patterns removed in favor of directory-level targeting

---

## [1.0.1] — 2024-05-10

### Added
- README with installation, usage, and uninstall instructions
- License added to Composer package
- Uninstall steps documented

### Changed
- Package renamed to `pretty-code`
- Command prefixes updated for consistency
- Consistent JSON and YAML support across formatters

### Fixed
- Incorrect variable reference in bash init script
- Composer version requirement corrected

---

## [1.0.0] — 2024-05-01

Initial release.

### Added
- Bash-based `init` script for npm and Composer
- Prettier configuration (`.prettierrc.json`, `.prettierignore`)
- ESLint configuration
- Stylelint configuration
- Lint-staged configuration (`.lintstagedrc.json`)
- Pre-commit git hook via `.githooks/`
- Dual npm + Composer package

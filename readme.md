# Pretty Code

**Pretty Code** is a githook-driven collection of linter & formatter configurations for PHP, CSS, HTML, and JavaScript. It is also designed for per-project customization, which is useful when dealing with older, unconventional, or problematic code bases.

When this package is updated, running `composer update` or `npm update` will pull in the latest configuration changes, minus anything you've overridden in your project. This allows for easy updates to the configuration without having to manually update files.


### Table of Contents

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Initialization](#initialization)
4. [Commands](#commands)
5. [Customization per Project](#customization-per-project)


## Requirements

* Environments: OSX, Linux, WSL
* PHP 7.4+
* Node 20+

## Installation

> IMPORTANT: The NPM part of the package must be installed to use the githook-driven linters and formatters. That is the case for PHP as well, regardless of whether you are using the Composer package.

This package is designed to work in Linux and OSX environments. Windows is not supported at this time.

### NPM Installation

This installs the frontend part of the package as well as the githook-driven automations.

```sh
npm install --save-dev @lform/pretty-code
```

### Composer Installation

This installs the PHP part of the package.

```sh
composer require --dev lform/pretty-code
```

## Initialization

Once the packages are installed, the package has to be initialized via `npm` to do a few things:

1. Copy a `.lintstagedrc.json` config to the project root, if it does not already exist
2. Copy a preconfigured `.githooks` directory to the project root to trigger the git automations. If the directory already exists, the initialization script will not overwrite it.
3. Copy a `.editorconfig` config to the project root, if it does not already exist
4. Configure the project git repo `core.hooksPath` to use the new `.githooks` directory.
5. Add new scripts in `package.json` to run the linters and formatters manually.

For Composer, initialization will just add the new scripts to `composer.json` to run the linters and formatters manually.

Afterward, these new files & changes should be committed to git once everything is confirmed working. Read below for how to initialize the package.

### NPM Initialization

```sh
node_modules/.bin/pretty-code init
```

### Composer Initialization

```sh
vendor/bin/pretty-code init
```

### Troubleshooting

**NOTE**: On OSX, you may also need to install `coreutils` since the initialization scripts use the `realpath` command. If you see errors related to this, run the following:

```sh
brew install coreutils
```

### Uninstalling

To remove the package: 
 
1. Delete any custom linter or formatter configs from the project root
2. Delete the `.githooks` directory
3. Run `git config core.hooksPath .git/hooks`
4. Run `npm remove @lform/pretty-code`
5. Run `composer remove lform/pretty-code`
6. Remove the `pretty` scripts from `composer.json` and `package.json`

## Linters & Formatters

### Linters

- [ESLint](https://eslint.org/)
- [linthtml](https://linthtml.vercel.app/)
- [PHPStan](https://phpstan.org/)
- [StyleLint](https://stylelint.io/)

### Formatters

- [PHP CS Fixer](https://cs.symfony.com/)
  - Configured for PHP 8.3, for 7.4 support, copy the configuration into your project and customize it.
- [Prettier](https://prettier.io/)

## Supported File Types

> L = Linted, F = Formatted

- antlers.html (F)
- antlers.php (F)
- blade.php (F)
- css (LF)-
- html, htm (LF)
- js (LF)
- jsx (LF)
- json (F)
- pcss (LF)
- php (LF)
- scss (LF)
- ts (LF)
- tsx (LF)
- twig (F)
- yaml, yml (LF)

## Commands

### Formatters

```sh
# Runs Prettier (css, scss, pcss, js, jsx, ts, tsx, json, html, htm, twig, blade.php, yml, yaml)
npm run pretty:format <path>

# Runs PHP-CS-Fixer (php)
composer pretty:format <path>
```

### Linters

```sh
# Runs StyleLint (css, scss, pcss)
npm run pretty:lint:css <path>

# Runs ESLint (js, jsx, ts, tsx, json)
npm run pretty:lint:js <path>

# Runs linthtml (html, htm)
npm run pretty:lint:html <path>

# Runs PHPStan (php)
composer pretty:lint <path>
```

## Customization Per Project

To customize the linters and formatters per project:

1. Copy the specific configuration files that need to be modified from the Pretty Code package root to the project root. Only copy the configurations that you need, these custom configs will no longer get updated via the package management system.
2. Modify the copied configuration files as needed.
3. Open the `.lintstagedrc.json` file and remove the explicit config-file paths or ignore-file paths from the respective linters or formatters being adjusted.
4. Do the same thing for the `package.json` and `composer.json` scripts as applicable.
5. The linters and formatters with project-based configs will automatically use the configuration files from the project root directory.

To undo these changes, just delete the configurations and restore the original scripts by referencing the package's `package.json` and `composer.json` files.

## Configuration Files

- `.prettierrc.json`
- `.prettierignore`
- `stylelint.json`
- `stylelintignore`
- `.eslintrc.json`
- `.eslintignore (if applicable)`
- `.linthtmlrc.json`

## Todos

1. Add github workflows
2. Add tailwind linter
3. Add antlers formatter + linter (if possible) 
4. Add windows support

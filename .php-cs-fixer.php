<?php

use PhpCsFixer\{Config,Finder};

$finder = (new Finder())
    ->notName([
        '_ide_helper_actions.php',
        '_ide_helper_models.php',
        '_ide_helper.php',
        '.phpstorm.meta.php',
        '*.blade.php',
    ])
    ->exclude([
        'vendor',
        'node_modules',
        'storage',
        'cache',
        'wp-includes',
        'wp-admin',
    ])
    ->ignoreDotFiles(true)
    ->ignoreVCS(true)
    ->in(getcwd())
    ->name('*.php');

return (new Config())
    ->setRules([
        '@PHP83Migration' => true,
        '@PhpCsFixer' => true,
        '@PSR1' => true,
        '@PSR12' => true,
        'echo_tag_syntax' => [
            'format' => 'short',
			'long_function' => 'echo',
			'shorten_simple_statements_only' => true
        ],
        "group_import" => true,
        'multiline_whitespace_before_semicolons' => [
            'strategy'=>'no_multi_line'
        ],
        'no_alternative_syntax' => false,
        "single_import_per_statement" => false,
        'yoda_style' => false
    ])
    ->setIndent("\t")
    ->setLineEnding("\n")
    ->setUsingCache(true)
    ->setFinder($finder);

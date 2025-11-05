<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/app',
    ])
    ->name('*.php')
    ->exclude('vendor')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'no_unused_imports' => true,
        'single_quote' => true,
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        'blank_line_before_statement' => ['statements' => ['return']],
        'phpdoc_order' => true,
    ])
    ->setFinder($finder);

<?php

return (new PhpCsFixer\Config('SITE'))
    ->setUsingCache(true)
    ->setCacheFile(__DIR__ . '/.php-cs-fixer.cache')
    ->setRules(
        [
            '@Symfony' => true,
            '@PSR12' => true,
            'yoda_style' => false,
            'linebreak_after_opening_tag' => true,
            'phpdoc_no_package' => false,
            'single_quote' => false,
            'no_superfluous_phpdoc_tags' => false,
            'array_syntax' => ['syntax' => 'short'],
            'no_unused_imports' => true,
            'ordered_imports' => false,
            'phpdoc_indent' => true,
            'phpdoc_align' => ['align' => 'left'],
            'no_useless_else' => true,
            'phpdoc_order' => false,
            'array_indentation' => true,
            'escape_implicit_backslashes' => false,
            'global_namespace_import'=> ['import_functions'=> true],
            'concat_space' => ['spacing' => 'one'],
            'phpdoc_summary' => false,
            'phpdoc_to_comment' => false,
            'single_line_throw' => false,
            'nullable_type_declaration_for_default_null_value' => true,
            'increment_style' => false,
            'blank_line_before_statement' => false,
            'single_space_after_construct' => false,
            'no_alias_language_construct_call' => false,
            'no_extra_blank_lines' => true,
            'compact_nullable_typehint' => true,
            'phpdoc_tag_type' => false,
            'fully_qualified_strict_types' => false,
            'echo_tag_syntax' => false,
            'integer_literal_case' => false, // TODO enabled by default in @Symfony
            'types_spaces' => ['space' => 'single'],
        ]
    )
    ->setFinder(PhpCsFixer\Finder::create()->exclude(__DIR__ . '/vendor')->in(__DIR__ . '/'));

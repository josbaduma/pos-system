<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Squiz\Sniffs\PHP\CommentedOutCodeSniff;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Worksome\CodingStyle\Sniffs\Comments\DisallowTodoCommentsSniff;
use Worksome\CodingStyle\Sniffs\Laravel\ConfigFilenameKebabCaseSniff;
use Worksome\CodingStyle\Sniffs\Laravel\DisallowHasFactorySniff;
use Worksome\CodingStyle\WorksomeEcsConfig;

return static function (ECSConfig $ecsConfig): void {
    $ecsConfig->paths([
        __DIR__ . '/app',
        __DIR__ . '/tests',
        __DIR__ . '/config',
    ]);
    $ecsConfig->skip([
        ConfigFilenameKebabCaseSniff::class,
        DisallowHasFactorySniff::class,
        CommentedOutCodeSniff::class,
        DisallowTodoCommentsSniff::class,
    ]);
    WorksomeEcsConfig::setup($ecsConfig);
};

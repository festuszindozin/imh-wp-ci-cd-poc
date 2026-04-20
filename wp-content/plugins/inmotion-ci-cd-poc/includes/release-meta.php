<?php

declare(strict_types=1);

/**
 * Single source of truth for the visible release string on the site.
 * Bump this when you want a clear “deployment worked” signal in production.
 */
function inmotion_ci_cd_poc_version(): string
{
    return '1.0.0';
}

/**
 * Short build fingerprint (written at deploy time in GitHub Actions, commit prefix in CI, or “local”).
 */
function inmotion_ci_cd_poc_build_id(): string
{
    $file = __DIR__ . '/deploy-build.txt';
    if (is_readable($file)) {
        $raw = preg_replace('/[^a-f0-9]/i', '', (string) file_get_contents($file));
        if ($raw !== '') {
            return substr($raw, 0, 7);
        }
    }

    $env = getenv('GITHUB_SHA');
    if (is_string($env) && $env !== '') {
        return substr($env, 0, 7);
    }

    return 'local';
}

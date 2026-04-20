<?php

/**
 * Plugin Name: InMotion CI/CD PoC
 * Description: Minimal plugin used to demonstrate GitHub Actions → production deploy on InMotion Cloud.
 * Version: 1.0.0
 * Author: InMotion Hosting (PoC)
 * License: GPLv2 or later
 */

declare(strict_types=1);

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/includes/release-meta.php';

/**
 * Visible proof on the public site that the deployed build matches the pipeline.
 */
function inmotion_ci_cd_poc_site_footer_note(): void
{
    if (is_admin()) {
        return;
    }

    $version = esc_html(inmotion_ci_cd_poc_version());
    $build = esc_html(inmotion_ci_cd_poc_build_id());

    echo '<p class="inmotion-ci-cd-poc-note" style="text-align:center;font-size:12px;opacity:0.85;margin:2rem 0;">'
        . 'CI/CD PoC — release '
        . $version
        . ' (build '
        . $build
        . ')</p>';
}

add_action('wp_footer', 'inmotion_ci_cd_poc_site_footer_note');

/**
 * Admin-only reminder that the plugin is active (helpful while setting up the article screenshots).
 */
function inmotion_ci_cd_poc_admin_notice(): void
{
    if (!current_user_can('manage_options')) {
        return;
    }

    $version = esc_html(inmotion_ci_cd_poc_version());
    $build = esc_html(inmotion_ci_cd_poc_build_id());

    echo '<div class="notice notice-info"><p>'
        . 'InMotion CI/CD PoC plugin is active. Release <strong>'
        . $version
        . '</strong>, build <code>'
        . $build
        . '</code>.</p></div>';
}

add_action('admin_notices', 'inmotion_ci_cd_poc_admin_notice');

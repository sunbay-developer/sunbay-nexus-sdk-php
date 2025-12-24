<?php

declare(strict_types=1);

namespace Sunmi\Sunbay\Nexus\Util;

/**
 * User-Agent utility for building SDK User-Agent string
 *
 * @author Andy Li
 * @since 2025-01-20
 */
class UserAgentUtil
{
    private const PACKAGE_NAME = 'sunmi/sunbay-nexus-sdk-php';
    private const USER_AGENT_PREFIX = 'SunbayNexusSDK-PHP';

    /**
     * Get SDK version dynamically
     * Priority:
     * 1. Git tag via git command (for development environment, most accurate)
     * 2. Composer\InstalledVersions (for installed packages, Composer 2.0+)
     * 3. vendor/composer/installed.php (fallback for installed packages, Composer 1.x)
     * 4. Fallback to 'dev' if version cannot be determined
     *
     * @return string SDK version
     */
    public static function getSdkVersion(): string
    {
        // Try reading Git tag (for development environment)
        // This is most accurate as it matches the actual Git tag
        // Find .git directory by traversing up from current file
        $gitDir = null;
        $currentDir = __DIR__;
        for ($i = 0; $i < 10; $i++) {
            $potentialGitDir = $currentDir . '/.git';
            if (is_dir($potentialGitDir)) {
                $gitDir = $potentialGitDir;
                break;
            }
            $parentDir = dirname($currentDir);
            if ($parentDir === $currentDir) {
                break; // Reached filesystem root
            }
            $currentDir = $parentDir;
        }
        
        if ($gitDir !== null && is_dir($gitDir)) {
            try {
                // Try reading from .git/refs/tags directly (most reliable, no shell_exec needed)
                $refsDir = $gitDir . '/refs/tags';
                if (is_dir($refsDir)) {
                    $tags = [];
                    $iterator = new \RecursiveIteratorIterator(
                        new \RecursiveDirectoryIterator($refsDir, \RecursiveDirectoryIterator::SKIP_DOTS),
                        \RecursiveIteratorIterator::SELF_FIRST
                    );
                    foreach ($iterator as $file) {
                        if ($file->isFile()) {
                            $tagName = str_replace($refsDir . '/', '', $file->getPathname());
                            // Handle nested tags (e.g., v1.0.4)
                            $tagName = str_replace('/', '', $tagName);
                            if ($tagName !== '' && $tagName !== '0') {
                                $tags[] = $tagName;
                            }
                        }
                    }
                    if (!empty($tags)) {
                        // Sort tags by version (natural sort)
                        usort($tags, function ($a, $b) {
                            // Remove 'v' prefix for comparison
                            $aClean = (strpos($a, 'v') === 0) ? substr($a, 1) : $a;
                            $bClean = (strpos($b, 'v') === 0) ? substr($b, 1) : $b;
                            return version_compare($bClean, $aClean);
                        });
                        $latestTag = $tags[0];
                        // Remove 'v' prefix if present
                        if (strpos($latestTag, 'v') === 0) {
                            $latestTag = substr($latestTag, 1);
                        }
                        return $latestTag;
                    }
                }
                // Fallback: try git command (if shell_exec is enabled)
                if (function_exists('shell_exec')) {
                    $repoRoot = dirname($gitDir);
                    $gitCommand = 'cd ' . escapeshellarg($repoRoot) . ' && git describe --tags --abbrev=0 2>/dev/null';
                    $output = @shell_exec($gitCommand);
                    if ($output !== null && $output !== false) {
                        $tag = trim($output);
                        if ($tag !== '' && $tag !== '0') {
                            // Remove 'v' prefix if present
                            if (strpos($tag, 'v') === 0) {
                                $tag = substr($tag, 1);
                            }
                            return $tag;
                        }
                    }
                }
            } catch (\Exception $e) {
                // Fall through to next method
            }
        }

        // Try Composer\InstalledVersions (for installed packages, Composer 2.0+)
        if (class_exists(\Composer\InstalledVersions::class)) {
            try {
                $version = \Composer\InstalledVersions::getVersion(self::PACKAGE_NAME);
                if ($version !== null && $version !== '') {
                    // Normalize version: remove 'dev-' prefix and '@' suffix if present
                    $version = preg_replace('/^dev-/', '', $version);
                    $version = preg_replace('/@.*$/', '', $version);
                    return $version;
                }
            } catch (\Exception $e) {
                // Fall through to next method
            }
        }

        // Try reading from vendor/composer/installed.php (for installed packages, Composer 1.x)
        $installedFile = __DIR__ . '/../../../../vendor/composer/installed.php';
        if (file_exists($installedFile)) {
            try {
                $installed = require $installedFile;
                // Handle both Composer 1.x and 2.x formats
                if (isset($installed['versions'][self::PACKAGE_NAME]['version'])) {
                    $version = $installed['versions'][self::PACKAGE_NAME]['version'];
                    // Normalize version
                    $version = preg_replace('/^dev-/', '', $version);
                    $version = preg_replace('/@.*$/', '', $version);
                    return $version;
                }
                // Composer 2.x format (packages array)
                if (isset($installed['packages'])) {
                    foreach ($installed['packages'] as $package) {
                        if (isset($package['name']) && $package['name'] === self::PACKAGE_NAME) {
                            if (isset($package['version'])) {
                                $version = $package['version'];
                                // Normalize version
                                $version = preg_replace('/^dev-/', '', $version);
                                $version = preg_replace('/@.*$/', '', $version);
                                return $version;
                            }
                        }
                    }
                }
            } catch (\Exception $e) {
                // Fall through to fallback
            }
        }

        // Fallback
        return 'dev';
    }

    /**
     * Get PHP version
     *
     * @return string PHP version
     */
    public static function getPhpVersion(): string
    {
        return PHP_VERSION;
    }

    /**
     * Get operating system name
     *
     * @return string OS name (e.g., Darwin, Linux, Windows)
     */
    public static function getOsName(): string
    {
        return php_uname('s');
    }

    /**
     * Get operating system version
     *
     * @return string OS version
     */
    public static function getOsVersion(): string
    {
        return php_uname('r');
    }

    /**
     * Build User-Agent string
     * Format: SunbayNexusSDK-PHP/{SDK版本} PHP/{PHP版本} {操作系统}/{系统版本}
     * Example: SunbayNexusSDK-PHP/1.0.4 PHP/8.5.1 Darwin/25.1.0
     *
     * @return string User-Agent string
     */
    public static function buildUserAgent(): string
    {
        $sdkVersion = self::getSdkVersion();
        $phpVersion = self::getPhpVersion();
        $osName = self::getOsName();
        $osVersion = self::getOsVersion();

        return sprintf(
            '%s/%s PHP/%s %s/%s',
            self::USER_AGENT_PREFIX,
            $sdkVersion,
            $phpVersion,
            $osName,
            $osVersion
        );
    }
}


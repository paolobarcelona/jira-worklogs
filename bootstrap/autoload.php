<?php
declare(strict_types=1);
/**
 * Require autoload.php in given dir if it exists, and return if it's been required.
 *
 * @param string $dir
 *
 * @return bool
 */
function requireIfExists(string $dir): bool
{
    $filename = $dir . 'autoload.php';
    if (\file_exists($filename) === false) {
        return false;
    }
    require_once $filename;

    // Define constant to be used as a fallback if binaries not found within inspected project
    define('PHPCIRCLE_VENDOR_DIR', $dir);

    return true;
}

$asProject = __DIR__ . '/../vendor/';
$asDependency = __DIR__ . '/../../../';
if ((\requireIfExists($asProject) || \requireIfExists($asDependency)) === false) {
    echo 'No autoload file found - PHPCircle';
    exit(1);
}

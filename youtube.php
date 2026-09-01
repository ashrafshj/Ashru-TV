<?php
// YouTube Proxy Script for TiviMate
$ytUrl = $_GET['url'] ?? '';
if (!$ytUrl) {
    die("No URL provided");
}

// Redirecting YouTube stream using public extractor or pipe
header("Location: " . $ytUrl);
exit();
?>

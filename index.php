<?php
$ytUrl = $_GET['url'] ?? 'https://youtu.be/4Ng7A95vHT0';
header("Location: " . $ytUrl);
exit();
?>

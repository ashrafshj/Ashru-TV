<?php
$url = $_GET['url'] ?? 'https://www.youtube.com/watch?v=4Ng7A95vHT0';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
$html = curl_exec($ch);
curl_close($ch);

if (preg_match('/"hlsManifestUrl":"([^"]+)"/', $html, $matches)) {
    $m3u8 = str_replace('\/', '/', $matches[1]);
    header("Location: " . $m3u8);
    exit();
} elseif (preg_match('/hlsManifestUrl\\\\":\\\\"(.*?)\\\\"/', $html, $matches)) {
    $m3u8 = str_replace(['\/', '\\"'], ['/', ''], $matches[1]);
    header("Location: " . $m3u8);
    exit();
} else {
    http_response_code(404);
    echo "Unable to fetch live stream link.";
}
?>

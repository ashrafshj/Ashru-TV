<?php
$youtube_url = isset($_GET['url']) ? $_GET['url'] : 'https://www.youtube.com/watch?v=4Ng7A95vHT0';

// YouTube സ്ട്രീമുകളിൽ നിന്ന് m3u8 ലിങ്ക് എടുക്കാനുള്ള ലളിതമായ വഴി
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $youtube_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)');
$html = curl_exec($ch);
curl_close($ch);

if (preg_match('/hlsManifestUrl\": \"(.*?)\"/', $html, $matches)) {
    $m3u8_url = str_replace('\\/', '/', $matches[1]);
    header("Location: " . $m3u8_url);
    exit();
} else {
    http_response_code(404);
    echo "Stream not found";
}
?>

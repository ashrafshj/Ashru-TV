<?php
$url = $_GET['url'] ?? 'https://www.youtube.com/watch?v=4Ng7A95vHT0';

// YouTube Page HTML ഫെച്ച് ചെയ്യുന്നു
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
$html = curl_exec($ch);
curl_close($ch);

// m3u8 ലിങ്ക് കണ്ടെത്തുന്നു
if (preg_match('/hlsManifestUrl\": \"(.*?)\"/', $html, $matches) || preg_match('/"hlsManifestUrl":"([^"]+)"/', $html, $matches)) {
    $m3u8 = str_replace(['\/', '\\"'], ['/', ''], $matches[1]);

    // m3u8 കണ്ടന്റ് എടുത്തു പ്ലെയറിലേക്ക് പാസ്സ് ചെയ്യുന്നു
    header("Content-Type: application/vnd.apple.mpegurl");
    $stream = file_get_contents($m3u8);
    echo $stream;
    exit();
} else {
    http_response_code(404);
    echo "Stream not found";
}
?>

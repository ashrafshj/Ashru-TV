<?php
$url = $_GET['url'] ?? 'https://www.youtube.com/watch?v=4Ng7A95vHT0';

// YouTube m3u8 extract ചെയ്യാനുള്ള പൊതുവായ API വഴി
$apiUrl = "https://pipe-m3u8.vercel.app/api?url=" . urlencode($url);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$m3u8 = trim(curl_exec($ch));
curl_close($ch);

if (!empty($m3u8) && filter_var($m3u8, FILTER_VALIDATE_URL)) {
    header("Location: " . $m3u8);
    exit();
} else {
    // ആൾട്ടർനേറ്റീവ് API വഴി
    $altApi = "https://yt-m3u8.onrender.com/live?url=" . urlencode($url);
    header("Location: " . $altApi);
    exit();
}
?>

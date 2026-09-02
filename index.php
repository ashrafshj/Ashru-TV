<?php
$url = $_GET['url'] ?? 'https://www.youtube.com/watch?v=4Ng7A95vHT0';

// YouTube video ID എക്സ്ട്രാക്റ്റ് ചെയ്യുന്നു
preg_match('/(?:v=|\/embed\/|\/1\/|\/v\/|https:\/\/youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
$id = $matches[1] ?? '4Ng7A95vHT0';

// ഡയറക്ട് M3U8 API ഉപയോഗിക്കുന്നു
$m3u8 = "https://youtube-live-stream-api.vercel.app/live/" . $id . ".m3u8";

header("Location: " . $m3u8);
exit();
?>

<?php
// spielstand.php — Cloud-Speicher für "Hannas Mathe-Königreich".
// GET  -> liefert den gespeicherten Spielstand (oder null)
// POST -> speichert den Spielstand (JSON)
// Ablage bevorzugt in /data (Coolify-Volume, überlebt Redeploys),
// sonst im eigenen Verzeichnis (klassischer Webspace).
header('Content-Type: application/json');
header('Cache-Control: no-store');

$dir  = (is_dir('/data') && is_writable('/data')) ? '/data' : __DIR__;
$file = $dir . '/spielstand-hanna.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = file_get_contents('php://input');
    if (strlen($body) > 100000) { http_response_code(413); echo '{"ok":false}'; exit; }
    $data = json_decode($body, true);
    if (is_array($data) && isset($data['gems'])) {
        file_put_contents($file, json_encode($data), LOCK_EX);
        echo '{"ok":true}';
    } else {
        http_response_code(400);
        echo '{"ok":false}';
    }
} else {
    echo file_exists($file) ? file_get_contents($file) : 'null';
}

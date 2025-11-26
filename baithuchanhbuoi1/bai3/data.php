<?php
$csvPath = __DIR__ . '/65HTTT_Danh_sach_diem_danh.csv';
$students = [];

if (!file_exists($csvPath)) {
    die('Lỗi: Không tìm thấy file: ' . basename($csvPath));
}

$handle = fopen($csvPath, 'r');
if ($handle === false) {
    die('Lỗi: Không thể mở file CSV');
}
$headers = fgetcsv($handle);
if ($headers === false) {
    fclose($handle);
    die('Lỗi: File CSV rỗng hoặc không hợp lệ');
}

foreach ($headers as $i => $h) { $headers[$i] = trim($h); }

while (($row = fgetcsv($handle)) !== false) {
    $row = array_map('trim', $row);
    $record = [];
    for ($i = 0; $i < count($headers); $i++) {
        $key = $headers[$i];
        $record[$key] = isset($row[$i]) ? $row[$i] : '';
    }
    $students[] = $record;
}

fclose($handle);
function get_students() {
    global $students;
    return $students;
}

?>

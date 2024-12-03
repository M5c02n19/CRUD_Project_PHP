<?php
// ฟังก์ชันอ่านข้อมูลจาก CSV
function readCSV($filename) {
    $rows = [];
    if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $rows[] = $data;
        }
        fclose($handle);
    }
    return $rows;
}

// ตรวจสอบการ Login
function login($username, $password) {
    $users = readCSV('data/users.csv');
    foreach ($users as $user) {
        if ($user[0] === $username && $user[1] === $password) {
            return true;
        }
    }
    return false;
}
?>
<?php
// อ่านข้อมูล CRUD
function readRecords($username) {
    $records = readCSV('data/records.csv');
    $userRecords = [];

    foreach ($records as $record) {
        if ($record[1] === $username) { // แยกตาม username
            $userRecords[] = $record;
        }
    }

    return $userRecords;
}

// เพิ่มข้อมูล
function createRecord($username, $title, $content) {
    $records = readCSV('data/records.csv');
    $id = count($records); // ใช้จำนวนแถวเป็น ID

    $newRecord = [$id, $username, $title, $content];
    $file = fopen('data/records.csv', 'a');
    fputcsv($file, $newRecord);
    fclose($file);
}

// อัปเดตข้อมูล
function updateRecord($id, $username, $title, $content) {
    $records = readCSV('data/records.csv');
    $file = fopen('data/records.csv', 'w');

    foreach ($records as &$record) {
        if ($record[0] == $id && $record[1] == $username) {
            $record = [$id, $username, $title, $content];
        }
        fputcsv($file, $record);
    }
    fclose($file);
}

// ลบข้อมูล
function deleteRecord($id, $username) {
    $records = readCSV('data/records.csv');
    $file = fopen('data/records.csv', 'w');

    foreach ($records as $record) {
        if ($record[0] != $id || $record[1] != $username) {
            fputcsv($file, $record);
        }
    }
    fclose($file);
}
?>

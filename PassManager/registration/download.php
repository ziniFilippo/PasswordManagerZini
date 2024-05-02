<?php
    $ssl_key = $_GET['key'];
    $mail_id = $_GET['id'];
    $file = './tmp'.$mail_id.'.txt';
    $file_handle = fopen($file, 'wr');
    $text = "KEY=$ssl_key";
    fwrite($file_handle, $text);
    fclose($file_handle);
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    header("Content-Type: text/plain");
    readfile($file);
    unlink($file);
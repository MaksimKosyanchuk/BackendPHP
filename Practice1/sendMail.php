<?php

    $subject = 'Заголовок';
    $firstName = 'Maks';
    $text1 = "Nick name : {$firstName}" . "\n";
    $message = $text1;
    $headers = 'From: m.o.kosianchuk@student.khai.edu';
    mail('m.o.kosianchuk@student.khai.edu', $subject, $message, $headers);
?>
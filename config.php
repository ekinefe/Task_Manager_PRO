<?php
return new PDO(
    'mysql:host=localhost;dbname=task_manager_pro;charset=utf8',
    'root',
    '',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);
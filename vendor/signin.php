<?php

    session_start();
    require_once 'connect.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $error_fields = [];

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_fields[] = 'email';
    }


    if ($password === '') {
        $error_fields[] = 'password';
    }

    if (!empty($error_fields)) {
        $response = [
            "status" => false,
            "type" => 1,
            "message" => "Проверьте правильность полей",
            "fields" => $error_fields
        ];

        echo json_encode($response);

        die();
    }


    if (in_array($email, array_column($kitchen, 'email')) && in_array($password, array_column($kitchen, 'password'))) {



        $_SESSION['user'] = [
            "email" => $email
        ];


        $response = [
            "status" => true
        ];
        $log = date('Y-m-d H:i:s') . ' ' . print_r('Вход в учетную запись '.$email, true);
        file_put_contents('../log.txt', $log . PHP_EOL, FILE_APPEND);
        echo json_encode($response);

    } else {

        $response = [
            "status" => false,
            "message" => 'Ошибка авторизации'
        ];

        $log = date('Y-m-d H:i:s') . ' ' . print_r('Попытка входа в аккаунт '.$email, true);
        file_put_contents('../log.txt', $log . PHP_EOL, FILE_APPEND);

        echo json_encode($response);
    }
    ?>


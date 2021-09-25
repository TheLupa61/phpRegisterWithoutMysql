<?php

    session_start();
    require_once 'connect.php';

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if (in_array($email, array_column($kitchen, 'email'))) {
        $response = [
            "status" => false,
            "type" => 1,
            "message" => "Такой email уже существует",
            "fields" => ['email']
        ];

        $log = date('Y-m-d H:i:s') . ' ' . print_r('Попытка использования ранее зарегистрированого email`а!', true);
        file_put_contents('../log.txt', $log . PHP_EOL, FILE_APPEND);

        echo json_encode($response);
        die();
    }

    $error_fields = [];

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_fields[] = 'email';
    }

    if ($password === '') {
        $error_fields[] = 'password';
    }

    if ($first_name === '') {
        $error_fields[] = 'first_name';
    }

    if ($last_name === '') {
        $error_fields[] = 'last_name';
    }

    if ($password_confirm === '') {
        $error_fields[] = 'password_confirm';
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

    if ($password === $password_confirm) {

        $key = 2;
        $key += 1;
        $kitchen[] = array('id' => $key, 'email' => $email, 'name' => $first_name , 'last_name' => $last_name, 'password' => $password);

        $response = [
                "status" => true,
                "message" => "Регистрация прошла успешно!",
            ];

        $log = date('Y-m-d H:i:s') . ' ' . print_r('Удачная регистрация аккаунта '.$email, true);
        file_put_contents('../log.txt', $log . PHP_EOL, FILE_APPEND);

            echo json_encode($response);

    } else {
        $response = [
            "status" => false,
            "type" => 1,
            "message" => "Пароли не совпадают",
            "fields" => ['password', 'password_confirm']
        ];

        echo json_encode($response);
        die();
    }

?>

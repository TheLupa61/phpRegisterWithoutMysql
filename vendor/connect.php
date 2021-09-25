<?php
    $kitchen = array(array('id' => 1, 'email' => 'test@local.ru', 'name' => 'Денис', 'last_name' => 'К', 'password' => '123'),
                array('id' => 2, 'email' => 'test2@local.ru', 'name' => 'Денис' , 'last_name' => 'К', 'password' => '123')
                );
    if (!$kitchen) {
        die('Error connect');
    }
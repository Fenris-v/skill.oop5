<?php

class UserFormValidation
{
    public function validate(array $data): bool
    {
        if (!isset($data['name']) || !$data['name']) {
            throw new Exception('Вы не ввели свое имя', 1);
        }

        if (!isset($data['age']) || (int)$data['age'] === 0) {
            throw new Exception('Вы не ввели возраст', 2);
        }

        if ($data['age'] < 18) {
            throw new Exception('Вам меньше 18', 3);
        }

        if (!isset($data['email']) || !$data['email']) {
            throw new Exception('Вы не ввели почту', 4);
        }

        if (!filter_var((string)$data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Не верный адрес почты', 5);
        }

        return true;
    }
}

echo '<a href="/">Вернуться на главную</a> <br/>';

require_once $_SERVER['DOCUMENT_ROOT'] . '/view/form.php';

$success = false;
if (!empty($_POST)) {
    try {
        $success = (new UserFormValidation())->validate($_POST) ?? false;
    } catch (Exception $e) {
        echo 'Произошла ошибка: ' . $e->getMessage() . '. Код ошибки: ' . $e->getCode() . '<br/>';
    }

    $response = $success ? 'Данные успешно отправлены' : 'Исправьте ошибку';
    echo $response;
} else {
    echo 'Заполните форму!';
}

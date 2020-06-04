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

class User
{
    public array $logins;
    public array $logic = [false, true];
    private array $array;

    public function __construct(array $logins)
    {
        $this->logins = $logins;
    }

    public function load($id)
    {
        if (!isset($this->logins[$id])) {
            throw new Exception('Пользователь с таким идентификатором не найден', 400);
        }

        if (!$this->save([])) {
            throw new Exception('Не получилось сохранить', 500);
        }

        echo 'Данные сохранены';
    }

    public function save($data)
    {
        $this->array[] = $data;
        shuffle($this->logic);
        return $this->logic[0];
    }
}

$logins = [
    1 => 'user',
    'admin',
    'superUser',
    'superVisor',
    'root'
];

echo '<a href="/">Вернуться на главную</a> <br/>';

require_once $_SERVER['DOCUMENT_ROOT'] . '/view/form2.php';

$success = false;
if (!empty($_POST)) {
    try {
        $success = (new UserFormValidation())->validate($_POST);
    } catch (Exception $e) {
        echo 'Произошла ошибка: ' . $e->getMessage() . '. Код ошибки: ' . $e->getCode() . '<br/>';
    }

    if ($success) {
        $user = new User($logins);

        try {
            $user->load($_POST['id']);
        } catch (Exception $exception) {
            echo 'Произошла ошибка: ' . $exception->getMessage() . '. Код ошибки: ' . $exception->getCode() . '<br/>';
        }
    } else {
        echo 'Произошла ошибка';
    }
} else {
    echo 'Заполните форму!';
}

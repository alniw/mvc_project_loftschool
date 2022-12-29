<?php

namespace App\Controller\Admin;

use App\Model\Eloquent\User;

class Users extends Admin
{
    public function index()
    {
        return $this->view->render(
            'admin/users.phtml',
            [
                'users' => User::getList(),
            ]
        );
    }

    public function updateUser()
    {
        $id = (int) $_POST['id'];
        $name = (string) $_POST['name'];
        $email = (string) $_POST['email'];
        $password = (string) $_POST['password'];

        $user = User::getById($id);
        if (!$user) {
            return $this->response(['error' => 'Пользователь не найден']);
        }

        if (!$name) {
            return $this->response(['error' => 'Имя не задано']);
        }

        if (!$email) {
            return $this->response(['error' => 'email не задан']);
        }

        if ($password && mb_strlen($password) < 5) {
            return $this->response(['error' => 'Длина пароля должна быть не менее 5 символов']);
        }

        $user->name = $name;
        $user->email = $email;

        /** @var User $emailUser */
        $emailUser = User::getByEmail($email);
        if ($emailUser && $emailUser->id != $id) {
            return $this->response(['error' => 'Email занят пользователем с id#' . $emailUser->id]);
        }

        $user->password = User::getPasswordHash($password);
        $user->save();

        return $this->response(['result' => 'Пользователь успешно сохранен']);
    }

    public function deleteUser()
    {
        $id = (int) $_POST['id'];

        $user = User::getById($id);
        if (!$user) {
            return $this->response(['error' => 'Пользователь не найден']);
        }

        $user->delete();

        return $this->response(['result' => 'Пользователь успешно удален']);
    }

    public function addUser()
    {
        $name = (string) $_POST['name'];
        $email = (string) $_POST['email'];
        $password = (string) $_POST['password'];

        if (!$name || !$password) {
            return 'Не заданы имя и пароль';
        }

        if (!$name) {
            return $this->response(['error' => 'Введите имя']);
        }

        if (!$email) {
            return $this->response(['error' => 'Введите email']);
        }

        if (!$password || mb_strlen($password) < 5) {
            return $this->response(['error' => 'Длина пароля должна быть не менее 5 символов']);
        }

        /** @var User $emailUser */
        $emailUser = User::getByEmail($email);
        if ($emailUser) {
            return $this->response(['error' => 'email занят пользователем  с id#' . $emailUser->id]);
        }

        $userData = [
            'name' => $name,
            'registration_datetime' => date('Y-m-d H:i:s'),
            'password' => User::getPasswordHash($password),
            'email' => $email,
        ];
        $user = new User($userData);
        $user->save();

        return $this->response(['result' => 'Пользователь успешно добавлен']);
    }

    public function response(array $data)
    {
        header('Content-type: application/json');
        return json_encode($data);
    }
}

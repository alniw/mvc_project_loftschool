<?php

namespace App\Controller;

use App\Model\Eloquent\User;
use Base\AbstractController;

class Login extends AbstractController
{
    public function index()
    {
        if ($this->getUser()) {
            $this->redirect('/index.php/blog');
        }
        return $this->view->render(
            'login.phtml',
            [
                'title' => 'Главная',
                'user' => $this->getUser(),
            ]
        );
    }

    public function auth()
    {
        $email = (string) $_POST['email'];
        $password = (string) $_POST['password'];

        $user = User::getByEmail($email);
        if (!$user) {
            return 'Неверный логин и пароль';
        }

        if ($user->getPassword() !== User::getPasswordHash($password)) {
            return 'Неверный логин и пароль';
        }

        $this->session->authUser($user->getId());

        $this->redirect('/index.php/blog');
    }

    public function register()
    {
        $name = (string) $_POST['name'];
        $email = (string) $_POST['email'];
        $password = (string) $_POST['password'];
        $passwordRepeat = (string) $_POST['password_repeat'];

        if (!$name || !$password) {
            return 'Введите имя и пароль';
        }

        if (!$email) {
            return 'Введите email';
        }

        if ($password !== $passwordRepeat) {
            return 'Введённые пароли не совпадают';
        }

        if (mb_strlen($password) < 5) {
            return 'Длина пароля должна быть не менее 5 символов';
        }

        $userData = [
            'name' => $name,
            'registration_datetime' => date('Y-m-d H:i:s'),
            'password' => User::getPasswordHash($password),
            'email' => $email,
        ];
        $user = new User($userData);
        $user->save();

        $this->session->authUser($user->getId());
        $this->redirect('/index.php/blog');
    }

    public function logout()
    {
        $this->session->dropSession();
        $this->redirect('/index.php');
    }
}

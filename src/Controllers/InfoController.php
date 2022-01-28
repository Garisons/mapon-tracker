<?php

namespace App\Controllers;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;

class InfoController
{
    public function index()
    {
        if (!isset($_SESSION['login'])) {
            header('location: /login');
        }
        return 'info controller';
    }

    /**
     * @throws Exception
     */
    public function login(): string
    {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $dbConfig = [
            'url' => getenv('DATABASE_URL'),
        ];

        $instance = DriverManager::getConnection($dbConfig);
        $userQuery = $instance->executeQuery('SELECT * FROM users WHERE login = ?', [$login]);
        $userData = $userQuery->fetchAssociative();
        if (strcmp($password, $userData['password']) == 0) {
            $_SESSION['login'] = $userData['login'];
            header('location: /home');
        }

        return 'login controller';
    }

    public function logout()
    {
        unset($_SESSION['login']);
        header('location: /login');
    }

    public function home(): string
    {
        if (!isset($_SESSION['login'])) {
            header('location: /login');
        }
        return 'home action';
    }
}

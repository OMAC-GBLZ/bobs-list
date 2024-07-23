<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Session;
use Framework\Validation;

class UserController
{
    protected $db;

    public function __construct()
    {
        $config =  require basePath('config/db.php');
        $this->db = new Database($config);
    }


    // Show the login page

    public function login()
    {
        loadView('users/login');
    }


    //Show the register page


    public function create()
    {
        loadView('users/create');
    }


    // Store user in database


    public function store()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConfirmation = $_POST['password_confirmation'];

        $errors = [];

        if (!Validation::email($email)) {
            $errors['email'] = 'Please enter a valid email address';
        }


        if (!Validation::string($name, 2, 50)) {
            $errors['name'] = 'Name must be between 2 and 50 characters in length';
        }

        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = 'Password must be between 6 and 50 characters in length';
        }

        if (!Validation::match($password, $passwordConfirmation)) {
            $errors['password_confirmation'] = 'Passwords must match';
        }

        if (!empty($errors)) {
            loadView('users/create', [
                'errors' => $errors,
                'user' => [
                    'name' => $name,
                    'email' => $email,
                ]

            ]);
            exit;
        }

        //check if email exists

        $params = [
            'email' => $email
        ];

        $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

        if ($user) {
            $errors['email'] = 'Email already in use';
            loadView('users/create', [
                'errors' => $errors
            ]);
            exit;
        }

        //create user account
        $params = [
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)', $params);


        //get the new user id

        $userId = $this->db->conn->lastInsertId();

        Session::set('user', [
            'id' => $userId,
            'name' => $name,
            'email' => $email,
        ]);

        redirect('/');
    }


    //Logout user and end session


    public function logout()
    {
        Session::clearAll();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain']);
        redirect('/');
    }

    //Authenticate a user with email and password


    public function authenticate()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $errors = [];

        //validation

        if (!Validation::email($email)) {
            $errors['email'] = 'Please enter a valid email';
        }

        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = 'Password must be at least 6 characters';
        }

        if (!empty($errors)) {
            loadView('users/login', [
                'errors' => $errors
            ]);
            exit;
        }

        //Check for email

        $params = [
            'email' => $email
        ];

        $user = $this->db->query('SELCT * FROM users WHERE email = :email', $params)->fetch();

        if (!$user) {
            $errors['email'] = 'Email not found';
        }
        if (!empty($errors)) {
            loadView('users/login', [
                'errors' => $errors
            ]);
            exit;
        }

        //check if password is correct

        if (!password_verify($password, $user->password)) {
            $errors['password'] = 'Incorrect password';
            loadView('users/login', [
                'errors' => $errors
            ]);
            exit;
        }

        //set user session

        Session::set('user', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);

        redirect('/');
    }
}

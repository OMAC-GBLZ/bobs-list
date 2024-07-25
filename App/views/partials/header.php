<?php

use Framework\Session;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bob's List</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css" />
</head>

<body>
    <header>
        <div class="site-title">
            <h1>
                <a href="/">Bob's-List</a>
            </h1>
        </div>

        <div class="nav">
            <?php if (Session::has('user')) : ?>
                <a href="/listings/create">
                    <div class="yellow-btn">Create a listing</div>
                </a>
                <div>
                    <p>Welcome, <?= Session::get('user')['name']  ?>!</p>
                </div>
                <form action="/auth/logout" method="POST">
                    <button class="yellow-btn" action="submit"><a>Logout</a></button>
                </form>
            <?php else : ?>
                <div class="nav">
                    <div>
                        <a class="yellow" href="/auth/login">Login</a>
                    </div>
                    <div>
                        <a class="yellow" href="/auth/register">Register</a>
                    </div>
                </div>

            <?php endif; ?>
        </div>
    </header>
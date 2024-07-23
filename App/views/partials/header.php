<?php

use Framework\Session;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bob's List</title>
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
                <div>
                    Welcome <?= Session::get('user')['name'] ?>
                </div>
                <button class="yellow-btn"><a href="/listings/create">Create a listing</a></button>
                <form action="/auth/logout" method="POST">
                    <button class="yellow" action="submit">Logout</button>
                </form>
            <?php else : ?>
                <div>
                    <a href="/auth/login">Login</a>
                    <a href="/auth/register">Register</a>
                </div>

            <?php endif; ?>
        </div>
    </header>
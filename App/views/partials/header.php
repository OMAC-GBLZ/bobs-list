<?php

use Framework\Session;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bob's List</title>
</head>

<body>
    <header>
        <div>
            <h1>
                <a href="/">Bob's-List</a>
            </h1>
            <nav class="space-x-4">
                <?php if (Session::has('user')) : ?>
                    <div class="flex justify-between items-center gap-4">
                        <div>
                            Welcome <?= Session::get('user')['name'] ?>
                        </div>
                        <form action="/auth/logout" method="POST">
                            <button action="submit">Logout</button>
                        </form>
                        <a href="/listings/create">Create a listing</a>
                    </div>
                <?php else : ?>
                    <a href="/auth/login">Login</a>
                    <a href="/auth/register">Register</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
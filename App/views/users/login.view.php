<?php
loadPartial('header');
?>

<div>
    <div class="login container-vert">
        <h2>Login</h2>
        <?php if (isset($errors)) : ?>
            <?php foreach ($errors as $error) : ?>
                <div><?= $error ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
        <form method="POST" action="/auth/login">
            <div class="container-vert">
                <input type="email" name="email" placeholder="Email Address" />
                <input type="password" name="password" placeholder="Password" />
                <button class="yellow-btn w-100" type="submit">Login</button>
            </div>
            <p>
                Don't have an account?
                <a href="/auth/register">Register</a>
            </p>
        </form>
    </div>
</div>

<?php
loadPartial('footer');

<?php
loadPartial('header');
?>

<div>
    <div>
        <h2>Login</h2>
        <?php if (isset($errors)) : ?>
            <?php foreach ($errors as $error) : ?>
                <div><?= $error ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
        <form method="POST" action="/auth/login">
            <div>
                <input type="email" name="email" placeholder="Email Address" />
                <input type="password" name="password" placeholder="Password" />
                <button type="submit">Login</button>
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

<?php
loadPartial('header');

?>

<div>
    <div>
        <h2>Register</h2>
        <?= loadPartial('errors', [
            'errors' => $errors ?? []
        ]) ?>
        <form method="POST" action="/auth/register">
            <div>
                <input type="text" name="name" value="<?= $user['name'] ?? '' ?>" placeholder="Full Name" />
                <input type="email" name="email" value="<?= $user['email'] ?? '' ?>" placeholder="Email Address" />
                <input type="password" name="password" placeholder="Password" />
                <input type="password" name="password_confirmation" placeholder="Confirm Password" />
                <button type="submit">Register</button>
            </div>

            <p>
                Already have an account?
                <a href="/auth/login">Login</a>
            </p>
        </form>
    </div>
</div>

<?php
loadPartial('footer');

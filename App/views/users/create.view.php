<?php
loadPartial('header');

?>
<section id="reg">
    <div>
        <h2>Register</h2>
        <?= loadPartial('errors', [
            'errors' => $errors ?? []
        ]) ?>


        <form method="POST" action="/auth/register">
            <div class="form">
                <input type=" text" name="name" value="<?= $user['name'] ?? '' ?>" placeholder="Full Name" />
                <input type="email" name="email" value="<?= $user['email'] ?? '' ?>" placeholder="Email Address" />
                <input type="password" name="password" placeholder="Password" />
                <input type="password" name="password_confirmation" placeholder="Confirm Password" />
                <button class="green-btn" type="submit">Register</button>
            </div>
        </form>
        <div class="self-center">
            <p>Already have an account?</p>
            <a href="/auth/login">
                <div class="yellow-btn">
                    Login
                </div>
            </a>
        </div>
    </div>

</section>

<?php
loadPartial('footer');

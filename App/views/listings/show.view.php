<?php
loadPartial('header');
?>
<section>
    <div>
        <?= loadPartial('message') ?>
        <div>
            <a href="/listings">
                Back To Listings
            </a>
            <?php if (Framework\Authorisation::isOwner($listing->user_id)) : ?>
                <div>
                    <a href="/listings/edit/<?= $listing->id ?>">Edit</a>
                    <form method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit">Delete</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
        <div>
            <h2><?= $listing->title ?></h2>
            <p>
                <?= $listing->description ?>
            </p>
            <ul>
                <li><strong>Price:</strong> <?= $listing->price ?></li>
                <li>
                    <strong>Postcode:</strong> <?= $listing->postcode ?>
                </li>
            </ul>
        </div>
        <div>
            <p>
                Put "<?= $listing->title ?>" as the subject of your email.
            </p>
            <a href="mailto:<?= $listing->email ?>">
                Email Seller
            </a>
            <?php if ($listing->phone) : ?>
                <p>
                    Or call the seller on: <?= $listing->phone ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</section>


<?php
loadPartial('footer');
?>
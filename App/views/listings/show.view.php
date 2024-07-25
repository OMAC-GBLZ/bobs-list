<?php
loadPartial('header');
?>
<section id="single" class="bg-white">

    <div class="grid-left">
        <a href="/listings">
            <- Back To Listings </a>
    </div>

    <div class="grid-mid-under">
        <?= loadPartial('message') ?>
        <?php if (Framework\Authorisation::isOwner($listing->user_id)) : ?>
            <a href="/listings/edit/<?= $listing->id ?>">
                <div class="blue-btn">Edit</div>
            </a>
            <div>
                <form method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <button class="red-btn" type="submit">Delete</button>
            </div>
    </div>
<?php endif; ?>
</div>


<div class="grid-mid-upper">
    <div>
        <h2><?= $listing->title ?></h2>
        <div class="img-large">
            <?php if ($listing->image_location !== 'NULL') : ?>
                <a href="<?= $listing->image_location ?>">
                    <img class="img-large" src="<?= $listing->image_location ?>" alt="<?= $listing->title ?>">
                </a>
            <?php else : ?>
                <a href="/images/nophoto.jpg">
                    <img class="img-large" src="/images/nophoto.jpg" alt="no photo provided">
                </a>
            <?php endif; ?>
        </div>
        <p>
            <?= $listing->description ?>
        </p>
        <ul>
            <li><strong>Price:</strong> £<?= $listing->price ?></li>
            <li>
                <strong>Postcode:</strong> <?= $listing->postcode ?>
            </li>
        </ul>
        <div>
            <p>
                Put "<?= $listing->title ?>" as the subject of your email.
            </p>
            <div>
                <a href="mailto:<?= $listing->email ?>">
                    <div class="yellow-btn">Email Seller</div>
                </a>
            </div>
            <br>
            <?php if ($listing->phone) : ?>
                <p>
                    Or call the seller on: <strong><?= $listing->phone ?></strong>
                </p>
            <?php endif; ?>
        </div>
    </div>

</div>



</section>


<?php
loadPartial('footer');
?>
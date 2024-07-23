<?php
loadPartial('header');
?>

<section>
    <div>
        <h2>Create Listing</h2>
        <form method="POST" action="/listings">
            <?= loadPartial('errors', [
                'errors' => $errors ?? []
            ]) ?>
            <div>
                <input type="text" name="title" value="<?= $listing['title'] ?? '' ?>" placeholder="Title" />
                <textarea name="description" placeholder="Description"><?= $listing['description'] ?? '' ?></textarea>
                <input type="text" name="price" value="<?= $listing['price'] ?? '' ?>" placeholder="Price" />
                <input type="text" name="tags" value="<?= $listing['tags'] ?? '' ?>" placeholder="Tags" />
                <input type="text" name="postcode" value="<?= $listing['postcode'] ?? '' ?>" placeholder="Postcode" />
                <input type="text" name="phone" value="<?= $listing['phone'] ?? '' ?>" placeholder="Contact Phone Number" />
                <input type="email" name="email" value="<?= $listing['email'] ?? '' ?>" placeholder="Contact Email" />
                <button>Save</button>
            </div>
            <a href="/">Cancel</a>
        </form>
    </div>
</section>

<?php
loadPartial('footer');
?>
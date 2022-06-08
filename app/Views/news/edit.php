<h2><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= service('validation')->listErrors() ?>

<form action="/news/update/<?= esc($news['id']) ?>" method="post">
    <?= csrf_field() ?>

    <input type="hidden" name="id" value="<?= esc($news['id']) ?>"/><br />
    <input type="hidden" name="slug" value="<?= esc($news['slug']) ?>"/><br />

    <label for="title">Title</label>
    <input type="input" name="title" value="<?= esc($news['title']) ?>"/><br />

    <label for="body">Text</label>
    <textarea name="body" cols="45" rows="4"><?= esc($news['body']) ?></textarea><br />

    <input type="submit" name="submit" value="Update news item" />
</form>
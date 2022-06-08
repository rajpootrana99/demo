<h2><?= esc($title) ?></h2>

<a href="/news/create">Add new News</a>
<br>
<br>

<?php if (! empty($news) && is_array($news)): ?>

    <table border="1">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th width="40%">Body</th>
                <th>View</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($news as $news_item): ?>
                <tr>
                    <td><?= esc($news_item['id']) ?></td>
                    <td><?= esc($news_item['title']) ?></td>
                    <td><?= esc($news_item['body']) ?></td>
                    <td><a href="/news/<?= esc($news_item['slug'], 'url') ?>">View article</a></td>
                    <td><a href="/news/edit/<?= esc($news_item['slug'], 'url') ?>">Eidt</a> / <a href="/news/delete/<?= esc($news_item['id']) ?>">Delete</a></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

<?php else: ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>
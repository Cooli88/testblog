<div>Создать статью</div>

<table>
    <?php foreach($articles as $key=>$article): ?>
        <tr>
            <td><?php echo $key; ?></td>
            <td><?= $article->title ?></td>
            <td><?= $article->status ?></td>
            <td><a href="/article/single/<?=$article->id?>">Посмотреть</a></td>
            <td><a class="article-remove" href="#" data-id="<?=$article->id?>">Удалить</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<script>
    $(document).ready(function () {
        var form = $('.article-form');

        var $byttonRemoveArticle = $('.article-remove');

        $byttonRemoveArticle.click(function () {
            var self = $(this);
            var id = self.data('id')
            $.ajax({
                type: "POST",
                url: '/article/remove/' + id,
                data: form.serialize(),
                success: function (response) {
                    self.parents('tr').remove();
                    // window.location('/article')
                }
            });
        });

    });
</script>
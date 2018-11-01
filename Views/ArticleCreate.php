<div>Создать статью</div>
<form id="article-form" action="/article/add">
    <label>Название:
        <input type="text" name="title"/>
    </label>
    <label>Текст:
        <textarea name="text"></textarea>
    </label>
</form>
<button href="#" id="article-form-subbmimt">Отправить</button>

<script>
    $(document).ready(function () {
        var form = $('#article-form');

        var $byttonSubmit = $('#article-form-subbmimt');

        $byttonSubmit.click(function () {
            $.ajax({
                type: "POST",
                url: form.attr('action'),
                data: form.serialize(),
                success: function (response) {
                    window.location.replace('/article')
                }
            });
        });

    });
</script>
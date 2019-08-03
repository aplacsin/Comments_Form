<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Коментарии</title>
    <link rel="stylesheet" href="public/css/OtherComponents/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/OtherComponents/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <div class="wrapper-title">
        <h2 align="center">Оставить Комментарий</h2>
    </div>
    <div class="container">
        <form method="POST" id="comment_form">
            <div class="form-group form-group-main">
                <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Введите Имя">
            </div>
            <div class="form-group form-group-main">
                <textarea name="comment_text" id="comment_text" class="form-control" placeholder="Введите Комментарий"
                    rows="5"></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="comment_id" id="comment_id" value="0">
                <input type="submit" name="submit" id="submit" class="btn-send" value="Отправить">
            </div>
        </form>
        <span id="comment_message"></span>
        <br>
        <div class="wrapper-comments">
            Комментарии:
        </div>
        <div id="display_comment"></div>
    </div>


    <script src="public/js/OtherComponents/jquery-3.4.1.min.js"></script>
    <script src="public/js/OtherComponents/bootstrap.bundle.min.js"></script>
    <script src="public/js/main.js"></script>
</body>

</html>



<script>
    $(document).ready(function () {
        $('#comment_form').on('submit', function (event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "send_comment.php",
                method: "POST",
                data: form_data,
                dataType: "JSON",
                success: function (data) {
                    if (data.error != '') {
                        $('#comment_form')[0].reset();
                        $('#comment_message').html(data.error);
                        $('#comment_id').val('0');
                        load_comment();
                    }
                }
            })
        });

        load_comment();

        function load_comment() {
            $.ajax({
                url: "fetch_comment.php",
                method: "POST",
                success: function (data) {
                    $('#display_comment').html(data);
                }
            })
        }

        $(document).on('click', '.reply', function () {
            var comment_id = $(this).attr("id");
            $('#comment_id').val(comment_id);
            $('#comment_name').focus();
        });
    });
</script>
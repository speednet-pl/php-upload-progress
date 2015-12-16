<?php session_start(); ?>

<html>
<head>
    <meta charset="utf-8">
    <title>SPEEDNET: Upload Progress in PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <style>body { width: 400px; margin: 100px auto; }</style>
</head>

<body>
    <div class="well">
        <div class="progress hide">
            <div class="progress-bar progress-bar-striped active"><span></span></div>
        </div>

        <form class="form-inline" action="upload.php" method="POST" enctype="multipart/form-data" target="hidden_iframe">
            <input type="hidden" name="UPLOAD_PROGRESS" value="speednet" />
            <div class="form-group">
                 <input class='form-control' type="file" id="file" name="file" />
            </div>
            <button type="submit" class='btn btn-primary pull-right'>Wyślij</button>
        </form>

        <iframe class="hide" id="hidden_iframe" name="hidden_iframe"></iframe>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
        var $progressBar = $('.progress-bar');

        $('form').on('submit', function () {
            $progressBar.parent().removeClass('hide');
            setTimeout(updateProgress, 1000);
        });

        function updateProgress() {
            $.get('progress.php', function (data) {
                var progress = data.progress;

                $progressBar.css('width', progress + '%');
                $progressBar.find('span').html(progress + '%');

                if (progress < 100) {
                    setTimeout(updateProgress, 100);
                }
            });
        }
    </script>
</body>
</html>

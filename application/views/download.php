<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Database</title>

    <script src="<?= site_url();?>assets/jquery/dist/jquery.min.js"></script>
</head>
<body>
    <h1 style="text-align: center;">Download database</h1>

    <script>
        $(document).ready(function() {
            callDb()
        })

        function callDb() {
            $.ajax({
                type: 'post',
                url:  '<?= site_url('api/downloadFile');?>',
                dataType:  'text',
                success: function(response) {
                    console.log(response);
                }
            })
        }
    </script>
</body>
</html>
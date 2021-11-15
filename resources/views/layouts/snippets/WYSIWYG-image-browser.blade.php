<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Files Browser</title>

  <style type="text/css">
    body {
      font-family: 'Segoe UI', Verdana, Helvetica, sans-serif;
      font-size: 80%;
    }

    #form {
      width: 600px;
    }

    #fileExplorer {
      float: left;
      width: 680px;
      border-left: 1px solid #dff0ff;
    }

    .thumbnail {
      float: left;
      margin: 3px;
      padding: 3px;
      border-left: 1px solid #dff0ff;
    }

    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
    }

    li {
      padding: 0;
    }
  </style>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

  <script type="text/javascript">
    $(document).ready(function () {
        var funcNum = <?php echo $_GET['CKEditorFuncNum'] . ';'; ?>

        $('#fileExplorer').on('click', 'img', function () {
            var fileUrl = $(this).attr('title')
            window.opener.CKEDITOR.tools.callFunction(funcNum, fileUrl)
            window.close()
        }).hover(function(){
          $(this).css('cursor', 'pointer')
        })
    });
  </script>
</head>

<body>
  <div id="fileExplorer">
    @foreach ($fileNames as $fileName )
    <div class="thumbnail">
      <img src="{{ tenant_public_path() . '/images/WYSIWYG/' . $fileName }}" alt="thumb" title="{{ tenant_public_path() . '/images/WYSIWYG/' . $fileName }}" width="120" height="100">
      <br>
    </div>
    @endforeach
  </div>
</body>

</html>

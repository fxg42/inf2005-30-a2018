<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>requests</title>
  </head>
  <body>
    <h1>$_REQUEST</h1>
    <pre><?php print_r($_REQUEST); ?></pre>
    <h1>$_GET</h1>
    <pre><?php print_r($_GET); ?></pre>
    <h1>$_POST</h1>
    <pre><?php print_r($_POST); ?></pre>

    <form method="POST" action="/index.php?urlparam=1">
      <input name="formparam" value="2"/>
      <button>Submit</button>
    </form>
  </body>
</html>

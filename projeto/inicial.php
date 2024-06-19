<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz Game</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
  <div id="startScreen" class="container text-center">
    <div class="content bg-white p-5 rounded shadow">
      <h1 class="mb-4">Jornada Binária - Quiz Game</h1>
      <form method="post" action="">
        <button name="action" value="start" class="btn btn-primary btn-lg mb-2">Start</button><br>
        <button name="action" value="ranking" class="btn btn-info btn-lg mb-2">Ranking</button><br>
        <button name="action" value="sair" class="btn btn-danger btn-lg">Sair</button>
      </form>
    </div>
  </div>

  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    switch ($action) {
      case 'start':
        header('Location: index.php');
        exit();
      case 'ranking':
        header('Location: ranking.html');
        exit();
      case 'sair':
        header('Location: logout.php');
        exit();
    }
  }
  ?>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
  <div class="container">
    <div class="content bg-white p-5 rounded shadow">
      <h1 class="text-center mb-4">Faça seu cadastro:</h1>
      <form id="cadastroForm" action="salvar_score.php" method="POST">
        <div class="form-group">
          <label for="usuario">Nome de Usuário</label>
          <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Insira seu username">
        </div>
        <div class="form-group">
          <label for="senha">Senha</label>
          <input type="password" id="senha" name="senha" class="form-control" placeholder="Insira sua Senha">
        </div>
        <div class="text-center form-group">
          <button type="submit" id="salvar" class="btn btn-primary btn-lg mb-2">Cadastrar</button><br>
          <a href="login.html" class="btn btn-secondary btn-lg">Voltar pro login</a>
        </div>
      </form>
    </div>
  </div>
  <script>
    document.getElementById("cadastroForm").addEventListener("submit", function(event) {
      const username = document.getElementById("username").value;
      const password = document.getElementById("senha").value;

      if (username === "" || password === "") {
        alert("Por favor, preencha todos os campos.");
        event.preventDefault();
      }
    });
  </script>
</body>
</html>

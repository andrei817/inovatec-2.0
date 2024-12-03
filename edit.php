<?php
include ('php/Config.php'); // Inclui a conexão com o banco de dados

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM produtor WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $produtor = mysqli_fetch_assoc($result);

    if (!$produtor) {
        die("Produtor não encontrado!");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = md5($_POST['senha']);  // Criptografar a senha com MD5
    $cpf = $_POST['cpf'];
    $pergunta_seg = $_POST['pergunta_seg'];  // Pergunta de segurança
    $resposta_seg = $_POST['resposta_seg'];  // Resposta de segurança

    // Atualiza a tabela produtor, incluindo a pergunta e resposta de segurança
    $sql = "UPDATE produtor SET nome = '$nome', email = '$email', telefone = '$telefone', senha = '$senha', cpf = '$cpf', pergunta_seg = '$pergunta_seg', resposta_seg = '$resposta_seg' WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        header("Location: listar produtores.php");
        exit;
    } else {
        echo "Erro ao atualizar o produtor: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="ico/SGE.ico" type="image/x-icon">
    <link rel="stylesheet" href="edit.css">
    <title>Editar Produtor</title>
</head>
<body>

<div id="header"></div> <!-- Div onde o menu será injetado -->

<script>
  fetch('/menu principal.php')
    .then(response => response.text())
    .then(data => {
      document.getElementById('header').innerHTML = data;
    })
    .catch(error => console.error('Erro ao carregar o menu:', error));
</script>

<div class="content">
  <!-- Conteúdo da página -->
</div>

<section class="agenda-evento">
    <div class="conteudo">
        <section class="login-section"> 
            <div class="login-box"> 
                <h1>Editar Produtor</h1>
                <a href="listar produtores.php" class="close-btn-edit">&times;</a>
                <form method="POST">
                   <div class="input-group-prod">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($produtor['nome']); ?>" required><br>
                   </div>

                   <div class="input-group-prod">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($produtor['email']); ?>" required><br>
                   </div>

                   <div class="input-group-prod">
                        <label for="telefone">Telefone:</label>
                        <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($produtor['telefone']); ?>"><br>
                   </div>

                   <div class="input-group-prod">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="senha" value="<?php echo htmlspecialchars($produtor['senha']); ?>"><br>
                   </div>

                   <div class="input-group-prod">
                        <label for="cpf">CPF:</label>
                        <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($produtor['cpf']); ?>"><br>
                   </div>

                   <div class="input-group-prod">
                        <label for="pergunta_seg">Pergunta de Segurança:</label>
                        <input type="text" id="pergunta_seg" name="pergunta_seg" value="<?php echo htmlspecialchars($produtor['pergunta_seg']); ?>" required><br>
                   </div>

                   <div class="input-group-prod">
                        <label for="resposta_seg">Resposta de Segurança:</label>
                        <input type="text" id="resposta_seg" name="resposta_seg" value="<?php echo htmlspecialchars($produtor['resposta_seg']); ?>" required><br>
                   </div>

                   <button type="submit" class="login-btn-edit">Salvar</button>
                </form>
            </div>
        </section>
    </div>
</section>

</body>
</html>

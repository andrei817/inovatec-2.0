<?php
// Conexão com o banco de dados
include("php/Config.php");

$cadastroSucesso = false;

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletar dados do formulário
    $evento_id = $conn->real_escape_string($_POST['evento_id']);
    $data = $conn->real_escape_string($_POST['data']);
    $descricao_problema = $conn->real_escape_string($_POST['descricao_problema']);
    $contato = $conn->real_escape_string($_POST['contato']);

    // Inserir dados no banco de dados
    $sql = "INSERT INTO problemas_evento (evento_id, data, descricao_problema, contato)
            VALUES ('$evento_id', '$data', '$descricao_problema', '$contato')";

    if ($conn->query($sql) === TRUE) {
        $cadastroSucesso = true;
    } else {
        echo "Erro ao reportar o problema: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="ico/SGE.ico" type="image/x-icon">
    <link rel="stylesheet" href="reporte de problemas.css">
    <title>Reportar Problema</title>
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

<div class="agenda-evento">
    <div class="conteudo">
        
    <div class="form">

    <h1>Reportar Problema de Evento</h1>
    <a href="relatório de problemas.php" class="close_login-btn">&times;</a>

    <form action="" method="POST">
       <div class="input-group">
        <label for="evento_id">Evento:</label>
        <select name="evento_id" id="evento_id" class="inputUser" required>
            <option value=""> Selecione o Evento </option>
            <?php
            // Conexão com o banco de dados
            include("php/Config.php");

            // Buscar os eventos e suas datas
            $sql = "SELECT id, nome, data FROM eventos"; // Alterado para 'data'
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "' data-data='" . $row['data'] . "'>" . $row['nome'] . "</option>";
                }
            } else {
                echo "<option value=''>Nenhum evento encontrado</option>";
            }
            ?>
        </select><br>
     </div>

        <div class="input-group">
        <label for="data">Data do Evento:</label>
        <input type="date" id="data" name="data" required readonly> <!-- Alterado para 'data' -->
        </div>

        <div class="input-group">
        <label for="descricao_problema">Descrição do Problema:</label>
        <textarea id="descricao_problema" name="descricao_problema" rows="2" class="inputUser" required placeholder="Descreva o problema aqui..."></textarea>
        </div>

        <div class="input-group">
        <label for="contato">E-mail :</label>
        <input type="text" id="contato" name="contato" required placeholder="Digite seu e-mail">
        </div>

        <button type="submit" class="login-reportar"> Reportar</button>
        <a href="relatório de problemas.php"><button type="button" class="Cancel-btn">Cancelar</button></a>
        
    </form>
    </div>
</div>

<!-- Modal de Sucesso -->
<div id="modalSucesso" class="modal-correto">
    <div class="modal-content-correto"> 
        <span class="close-icon" onclick="fecharModal()">&times;</span>
        <h1>Problema Reportado!</h1>
        <img src="correto.png" class="correto-img">
    </div>
</div>

<script>
    // Função para fechar o modal
    function fecharModal() {
        document.getElementById("modalSucesso").style.display = "none";
    }

    // Função para redirecionar para outra página
    function redirecionarParaPagina() {
        window.location.href = "relatório de problemas.php";  // Substitua com o URL da página desejada
    }

    // Exibe o modal se o cadastro foi bem-sucedido
    <?php if ($cadastroSucesso): ?>
        document.getElementById("modalSucesso").style.display = "flex";
        setTimeout(function() {
            fecharModal();           // Fecha o modal
            redirecionarParaPagina();  // Redireciona para outra página após 3 segundos
        }, 3000); // Fecha automaticamente após 3 segundos
    <?php endif; ?>
</script>

<script>
    document.getElementById('evento_id').addEventListener('change', function() {
        var eventoSelect = this;
        var data = eventoSelect.options[eventoSelect.selectedIndex].getAttribute('data-data');
        
        // Preencher o campo 'data' com a data associada ao evento selecionado
        if (data) {
            document.getElementById('data').value = data;
        }
    });
</script>

</body>
</html>

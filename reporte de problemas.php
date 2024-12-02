<?php
// Conexão com o banco de dados
include("php/Config.php");

$cadastroSucesso = false;

// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coletar dados do formulário
    $evento_id = $conn->real_escape_string($_POST['evento_id']);
    $data_evento = $conn->real_escape_string($_POST['data_evento']);
    $descricao_problema = $conn->real_escape_string($_POST['descricao_problema']);
    $contato = $conn->real_escape_string($_POST['contato']);

    // Inserir dados no banco de dados
    $sql = "INSERT INTO problemas_evento (evento_id, data_evento, descricao_problema, contato)
            VALUES ('$evento_id', '$data_evento', '$descricao_problema', '$contato')";

    if ($conn->query($sql) === TRUE) {
        //echo "Problema reportado com sucesso!";
    } else {
        echo "Erro ao reportar o problema: " . $conn->error;
    }
    $cadastroSucesso = true;
}

// Fechar conexão
$conn->close();

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<script> 
// Função para abrir a sidebar
function abrirSidebar() {
    if (window.innerWidth <= 768) {
      document.getElementById("mySidebar").style.width = "100%";
    } else {
      document.getElementById("mySidebar").style.width = "310px";
    }
    // Adiciona a classe "aberto" à sidebar
    document.getElementById("mySidebar").classList.add("aberto");
  }

  // Função para fechar a sidebar
  function fecharSidebar() {
    document.getElementById("mySidebar").style.width = "0";
    // Remove a classe "aberto"
    document.getElementById("mySidebar").classList.remove("aberto");
  }

  // Adiciona o evento para fechar ao clicar fora da sidebar
  document.addEventListener('click', function (event) {
    const sidebar = document.getElementById("mySidebar");
    const isClickInsideSidebar = sidebar.contains(event.target);
    const isClickOnButton = event.target.closest('.open-btn');

    // Fecha a sidebar se o clique não for nela nem no botão de abrir
    if (!isClickInsideSidebar && !isClickOnButton && sidebar.classList.contains("aberto")) {
      fecharSidebar();
    }
  });

  // Fecha a sidebar ao clicar nos links
  document.querySelectorAll('#mySidebar a').forEach(link => {
    link.addEventListener('click', fecharSidebar);
  });
   </script>


<script>
  // Função para mostrar/ocultar a lista suspensa do perfil
  function toggle() {
      var profileDropdownList = document.querySelector('.profile-dropdown-list');
      profileDropdownList.classList.toggle('active');
  }

  // Função para mostrar o modal de logout
  function showLogoutModal() {
      document.getElementById('logoutModal').style.display = 'flex';
  }

  // Função para fechar qualquer modal
  function closeModal(modalId) {
      document.getElementById(modalId).style.display = 'none';
  }

  // Função para confirmar o logout e mostrar o modal de agradecimento
  function confirmLogout() {
      closeModal('logoutModal'); // Fecha o modal de logout
      document.getElementById('thankYouModal').style.display = 'flex'; // Mostra o modal de agradecimento
      
      // Redireciona após alguns segundos (opcional)
      setTimeout(function() {
          window.location.href = 'index.php'; // Redireciona para a página inicial
      }, 2000); // Aguarda 2 segundos antes de redirecionar
  }
</script>



<div class="agenda-evento">
    <div class="conteudo">
        
    <div class="form">

    <h1>Reportar Problema de Evento</h1>
    <a href="relatório de problemas.php" class="close_login-btn">&times;</a>

    <form action="" method="POST">
       <div class="input-group">
    <label for="evento_id">Evento:</label>
    <select name="evento_id" id="evento_id" class="inputUser"  required>
        <option> Selecione o Evento </option>
            <?php
            // Conexão com o banco de dados
            include("php/Config.php");

            // Buscar os cargos
            $sql = "SELECT id, nome FROM eventos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                }
            } else {
                echo "<option value=''>Nenhum evento encontrado</option>";
            }
            $conn->close();
            ?>
        </select><br>

     </div>

        <div class="input-group">
        <label for="data_evento">Data do Evento:</label>
        <input type="date" id="data_evento" name="data_evento" required>
        </div>

        <div class="input-group">
        <label for="descricao_problema">Descrição do Problema:</label>
        <textarea id="descricao_problema" name="descricao_problema" rows="5" required placeholder="Descreva o problema aqui..."></textarea>
        </div>

        <div class="input-group">
        <label for="contato">Contato (E-mail ou Telefone):</label>
        <input type="text" id="contato" name="contato" required placeholder="Digite seu e-mail ou telefone">
        </div>

        <button type="submit" class="login-reportar"> Reportar</button>
        <a href="relatório de problemas.php"><button type="button" class="Cancel-btn">Cancelar</button></a>
        
    </form>
    </div>
        </div>
    <!-- script do sidebar -->
    <script> 

// Função para abrir a sidebar
function abrirSidebar() {
  document.getElementById("mySidebar").style.width = "310px";
}

// Função para fechar a sidebar
function fecharSidebar() {
  document.getElementById("mySidebar").style.width = "0";
}

// Função para abrir a sidebar
function abrirSidebar() {
  // Se for um dispositivo móvel, ocupa 100% da tela; caso contrário, 250px
  if (window.innerWidth <= 768) {
      document.getElementById("mySidebar").style.width = "100%";
  } else {
      document.getElementById("mySidebar").style.width = "310px";
  }
}

// Função para fechar a sidebar
function fecharSidebar() {
  document.getElementById("mySidebar").style.width = "0";
}

    </script>

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


</body>
</html>




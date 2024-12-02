<?php
// Incluir o arquivo de conexão
include('php/Config.php');

// Verificar se o ID do evento foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar os dados do evento no banco de dados
    $sql = "SELECT * FROM objetivo WHERE id = $id";
    $resultado = mysqli_query($conn, $sql);
    $objetivo = mysqli_fetch_assoc($resultado);
} else {
    // Caso o ID não seja passado
    echo "Objetivo não encontrado.";
    exit;
}

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    

    // Atualizar os dados no banco de dados
    $sql_update = "UPDATE objetivo SET nome = '$nome', descricao = '$descricao' WHERE id = $id";
    
    if (mysqli_query($conn, $sql_update)) {
        echo "Objetivo alterado com sucesso!";
        header('Location: lista de objetivos.php'); // Redirecionar para a página inicial (ou para a tabela de eventos)
    } else {
        echo "Erro ao alterar o objetivo: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit objetivo.css">
    <title>Alterar Objetivo</title>
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
     document.getElementById("mySidebar").style.width = "250px";
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
     
    <section class="login-section">

    <div class="login-box"> 
    <a href="lista de objetivos.php" class="close-btn-obj">&times;</a>
    <h1>Editar Objetivo</h1>
    <form method="POST">
        <div class="input-group">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" value="<?php echo $objetivo['nome']; ?>" required>
        </div>

        <div class="input-group">
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" rows="4" cols="30" class="inputUser" placeholder="Descrição do Objetivo" required><?php echo $objetivo['descricao']; ?></textarea><br>
        </div>


        <button type="submit" class="login-btn-obj">Alterar </button>
        <a href="lista de objetivos.php"><button type="button" class="Cancel-btn-obj">Cancelar</button></a>
    </form>
</body>
</html>

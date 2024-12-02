<!-- editar_buffet.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="edit-buffet.css">
    <title>Editar Buffet</title>
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
     <a href="lista de buffet.php" class="close-btn-buffet">&times;</a>
    <h3>Editar Buffet</h3>

    <?php
    include("php/Config.php");

    if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Buscar buffet específico
    $sql = "SELECT * FROM buffet WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $buffet = mysqli_fetch_assoc($result);

    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        
    
        $sql = "UPDATE buffet SET nome = '$nome', descricao = '$descricao' WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: lista de buffet.php");
        exit;
    } else {
        echo "Buffet não encontrado: " . mysqli_error($conn);
    }
}
    
    ?>

    <!-- Formulário de edição -->
    <form method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

        <div class="input-group">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($buffet['nome']); ?>">
        </div>

        <div class="input-group">
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" rows="5" cols="40" class="inputUser" ><?php echo htmlspecialchars($buffet['descricao']); ?></textarea>
        </div>


        <button type="submit" class="login-btn-buffet"> Atualizar </button>
        <a href="lista de buffet.php"><button type="button" class="Cancel-btn-buffet">Cancelar</button></a>

    </form>

   
</body>
</html>

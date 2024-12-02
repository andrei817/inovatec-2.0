<?php
// cadastrar_staff.php
include ('php/Config.php');

$cadastroSucesso = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cargo_id = $_POST['cargo_id'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    // Query de inserção
    $sql = "INSERT INTO staffs_eventos (nome, cargo_id, telefone, email) 
            VALUES ('$nome', '$cargo_id', '$telefone', '$email')";

    if ($conn->query($sql) === TRUE) {
        //echo "Staff cadastrado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

   $cadastroSucesso = true;

} 

?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGE - Cadastro do Staff</title>
    <link rel="stylesheet" href="Staff.css">
    <script src="evento.js"> </script>
    
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

<div class="container"> 



<section class="login-section">

<div class="login-box">
    <h3>CADASTRAR STAFF</h3>
   <a href="lista de staff.php" class="close-btn-staff">&times;</a>
 
        <!--<h2> Cadastrar Staff </h2> -->

<form method="POST" action="">

     <div class="input-group"> 
    <label for="nome">Nome do Staff:</label>
    <input type="text" id="nome" name="nome" required>
     </div>

     <div class="input-group">
    <label for="cargo">Cargo do Staff:</label>
    <select name="cargo_id" id="cargo_id" class="inputUser"  required>
        <option> Selecione o Cargo </option>
            <?php
            // Conexão com o banco de dados
            include("php/Config.php");

            // Buscar os cargos
            $sql = "SELECT id, nome FROM cargos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                }
            } else {
                echo "<option value=''>Nenhum cargo encontrado</option>";
            }
            $conn->close();
            ?>
        </select><br>

     </div>

     <div class="input-group">
    <label for="telefone">Telefone:</label>
    <input type="tel" id="telefone" name="telefone" class="inputUser">
     </div>

     <div class="input-group">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" class="inputUser">
    </div>

    <button type="submit" class="login-btn-staff">Cadastrar</button>
    <a href="lista de staff.php"><button type="button" class="Cancel-btn-staff">Cancelar</button></a>

   
</form>

<!-- Modal de Sucesso -->
<div id="modalSucesso" class="modal-correto">
    <div class="modal-content-correto"> 
        <span class="icon-close" onclick="fecharModal()">&times;</span>
        <h1>Staff Cadastrado com Sucesso!</h1>
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
        window.location.href = "lista de staff.php";  // Substitua com o URL da página desejada
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
    </section>
</section>

</body>
</html>




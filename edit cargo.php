<?php
session_start();
include("php/Config.php");

// Verifica se o ID do cargo foi passado via GET
if (isset($_GET['id'])) {
    $cargo_id = intval($_GET['id']); // Assegura que o ID é um número inteiro

    // Consulta o cargo a ser editado
    $sql = "SELECT * FROM cargos WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Erro ao preparar consulta: " . $conn->error);
    }

    $stmt->bind_param("i", $cargo_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $cargo = $result->fetch_assoc();
    } else {
        echo "Cargo não encontrado.";
        exit();
    }
} else {
    echo "ID do cargo não informado.";
    exit();
}

// Atualiza o cargo se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome_cargo = trim($_POST['nome_cargo']); // Evita espaços em branco desnecessários

    if (empty($nome_cargo)) {
        echo "O nome do cargo não pode estar vazio.";
    } else {
        $sql = "UPDATE cargos SET nome = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Erro ao preparar atualização: " . $conn->error);
        }

        $stmt->bind_param("si", $nome_cargo, $cargo_id);

        if ($stmt->execute()) {
            echo "Cargo atualizado com sucesso!";
            header("Location: Cargo.php"); // Redireciona para a lista de cargos
            exit();
        } else {
            echo "Erro ao atualizar o cargo: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adcionar cargo.css">
    <title>Editar Cargo de Staff</title>
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



<section class="agenda-evento">

<div class="conteudo">

<section class="login-section">

        <div class="login-box">

    <a href="cargo.php" class="btn-close-cargo">&times;</a>
    <h2>Editar Cargo</h2>


    <form method="POST">

    <div class="input-group">
        <label for="nome_cargo">Nome do Cargo:</label>
        <input type="text" name="nome_cargo" value="<?php echo htmlspecialchars($cargo['nome']); ?>" required><br><br>
    </div>

        <button type="submit" class="login-btn">Atualizar</button>
        <a href="cargo.php"><button type="button" class="Cancel-btn">Cancelar</button></a>
    </form>

   
</body>
</html>

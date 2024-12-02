<?php
// Conexão com o banco de dados
include("php/Config.php");

// Defina o número de registros por página
$registros_por_pagina = 3;

// Verifica a página atual, padrão é 1
$pagina_atual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$offset = ($pagina_atual - 1) * $registros_por_pagina;

// Consulta para contar o total de registros
$total_registros_query = "SELECT COUNT(*) as total FROM evento_staff";
$total_resultado = $conn->query($total_registros_query);
$total_registros = $total_resultado->fetch_assoc()['total'];

// Calcula o total de páginas
$total_paginas = ceil($total_registros / $registros_por_pagina);

// Consulta com LIMIT para buscar apenas os registros da página atual
$sql = "SELECT eventos.id AS evento_id, eventos.nome AS evento_nome, eventos.data AS evento_data, 
               staffs_eventos.id AS staff_id, staffs_eventos.nome AS staff_nome, staffs_eventos.email AS staff_email
        FROM evento_staff
        JOIN eventos ON evento_staff.evento_id = eventos.id
        JOIN staffs_eventos ON evento_staff.staff_id = staffs_eventos.id
        ORDER BY eventos.data DESC
        LIMIT $offset, $registros_por_pagina";

$result = $conn->query($sql);

// Verifica se a consulta retornou resultados
$staffs = $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff por Evento</title>
    <link rel="stylesheet" href="colaboradores.css">
    <link rel="stylesheet" href="print-relatório.css">

    <style>
        
        /* Estilos para impressão */
        @media print {

            /* Ocultar elementos não necessários durante a impressão */
            .no-print {
                display: none;
            }

            /* Exibir a tabela na impressão */
            .printable-table {
                border: 1px solid #000;
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            .printable-table th, .printable-table td {
                border: 1px solid #000;
                padding: 10px;
                font-size: 14px;
            }

            .printable-table th {
                background-color: #f1f1f1;
                font-weight: bold;
            }

            .print-button {
                display: none; /* Esconde o botão de imprimir durante a impressão */
            }

            h1 {
                font-size: 18px;
                text-align: center;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>

<div class="no-print" id="header"></div> <!-- Div onde o menu será injetado -->

<script>
  fetch('/menu principal.php')
    .then(response => response.text())
    .then(data => {
      document.getElementById('header').innerHTML = data;
    })
    .catch(error => console.error('Erro ao carregar o menu:', error));
</script>

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



<section class="agenda-relatorio">
    <div class="conteudo-relatorio">
        <h1>Staff por Evento</h1>
        <a href="associar staff.php" class="button no-print">Associar Staff</a>
    </div>

    <table id="eventTable" class="table">
        <thead>
            <tr>
                <th>Evento</th>
                <th>Data</th>
                <th>Nome do Staff</th>
                <th>Email do Staff</th>
                <th class="ações">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($staffs)) {
                foreach ($staffs as $row) {
                    echo "<tr id='row-" . $row['evento_id'] . "'>";
                    echo "<td>" . htmlspecialchars($row['evento_nome']) . "</td>";
                    echo "<td>" . date("d/m/Y", strtotime($row['evento_data'])) . "</td>";
                    echo "<td>" . htmlspecialchars($row['staff_nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['staff_email']) . "</td>";
                    echo "<td class='action'>
                    <button class='no-print print-button' onclick='printRow(" . $row['evento_id'] . ")'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-printer' viewBox='0 0 16 16'>
                            <path d='M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1'/>
                            <path d='M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1'/>
                        </svg>
                    </button>
                  </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nenhum staff associado encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Links de navegação para paginação -->
    <div class="pagination">
        <?php
        for ($i = 1; $i <= $total_paginas; $i++) {
            echo "<a href='?pagina=$i'";
            if ($pagina_atual == $i) echo " class='active'";
            echo ">$i</a> ";
        }
        ?>
    </div>
</section>

<script>
 function printRow(rowId) {
    // Copia a linha selecionada para uma nova área de impressão temporária
    let row = document.getElementById('row-' + rowId);
    let cells = row.getElementsByTagName('td');

    // Extraindo os dados das células (removendo o ID e o botão de ação)
    let evento = cells[0].innerText; // Nome do evento
    let nomeStaff = cells[1].innerText; // Nome do staff
    let emailStaff = cells[2].innerText; // E-mail do staff
    let dataEvento = cells[3].innerText; // Data do evento

    // Oculta os botões de ação na linha selecionada antes de imprimir
    let botoes = row.querySelectorAll('.action button');
    botoes.forEach(function(botao) {
        botao.style.display = 'none'; // Oculta os botões
    });

    // Cria o conteúdo de impressão manualmente
    let printContent = `
      <html>
      <head>
        <title>Relatório de Staff por Evento</title>
        <style>
          body { font-family: Arial, sans-serif; font-size: 14px; }
          table { width: 100%; border-collapse: collapse; }
          table th, table td { padding: 8px; text-align: left; border: 1px solid #ddd; }
          table th { background-color: #f4f4f4; }
        </style>
      </head>
      <body>
        <h1>Staff por Evento</h1>
        <table>
          <thead>
            <tr>
              <th>Evento</th>
              <th>Data</th>
              <th>Nome do Staff</th>
              <th>Email do Staff</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>${evento}</td>
              <td>${dataEvento}</td>
              <td>${nomeStaff}</td>
              <td>${emailStaff}</td>
            </tr>
          </tbody>
        </table>
      </body>
      </html>
    `;

    // Cria um iframe invisível no documento
    let iframe = document.createElement('iframe');
    iframe.style.position = 'absolute';
    iframe.style.width = '0';
    iframe.style.height = '0';
    iframe.style.border = 'none';
    document.body.appendChild(iframe);

    // Escreve o conteúdo da impressão no iframe
    let doc = iframe.contentWindow.document;
    doc.open();
    doc.write(printContent);
    doc.close();

    // Executa a impressão diretamente no iframe
    iframe.contentWindow.focus();
    iframe.contentWindow.print();

    // Remove o iframe após a impressão
    document.body.removeChild(iframe);

    // Restaura a exibição dos botões de ação após a impressão
    botoes.forEach(function(botao) {
        botao.style.display = ''; // Restaura a visibilidade dos botões
    });
}


</script>



</body>
</html>

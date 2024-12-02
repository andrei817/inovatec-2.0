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


  let profileDropdownList = document.querySelector(".profile-dropdown-list");
let btn = document.querySelector(".profile-dropdown-btn");
let classList = profileDropdownList.classList;
const toggle = () => classList.toggle("active");
window.addEventListener("click", function (e) {
  if (!btn.contains(e.target)) classList.remove("active");
});


function showDetails(nome, imagem, data, descricao, local, hora, lotacao, duracao, faixa_etaria_desc, status_social_desc, status_evento_nome, escolaridade_desc) {
  // Preenche o modal com as informações do evento
  document.getElementById('modalNome').innerText = nome;
  document.getElementById('modalData').innerText = 'Data: ' + data;
  document.getElementById('modalDescricao').innerText = descricao;
  document.getElementById('modalLocal').innerText = local;
  document.getElementById('modalHora').innerText = hora;
  document.getElementById('modalLotacao').innerText = lotacao;
  document.getElementById('modalDuracao').innerText = duracao;

  // Passa as descrições e nomes ao modal
  document.getElementById('modalFaixaEtaria').innerText = 'Faixa Etária: ' + faixa_etaria_desc;
  document.getElementById('modalStatusSocial').innerText = 'Status Social: ' + status_social_desc;
  document.getElementById('modalStatusEvento').innerText = 'Status do Evento: ' + status_evento_nome;
  document.getElementById('modalEscolaridade').innerText = 'Escolaridade: ' + escolaridade_desc;

  // Exibe o modal
  document.getElementById('eventModal').style.display = "block";
}

// Função para fechar o modal
function closeModal() {
  document.getElementById('eventModal').style.display = "none";
}

// Fechar o modal quando clicar fora dele
window.onclick = function(event) {
  if (event.target == document.getElementById('eventModal')) {
      closeModal();
  }
}



menuItems.forEach(item => {
    item.addEventListener('click', () => {
        // Remove a classe 'active' de todos os itens
        menuItems.forEach(i => i.classList.remove('active'));

        // Adiciona a classe 'active' ao item clicado
        item.classList.add('active');
    });
});

   const express = require("express");
const jwt = require("jsonwebtoken");
const cookieParser = require("cookie-parser");

const app = express();
app.use(cookieParser());

// Função para criar o token JWT e armazená-lo como cookie
function createSessionToken(res, userId) {
  const token = jwt.sign({ userId }, process.env.JWT_SECRET, { expiresIn: "1h" });
  res.cookie("session", token, {
    httpOnly: true,
    secure: true,
    sameSite: "Strict",
    maxAge: 3600000 // 1 hora em milissegundos
  });
}

// Endpoint de login
app.post("/login", (req, res) => {
  const userId = req.body.userId; // ID do usuário após autenticação
  createSessionToken(res, userId);
  res.send("Login efetuado com sucesso!");
});

// Middleware para verificar se o usuário está autenticado
function authMiddleware(req, res, next) {
  const token = req.cookies.session;
  if (!token) return res.status(401).send("Sessão expirada");

  jwt.verify(token, process.env.JWT_SECRET, (err, decoded) => {
    if (err) return res.status(401).send("Sessão inválida");
    req.userId = decoded.userId;
    next();
  });
}

// Rota protegida
app.get("/protected", authMiddleware, (req, res) => {
  res.send("Conteúdo protegido");
});

app.listen(3000, () => console.log("Servidor rodando na porta 3000"));

function showDetails(nome, imagem, data, descricao, local, hora, lotacao, duracao, faixaEtaria, statusSocial, statusEvento, escolaridade) {
  document.getElementById('modalNome').innerText = nome;
  document.getElementById('modalData').innerText = `Data: ${data}`;
  document.getElementById('modalDescricao').innerText = descricao;
  document.getElementById('modalLocal').innerText = local;
  document.getElementById('modalHora').innerText = hora;
  document.getElementById('modalLotacao').innerText = lotacao;
  document.getElementById('modalDuracao').innerText = duracao;
  document.getElementById('modalFaixaEtaria').innerText = `Faixa Etária: ${faixaEtaria}`;
  document.getElementById('modalStatusSocial').innerText = `Status Social: ${statusSocial}`;
  document.getElementById('modalEscolaridade').innerText = `Escolaridade: ${escolaridade}`;

  // Aplicando a classe de cor para o status do evento
  const statusEventElement = document.getElementById('modalStatusEvento');
  statusEventElement.innerText = `Status do Evento: ${statusEvento}`;

  // Definir a classe CSS para o status
  let statusClass = '';
  switch (statusEvento) {
      case 'Concluído':
          statusClass = 'status-concluido';
          break;
      case 'Cancelado':
          statusClass = 'status-cancelado';
          break;
      case 'Em Andamento':
          statusClass = 'status-ativo';
          break;
      case 'Adiado':
          statusClass = 'status-pendente';
          break;
      default:
          statusClass = '';  // Caso o status não tenha uma correspondência
  }

  statusEventElement.className = statusClass; // Adiciona a classe ao status

  // Abre o modal
  document.getElementById('eventModal').style.display = 'block';
}

function closeModal() {
  document.getElementById('eventModal').style.display = 'none';
}


// Fechar o modal quando clicar fora dele
window.onclick = function(event) {
    if (event.target == document.getElementById('eventModal')) {
        closeModal();
    }
}






  
    




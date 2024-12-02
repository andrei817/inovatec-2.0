<?php
// Incluir o arquivo de conexão
include("php/Config.php");

// Verifica se o ID do objetivo foi passado via GET e é válido
if (!isset($_GET['excluir']) || !is_numeric($_GET['excluir'])) {
    echo "<script>alert('ID do objetivo não fornecido ou inválido.'); window.location.href='objetivo lista.php';</script>";
    exit();
}

$id_objetivo = intval($_GET['excluir']); // Converte o ID para inteiro de forma segura

// Atualizar os eventos para remover a referência ao objetivo (caso você não queira excluir os eventos)
$updateEventosSql = "UPDATE eventos SET objetivo_id = NULL WHERE objetivo_id = ?";
$stmt = $conn->prepare($updateEventosSql);
$stmt->bind_param("i", $id_objetivo); // 'i' para inteiro (id do objetivo)
$stmt->execute();
$stmt->close();

// Agora, excluir o objetivo
$deleteObjetivoSql = "DELETE FROM objetivo WHERE id = ?";
$stmt = $conn->prepare($deleteObjetivoSql);
$stmt->bind_param("i", $id_objetivo); // 'i' para inteiro (id do objetivo)
if ($stmt->execute()) {
    //echo "<script>alert('Objetivo excluído com sucesso!'); window.location.href='objetivo lista.php';</script>";
    header("Location: lista de objetivos.php");
    exit();
} else {
    echo "<script>alert('Erro ao excluir objetivo.'); window.location.href='objetivo lista.php';</script>";
}
$stmt->close();

?>

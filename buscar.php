<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

function responder(int $status, array $conteudo): void
{
    http_response_code($status);
    echo json_encode($conteudo, JSON_UNESCAPED_UNICODE);
    exit;
}

// Somente POST é permitido.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    responder(405, ['erro' => 'Método não permitido. Utilize POST.']);
}

$campo = $_POST['campo'] ?? null;
$valor = $_POST['valor'] ?? null;

// As colunas aceitas são definidas pelo servidor (lista de permissão).
$camposPermitidos = ['nome', 'email', 'cidade', 'estado', 'profissao', 'telefone'];

if (!is_string($campo) || !in_array($campo, $camposPermitidos, true)) {
    responder(400, ['erro' => 'Campo de busca inválido.']);
}

if (!is_string($valor) || trim($valor) === '') {
    responder(400, ['erro' => 'Informe um valor para buscar.']);
}

$valor = trim($valor);

try {
    $host = '127.0.0.1';
    $banco = 'atividade';
    $usuario = 'root';
    $senha = '';

    $pdo = new PDO(
        "mysql:host={$host};dbname={$banco};charset=utf8mb4",
        $usuario,
        $senha,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
    $sql = "SELECT id, nome, email, cidade, estado, profissao, telefone
            FROM clientes
            WHERE {$campo} LIKE :valor
            ORDER BY id";

    $consulta = $pdo->prepare($sql);
    $consulta->execute(['valor' => "%{$valor}%"]);
    responder(200, $consulta->fetchAll());
} catch (Throwable $erro) {
    error_log('Falha na busca de clientes: ' . $erro->getMessage());
    responder(500, ['erro' => 'Erro interno ao consultar os clientes.']);
}

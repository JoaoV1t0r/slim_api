<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Usuarios;
use \Firebase\JWT\JWT;

// Rota para geração de token
$app->post('/api/token', function (Request $request, Response $response) {
    $dados = $request->getParsedBody();
    $email = $dados['email'] ?? null;
    $senha = $dados['senha'] ?? null;

    $usuario = Usuarios::where('email', $email)->first();

    if (!is_null($usuario) && ($senha == $usuario->senha)) {
        //Gerar token
        $secretkey = $this->get('settings')['secretKey'];
        $chaveAcesso = JWT::encode($usuario, $secretkey);

        return $response->withJson([
            'chave' => $chaveAcesso
        ]);
    }

    return $response->withJson([
        'status' => 'Erro'
    ]);
});

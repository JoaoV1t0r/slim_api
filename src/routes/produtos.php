<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Produto;

// Routes
$app->group('/api/v1', function () {
	// Lista todos os Produtos
	$this->get('/produtos/lista', function (Request $request, Response $response) {
		$produtos = Produto::get();
		return $response->withJson($produtos);
	});

	// Retorna um Produto com base no Id
	$this->get('/produtos/lista/{id}', function (Request $request, Response $response, $args) {
		$produtos = Produto::findOrFail($args['id']);
		return $response->withJson($produtos);
	});

	// Adiciona Produtos 
	$this->post('/produtos/adiciona', function (Request $request, Response $response) {
		$dados = $request->getParsedBody();
		$produto = Produto::create($dados);
		return $response->withJson($produto);
	});

	// Atualiza dados de Produtos
	$this->put('/produtos/atualiza/{id}', function (Request $request, Response $response, $args) {
		$dados = $request->getParsedBody();
		$produto = Produto::findOrFail($args['id']);
		$produto->update($dados);
		return $response->withJson($produto);
	});

	// Remove dados de Produtos
	$this->delete('/produtos/remove/{id}', function (Request $request, Response $response, $args) {
		$produto = Produto::findOrFail($args['id']);
		$produto->delete($args['id']);
		return $response->withJson($produto);
	});
});

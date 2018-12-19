<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/api', function() {
    // Fetch the Dependency Injection container
    $container = $this->getContainer();

    $this->get('/category', function (Request $request, Response $response, array $args) {
        $db = new DbHandler();
        $result = $db->getCategoryList();
        return $response->withJson($result);
    });

    $this->get('/articlescategory/{id}', function (Request $request, Response $response, array $args) {
        $id = $args['id'];
        $db = new DbHandler();
        $result = $db->getArticlesByCategory($id);
        return $response->withJson($result);
    });

    $this->get('/article/{id}', function (Request $request, Response $response, array $args) {
        $id = $args['id'];
        $db = new DbHandler();
        $result = $db->getArticle($id);
        return $response->withJson($result);
    });
});

// Routes

$app->get('/about', function (Request $request, Response $response, array $args) {
    // Sample log message
    // $this->logger->info("Slim-Skeleton '/' route");
    
    // Render index view
    return $this->renderer->render($response, 'about.php', $args);
});

$app->get('/contact', function (Request $request, Response $response, array $args) {
    // Sample log message
    // $this->logger->info("Slim-Skeleton '/' route");
    
    // Render index view
    return $this->renderer->render($response, 'contact.php', $args);
});

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
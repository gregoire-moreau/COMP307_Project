<?php
require __DIR__ . '/vendor/autoload.php';
$c = new \Slim\Container();
$c['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        return $response->withStatus(500)
            ->withHeader('Content-Type', 'text/html')
            ->write('Something went wrong!');
    };
};
$app = new Slim\App;
$c = $app->getContainer();
$c['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        return $response->withStatus(500)
            ->withHeader('Content-Type', 'text/html')
            ->write('Something went wrong!');
    };
};

$app->get('/', function ($request, $response) {
    echo 'Hi';
});
$app->get('/query', function ($request, $response) {
    include 'index.html';
    return $response;
});
$app->post('/query', 'retrieve');
function retrieve(){
    require_once('dbaccess.php');
    $query = $_POST['query'];
    try{
        $result = $mysqli->query($query);
        while($row =  $result->fetch_assoc()){
            $data[] = $row;
        }
        if (isset($data)){
            echo json_encode($data);
        }
    }catch (Exception $e) {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
}
$app->run(); 

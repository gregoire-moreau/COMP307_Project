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
    include 'ABNBHome.html';
    return $response;
});

$app->post('/signup', function($request, $response) {
    require_once('dbaccess.php');
    $newUser = false;
    require_once('signup.php');
    if($newUser){
        require_once('newdog.php');
        include 'profile.html';
    }
});

$app->post('/login', function($request, $response) {
    require_once('dbaccess.php');
    require_once('login.php');
    include 'profile.html';
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

function checkField($fieldVal){
    return !(strlen($fieldVal) == 0);
}
$app->run(); 

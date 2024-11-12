<?php
/**
 * @var PDO $pdo
 */
global $pdo;

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../helper.php';
require_once '../Router.php';
require_once '../session.php';

$auth = authMiddleware($pdo);

$router = new Router();

$router->get('/index', '../index.php');
$router->post('/index', '../index.php');
$router->get('/signup', '../signup.php');
$router->post('/signup', '../signup.php');
$router->get('/login', '../login.php');
$router->post('/login', '../login.php');
$router->get('/main', '../main.php');
$router->get('/cars', '../cars.php');
$router->post('/cars', '../cars.php');
$router->get('/carts', '../carts.php');
$router->post('/carts', '../carts.php');

$url = parse_url($_SERVER['REQUEST_URI']) ['path'];
$method = $_SERVER['REQUEST_METHOD'];
$router->match($url, $method);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        a.butt {
            display: inline-block;
            background-color: #04AA6D;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            width: 100%;
            opacity: 0.9;
        }

        a.butt:hover {
            opacity: 1;
        }
    </style>
</head>
<body>

<?php if (!$auth) { ?>
    <a href="../signup" class="butt" style="width:auto;">Sign Up</a>
    <a href="../login" class="butt" style="width:auto;">LOGIN</a>

<?php } else { ?>
    <h1>You are already logged in! </h1>
    <a href="../logout"></a>
<?php } ?>

</body>
</html>

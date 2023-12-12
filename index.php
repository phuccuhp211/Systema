<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "889484";
    $database = "systema";
    try {
        $ketnoi = new PDO("mysql:host={$servername};port=4940;dbname={$database};charset=utf8mb4", "{$username}", "{$password}");
        $ketnoi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    catch (PDOException $e) {
        echo "Lỗi kết nối: " . $e->getMessage();
        exit;
    }

    define('bdt', '');
    define('urlmd', 'http://localhost'.bdt);
    define('urlc', urlmd.'/controllers/');
    define('urlm', urlmd.'/models/');
    define('urlv', urlmd.'/views/');

    $routes = [
        bdt.'/admin/' => 'admin_controller@index',
        bdt.'/adlogin/' => 'admin_controller@adlogin',
        bdt.'/dangxuat/' => 'admin_controller@dangxuat',
        bdt.'/manager/' => 'admin_controller@manager',
        bdt.'/manager/([a-zA-Z0-9._-]+)/' => 'admin_controller@manager',
        bdt.'/adbl/' => 'admin_controller@adbl',
        bdt.'/addpro/' => 'admin_controller@addpro',
        bdt.'/fixpro/([0-9]+)/' => 'admin_controller@fixpro',
        bdt.'/delpro/([0-9]+)/' => 'admin_controller@delpro',
        bdt.'/addcat/' => 'admin_controller@addcat',
        bdt.'/fixcat/([0-9]+)/' => 'admin_controller@fixcat',
        bdt.'/delcat/([0-9]+)/' => 'admin_controller@delcat',
        bdt.'/addpl/' => 'admin_controller@addpl',
        bdt.'/fixpl/([0-9]+)/' => 'admin_controller@fixpl',
        bdt.'/delpl/([0-9]+)/' => 'admin_controller@delpl',
        bdt.'/addus/' => 'admin_controller@addus',
        bdt.'/fixus/([0-9]+)/' => 'admin_controller@fixus',
        bdt.'/delus/([0-9]+)/' => 'admin_controller@delus',
        bdt.'/delbl/([0-9]+)/' => 'admin_controller@delbl',
        bdt.'/inf_cmt/' => 'admin_controller@info_cmt',
        bdt.'/addgg/' => 'admin_controller@addgg',
        bdt.'/fixgg/([0-9]+)/' => 'admin_controller@fixgg',
        bdt.'/delgg/([0-9]+)/' => 'admin_controller@delgg',
        /*-----------------------------------------------*/
        bdt.'/' => 'user_controller@index',
        bdt.'/config/' => 'user_controller@config',
        bdt.'/addcart/' => 'user_controller@addcart',
        bdt.'/logout/' => 'user_controller@logout',
        bdt.'/login/' => 'user_controller@login',
        bdt.'/regis/' => 'user_controller@regis',
        bdt.'/updatetk/([0-9]+)/' => 'user_controller@updatetk',
        bdt.'/doimatkhau/' => 'user_controller@doimatkhau',
        bdt.'/quenmk/' => 'user_controller@quenmatkhau',
        bdt.'/qmkvl/' => 'user_controller@qmkvl',
        bdt.'/admk/([0-9]+)/' => 'user_controller@admk',
        bdt.'/muangay/([0-9]+)/' => 'user_controller@muangay',
        bdt.'/giohang/' => 'user_controller@giohang',
        bdt.'/updatecart/' => 'user_controller@updatecart',
        bdt.'/thanhtoan/' => 'user_controller@thanhtoan',
        bdt.'/hoantat/' => 'user_controller@hoantat',
        bdt.'/hoadon/' => 'user_controller@hoadon',
        bdt.'/sendmail/' => 'user_controller@sendmail',
        bdt.'/reset/' => 'user_controller@reset',
        bdt.'/delcart/' => 'user_controller@delcart',
        bdt.'/delallcart/' => 'user_controller@delallcart',
        bdt.'/comments/' => 'user_controller@comments',
        bdt.'/sanpham/chitiet=([0-9]+)/' => 'user_controller@chitietsp',
        bdt.'/sanpham/([a-zA-Z0-9._-]+)/' => 'user_controller@getsp',
        bdt.'/sanpham/([a-zA-Z0-9._-]+)/page=([0-9]+)/' => 'user_controller@getsp',
        bdt.'/sanpham/([a-zA-Z0-9._-]+)/' => 'user_controller@getsp',
        bdt.'/sanpham/([a-zA-Z0-9._-]+)=([a-zA-Z0-9._-]+)/' => 'user_controller@getsp',
        bdt.'/sanpham/([a-zA-Z0-9._-]+)=([a-zA-Z0-9._-]+)/page=([0-9]+)/' => 'user_controller@getsp',
        bdt.'/sanpham/([a-zA-Z0-9._-]+)=([0-9]+)/' => 'user_controller@getsp',
        bdt.'/sanpham/([a-zA-Z0-9._-]+)=([0-9]+)/page=([0-9]+)/' => 'user_controller@getsp',
        bdt.'/sanpham/([a-zA-Z0-9._-]+)=([0-9]+)/' => 'user_controller@getsp',
        bdt.'/sanpham/([a-zA-Z0-9._-]+)=([0-9]+)/page=([0-9]+)/' => 'user_controller@getsp',
        bdt.'/ktbh/' => 'user_controller@ktbh',
        bdt.'/applymgg/' => 'user_controller@applymgg',
        bdt.'/rating/' => 'user_controller@rating'
    ];

    $currentPath = $_SERVER['REQUEST_URI'];

    foreach ($routes as $route => $action) {
        if (preg_match('/^' . str_replace('/', '\/', $route) . '$/', $currentPath, $matches)) {
            $parts = explode('@', $action);
            $controllerName = $parts[0];
            $actionName = $parts[1];

            require_once 'controllers/'.$controllerName.'.php';
            $controller = new $controllerName();

            if (isset($matches[1])) {
                $parameter = $matches[1];
                if (isset($matches[2])) {
                    $parameter2 = $matches[2];
                    if (isset($matches[3])) {
                        $parameter3 = $matches[3];
                        $controller->$actionName($parameter,$parameter2,$parameter3);
                    }
                    else $controller->$actionName($parameter,$parameter2);  
                }
                else $controller->$actionName($parameter);
            } 
            else $controller->$actionName();
            break;
        }
    }
?>
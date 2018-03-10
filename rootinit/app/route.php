<?php
if(isset($_SERVER['REDIRECT_URL'])){
	$url = $_SERVER['REDIRECT_URL'];
}
else{
	$url = '/';
}
//prefix独特的放上面，可能与多个重复的放下面
$route = [
[
	//middleware 适用于多个controller的公共项
	['prefix' => '/admin', 'place' => 'admin/', 'middleware' => ['AdminMiddleware']],
	//['prefix' => '/admin', 'middleware' => []],
	[
		//'' => 'AdminController@index',
	]
],
];

//找到url对应的method
function findcontroller($url, $route){
	$check = 0;
	$urlArray = explode('/', $url);
	$firstpartUrl = '/'.$urlArray[1];
	foreach($route as $group){
		//判断是否在该group里
		if($group[0]['prefix'] == '' || $group[0]['prefix'] == $firstpartUrl){
			//查找每个group第二个array的key值
			foreach(array_keys($group[1]) as $key){
				$fullurl = $group[0]['prefix'].$key;
				if($fullurl == $url){
					//找到所属middeware
					$middlewareArray = $group[0]['middleware'];
					foreach($middlewareArray as $middleware){
						include_once('middleware/'.$middleware.'.php');
						$middleware = 'middleware\\'.$middleware;
						$middlewareobject = new $middleware();
					}
					$check = 1;
					$act = explode('@', $group[1][$key]);
					$controllerplace = 'controller/'.$group[0]['place'].$act[0].'.php';
					//加上controller的namespace
					$controller = 'controller\\'.$act[0];
					//controller里的function
					$method = $act[1];
					include_once('controller/CommonController.php');
					include_once($controllerplace);
					$controllerobject = new $controller();
					$controllerobject->$method();
				}
			}
		}
	}	
	//如果没有匹配，看看是否是public的文件
	if($check == 0){
		echo '没找到该路径';
	}
}

findcontroller($url, $route);
?>
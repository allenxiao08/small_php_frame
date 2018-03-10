<?php 
$database = [
	'server_name' => 'localhost',
	'user_name'   => 'root',
	'password'    => 'usbw',
    'database'    => 'home',
	//'port'        => '3006', 
];
//$connect = mysqli_connect($database['server_name'], $database['user_name'], $database['password'], $database['database'], $database['port']);
$connect = mysqli_connect($database['server_name'], $database['user_name'], $database['password'], $database['database']);
$program_char = "utf8" ;
mysqli_set_charset($connect, $program_char);
if(!$connect){
	echo '数据库连接失败，请联系管理员，错误：'.mysqli_connect_error();
	exit;
}
//例子 记得在class里需要用$GLOBALS['connect']
// $sql = "select * from admin";
// DELETE FROM Person WHERE LastName = 'Wilson'
// UPDATE Person SET Address = 'Zhongshan 23', City = 'Nanjing' WHERE LastName = 'Wilson'
// "INSERT INTO product_type (name, name_en) VALUES ('sdf', 'sdf')";
// $result = mysqli_query($connect,$sql);
// $row = mysqli_fetch_array($result);
// echo  json_encode($row['name']);
// $sql = 'SELECT LAST_INSERT_ID()';
// $result = mysqli_query($GLOBALS['connect'],$sql);
// $row = mysqli_fetch_array($result);
// $product_id = $row[0];
?>
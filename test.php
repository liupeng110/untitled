<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
//$q = isset($_GET["q"]) ? intval($_GET["q"]) : '';
//
//if(empty($q)) {
//    echo '请选择一个网站';
//    $q="5";
//    //exit;
//}


//定义一个类,用到存放从数据库中取出的数据.
class User
{
    public $id ;
    public  $name ;
    public $url ;
    public $alexa ;
    public $country ;
}


$con = mysqli_connect('localhost','root','admin');
if (!$con)
{
    die('Could not connect: ' . mysqli_error($con));
}
// 选择数据库
mysqli_select_db($con,"test");
// 设置编码，防止中文乱码
mysqli_set_charset($con, "utf8");

$q =1;
$sql="SELECT * FROM Websites WHERE id = '".$q."'";

$result = mysqli_query($con,$sql);
if (!$result) {
    printf("connect Error: %s\n", mysqli_error($con));
    exit();
}

while($row = mysqli_fetch_array($result))
{
    $user =new User();
    $user->id = $row["id"];
    $user->name = $row["name"];
    $user->url = $row["url"];
    $user->alexa = $row["alexa"];
    $user->country = $row["country"];
    $data[]=$user;
}
$json = json_encode($data);//把数据转换为JSON数据.
echo "{".'"user"'.":".$json."}";

mysqli_close($con);
?>



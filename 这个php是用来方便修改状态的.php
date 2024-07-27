<body>
<?php

/*

Made by Pimeng
2024-07-28
遵循Apache-2.0开源协议

*/


// 检查 URL 参数是否存在
if(isset($_GET['key']) && isset($_GET['status'])){
    $key = $_GET['key'];
    $status = $_GET['status'];
} else {
    echo "缺少参数";
}
//开始创建数据库连接
//定义用户名、密码和数据库
$servername = "localhost";
$username = "";
$password = "";
$dbname = "data";
// 创建连接
$con = mysqli_connect($servername, $username, $password, $dbname);
// 检测连接
if (!$con) {
    die("连接错误: " . mysqli_connect_error());
}
// 核对URL传入密钥
if($key == ''){
    $access = "密钥核对正确";
    // 写入数据库状态
    // 这里的代码还有优化的空间，但是我不会（
    if ($status == '着了'){
         //先删除原先存在的数据，防止数据过多
        mysqli_query($con,"DELETE FROM web_data WHERE status='醒着'");
        mysqli_query($con,"DELETE FROM web_data WHERE status='着了'");
        $sql = "INSERT INTO web_data (status) VALUES ('着了')";
        if (mysqli_query($con, $sql)) {
                echo "已切换至：着了";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
    } else if ($status == '醒着') {
        //先删除原先存在的数据，防止数据过多
        mysqli_query($con,"DELETE FROM web_data WHERE status='着了'");
        mysqli_query($con,"DELETE FROM web_data WHERE status='醒着'");
        $sql = "INSERT INTO web_data (status) VALUES ('醒着')";
            if (mysqli_query($con, $sql)) {
                echo "已切换至：醒着";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
    } else {
    echo "未知状态";
}
}   else {
    print <<<EOT
    <p style="color:red ;">密钥错误</p>
    <script>console.error('密钥错误')</script>
EOT;
//密钥错误返回
}
mysqli_close($con);
?>
</body>
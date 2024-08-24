<?php
/*

Made by Pimeng
2024-08-24
请遵循Apache-2.0开源协议

*/

/*

这个文件可作为api使用
链接后面跟上
?key=密钥&status=状态&goc=获取还是修改&name=名字（适用于多人情景）

*/

//开始创建数据库连接
//定义用户名、密码和数据库
$servername = "localhost";// 数据库地址
$username = "";// 数据库用户名
$password = "";// 数据库密码
$dbname = "",// 数据库名

// 检查 URL 参数是否存在
if(isset($_GET['key']) && isset($_GET['status']) && isset($_GET['goc']) && isset($_GET['name'])){
    $key = $_GET['key'];
    $status = $_GET['status'];
    $goc = $_GET['goc'];
    $name = $_GET['name'];
} else {
    echo "缺少参数";
}

// 创建连接
$con = mysqli_connect($servername, $username, $password, $dbname);
// 检测连接
if (!$con) {
    die("连接错误: " . mysqli_connect_error());
}

// 核对URL传入密钥
if ($goc == 'change'){
    if($key == ''){//在这里定义你的密钥，可以是任意字符
        $access = "密钥核对正确";
        // 写入数据库状态
        // 这里的代码还有优化的空间，但是我不会（
        if ($status == '0'){
            //先删除原先存在的已知数据，防止数据过多
            mysqli_query($con,"DELETE FROM $name WHERE status='0'");
            mysqli_query($con,"DELETE FROM $name WHERE status='1'");
            mysqli_query($con,"DELETE FROM $name WHERE status='2'");
            $sql = "INSERT INTO $name (status) VALUES ('0')";
            if (mysqli_query($con, $sql)) {
                echo "已切换至：睡似了";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        } else if ($status == '1') {
            //先删除原先存在的数据，防止数据过多
            mysqli_query($con,"DELETE FROM $name WHERE status='0'");
            mysqli_query($con,"DELETE FROM $name WHERE status='1'");
            mysqli_query($con,"DELETE FROM $name WHERE status='2'");
            $sql = "INSERT INTO $name (status) VALUES ('1')";
            if (mysqli_query($con, $sql)) {
                echo "已切换至：醒着";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($con);
            }
        } else if ($status == '未知') {
            //先删除原先存在的数据，防止数据过多
            mysqli_query($con,"DELETE FROM $name WHERE status='着了'");
            mysqli_query($con,"DELETE FROM $name WHERE status='醒着'");
            mysqli_query($con,"DELETE FROM $name WHERE status='未知'");
            $sql = "INSERT INTO $name (status) VALUES ('2')";
            if (mysqli_query($con, $sql)) {
                echo "已切换至：未知";
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
}} else if ( $goc == 'get'){//此处直接返回状态
    $sql = "SELECT status FROM $name"; 
    $result = $con->query($sql);
    // 检查查询结果  
    if ($result->num_rows > 0) {  
        // 输出查询到的数据  
        while($row = $result->fetch_assoc()) {  
            echo $row["status"];  
            }  
        } else {  
            echo "没有找到匹配的结果";  
}  
}
mysqli_close($con);
?>
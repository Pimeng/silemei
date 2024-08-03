<?php

//这个文件可作为api使用
//链接后面跟上
//?key=密钥&status=状态&goc=获取还是修改

/*

Made by Pimeng
2024-08-03
遵循Apache-2.0开源协议

*/

// 检查 URL 参数是否存在
if(isset($_GET['key']) && isset($_GET['status']) && isset($_GET['goc'])){
    $key = $_GET['key'];
    $status = $_GET['status'];
    $goc = $_GET['goc']
} else {
    echo "缺少参数";
}

// 核对URL传入密钥
if ($goc == 'change'){
    if($key == ''){//在这里定义你的密钥，可以是任意字符
        //开始创建数据库连接
        //定义用户名、密码和数据库
        $access = "密钥核对正确";
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
}} else if ( $goc == 'get'){//此处直接返回状态
    $sql = "SELECT status FROM web_data"; 
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
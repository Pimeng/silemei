
// 注：此php文件可用于外部查询api，直接返回TEXT
// Made by Pimeng
// 2024-07-28
// 遵循Apache-2.0开源协议

<?php  
// 连接到数据库  
$servername = "localhost";  
$username = "";  // 您的数据库用户名  
$password = "";  // 您的数据库密码  
$dbname = "data";  

// 创建连接  
$conn = new mysqli($servername, $username, $password, $dbname);  

// 检查连接是否成功  
if ($conn->connect_error) {  
    die("连接失败: " . $conn->connect_error);  
    }  

// 查询数据库  
$sql = "SELECT status FROM web_data"; 
$result = $conn->query($sql);

    // 检查查询结果  
    if ($result->num_rows > 0) {  
        // 输出查询到的数据  
        while($row = $result->fetch_assoc()) {  
            echo $row["status"];  
            }  
        } else {  
            echo "没有找到匹配的结果";  
}  

// 关闭连接  
$conn->close();
?>
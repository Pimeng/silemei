
<!-- 
Made by Pimeng
2024-07-28
遵循Apache-2.0开源协议
-->

<html>
    <head>
        <title>皮梦睡似了吗？</title>
        <link rel="icon" href="https://q1.qlogo.cn/g?b=qq&nk=&s=640"><!-- 这里的nk=可以填上你的QQ号来自动获取QQ头像 -->
        <style>
        html {
            font-size: 25px;
        }
        rt {
            font-size: 0.6em;
        }
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }
        body {
            /* 这里的网址可以自定义用来做网页的背景图 */
            background: url('https://www.loliapi.com/acg/') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 30px;
            padding: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        </style>
    </head>
    <body>
        <?php
        $servername = "localhost"; //数据库地址
        $username = ""; //数据库用户名
        $password = ""; //数据库密码
        $dbname = "data"; //数据库表
        // 创建数据库连接
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // 检查连接
        if (!$conn) {
            die("连接失败: " . mysqli_connect_error());
        }
        $sql = "SELECT status FROM web_data";//选取数据表中的数据
        $result = mysqli_query($conn, $sql);
        $status_output = mysqli_fetch_assoc($result);
        $status_value = reset($status_output); // 获取数组中的第一个值 
        
print <<<EOF
        <div class="card">
        <a style="font-size: 2em;">皮梦睡<ruby>似<rt>sǐ</rt></ruby>了吗？</a>
        
        <div style="height: 20px;"></div>

        <a>皮梦当前应该是：<br><a id="status" style="font-size: 1.2em;"> $status_value </a></a>    
        <br>
        <a id="additional-info" style="font-size: 1em;"></a>
        
        <div style="height: 50px;"></div>

        
        <a>在任何情况下，电话都是最容易快速得到回答的通讯方式。</a>
        <div style="height: 10px;"></div>
        <a>通过这个页面，你可以知晓皮梦当前的状态。
            <br>
        </a>
    </div>
EOF;
        
        mysqli_close($conn);//关闭数据库连接
        ?>
        
    </body>
</html>
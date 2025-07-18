<?php
// 获取新闻ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 数据库连接
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admission";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 获取新闻详情
$sql = "SELECT title, content, publish_date FROM news WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['title'];
    $content = $row['content'];
    $date = $row['publish_date'];
} else {
    $title = "新闻不存在";
    $content = "您查看的新闻不存在或已被删除。";
    $date = "";
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - 招生动态</title>
    
</head>
<body>
    <div class="header">
        <h1>招生信息网</h1>
    </div>
        <div class="nav-tabs">
            <a href="index.php">首页</a>
            <a href="query.php">招生类型</a>
            <a href="网址放这里">报考指南</a>
            <a href="网址放这里">专业介绍</a>
            <a href="query.php">录取查询</a>
            <a href="consult.php">招生咨询</a>
            <a href="网址放这里">资料下载</a>
        </div>
    <div class="container">
        <div class="news-detail">
            <h1 class="news-title"><?php echo $title; ?></h1>
            <div class="news-date">发布日期: <?php echo $date; ?></div>
            <div class="news-content">
                <?php echo nl2br($content); ?>
            </div>
            <a href="news.php" class="back-link">← 返回新闻列表</a>
        </div>
    </div>
    <div class="footer">
        <div class="logo">
            <img src="logo.png" alt="Logo" class="logo-img">
        </div>
        <div class="links">
            <a href="https://www.ldpoly.edu.cn/">职业技术学院官网</a>
            <a href="#">学号</a>
            <a href="#">1班</a>
            <a href="admin.php">姓名</a>
        </div>
        <div class="qrcode">
            <img src="二维码.jpg" alt="二维码" class="qrcode-img">
        </div>
    </div>
</body>
</html>
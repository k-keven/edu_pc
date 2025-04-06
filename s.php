<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>没有数据</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f5f7fa;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        .container {
            text-align: center;
            padding: 40px 60px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 16px 0 rgba(0,0,0,0.1);
            min-width: 300px;
        }
        .icon {
            font-size: 64px;
            color: #909399;
            margin-bottom: 25px;
        }
        .message {
            font-size: 20px;
            color: #606266;
            margin-bottom: 35px;
        }
        .button-group {
            display: flex;
            gap: 20px;
            justify-content: center;
        }
        .button {
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s;
        }
        .refresh-button {
            background-color: #409EFF;
            color: white;
        }
        .home-button {
            background-color: #67C23A;
            color: white;
        }
        .button:hover {
            opacity: 0.8;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">🏃‍♂️</div>
        <div class="message">没有更多数据，请提示管理员增加</div>
        <div class="button-group">
            <button class="button refresh-button"   onclick="window.history.go(-1)">返回上一页</button>
            <button class="button home-button" onclick="window.location.href='index.php'">回到首页</button>
        </div>
    </div>
</body>
</html>
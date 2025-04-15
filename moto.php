<?php
session_start();

include_once("./config.php");


if($_SESSION['user_id'] ==''){
    header("location:login.php");
    exit;
}


?>

<html lang="zh-CN" data-dpr="1" style="font-size: 141.9px;">
 

<head>
    <style class="vjs-styles-defaults">
        .video-js {
            width: 300px;
            height: 150px;
        }

        .vjs-fluid {
            padding-top: 56.25%
        }
    </style>
    <meta charset="utf-8">
    <meta name="google" content="notranslate">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <title>理论速成-哈喽交规</title>
    <style>
        body {
            font-size: 14px; /* 调整基础字体大小 */
            font-family: "PingFang SC", "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        /* 科目导航项样式改进 */
        .styleone_nav_item {
            border-radius: 6px !important; /* 增大圆角 */
            transition: all 0.3s ease;
            margin-right: 12px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .styleone_nav_item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        /* 当前选中的导航项 */
        .stylenavcur {
            background-color: #1bb394 !important;
            color: white !important;
            font-weight: bold;
        }
        
        /* 试题列表样式优化 */
        .styleone_paper {
            padding: 10px 16px !important;
            border-radius: 6px !important;
            transition: all 0.3s ease;
            margin: 8px 10px 8px 0 !important;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            border: 1px solid rgba(27, 179, 148, 0.1);
        }
        
        .styleone_paper:hover {
            background-color: rgba(27, 179, 148, 0.1) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        
        .orange_bg {
            background-color: rgba(27, 179, 148, 0.05) !important;
            color: #333 !important;
            font-weight: 500;
        }
        
        /* 功能项样式优化 */
        .style_enter_item {
            margin-bottom: 15px;
        }
        
        .enter_item_box {
            border-radius: 8px !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05) !important;
            transition: all 0.3s ease;
            background-color: white;
            padding: 5px;
        }
        
        .enter_item_box:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
            transform: translateY(-2px);
        }
        
        .enter_item_text {
            font-weight: 500;
            font-size: 15px;
        }
        
        /* 切换考前冲刺按钮改进 */
        .chongci {
            background-color: #1bb394 !important;
            color: white !important;
            padding: 8px 16px !important;
            border-radius: 20px !important;
            font-weight: bold;
            box-shadow: 0 3px 8px rgba(27, 179, 148, 0.3);
            transition: all 0.3s ease;
        }
        
        .chongci:hover {
            background-color: #18a085 !important;
            box-shadow: 0 4px 12px rgba(27, 179, 148, 0.4);
            transform: translateY(-2px);
        }
        
        /* 头部LOGO区域优化 */
        .style_one_logo {
            padding: 5px 0;
        }
        
        /* LOGO颜色调整 */
        .style_one_logo .logo img {
            filter: invert(1) sepia(1) saturate(10) hue-rotate(42deg) brightness(1.1); /* 黄色滤镜效果 */
            background-color: #0a3b5c; /* 深蓝色背景 */
            border-radius: 8px; /* 轻微圆角 */
            padding: 5px; /* 增加内边距 */
            box-shadow: 0 2px 8px rgba(0,0,0,0.2); /* 添加阴影效果 */
        }
        
        /* 添加黄色边框效果 */
        .style_one_logo .logo {
            position: relative;
            display: inline-block;
        }
        
        .style_one_logo .logo::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border: 2px solid #ffff00;
            border-radius: 10px;
            pointer-events: none;
        }
        
        /* 移除悬停效果 */
        
        /* 用户信息区域 */
        .user_name {
            font-size: 15px;
            font-weight: 500;
        }
        
        /* 侧边栏样式增强 */
        .el-menu-item {
            transition: all 0.3s ease;
        }
        
        .el-menu-item:hover {
            background-color: rgba(27, 179, 148, 0.1) !important;
        }
        
        .el-menu-item.is-active {
            border-left: 3px solid #1bb394 !important;
        }

        /* 菜单容器背景美化 */
        .sidebar-container {
          background: #f2f6fa; /* 更改为浅灰蓝色背景 */
          box-shadow: 1px 0 5px rgba(0,0,0,0.1);
          border-radius: 0 3px 3px 0;
        }

        /* 美化菜单列表 */
        .el-menu-vertical {
          border-right: none !important;
          background: transparent !important;
        }

        /* 菜单项美化 */
        .el-menu-item {
          transition: all 0.25s ease;
          margin: 5px 0;
          border-radius: 4px !important;
          overflow: hidden;
        }

        /* 菜单项悬停效果 */
        .el-menu-item:hover {
          background: rgba(200, 230, 255, 0.5) !important;
          transform: translateX(3px);
          box-shadow: 0 2px 5px rgba(0,0,0,0.15);
        }

        /* 当前选中的菜单项 */
        .el-menu-item.is-active {
          background: #e6f5ff !important; /* 浅蓝色背景 */
          border-left: 3px solid #1e90ff !important;
          box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* 菜单项内容样式 */
        .tgg_sider_item {
          border-bottom: none !important;
        }

        .style_one_sider {
          padding: 8px 0;
        }

        /* 图标容器美化 - 移除圆形背景 */
        .tgg_sider_icon {
          width: 22px;
          height: 22px;
          display: flex;
          align-items: center;
          justify-content: center;
          background: transparent;
          margin-right: 10px;
          transition: all 0.25s ease;
        }

        /* 图标缩小处理 */
        .tgg_sider_icon img {
          width: 60px;
          height: 60px;
          object-fit: contain;
          opacity: 0.85;
          transition: all 0.25s ease;
        }

        /* 选中或悬停时图标效果 - 不使用背景色 */
        .el-menu-item:hover .tgg_sider_icon,
        .el-menu-item.is-active .tgg_sider_icon {
          background: transparent;
          transform: scale(1.05);
          box-shadow: none;
        }

        /* 悬停和选中时图标亮度提高 */
        .el-menu-item:hover .tgg_sider_icon img,
        .el-menu-item.is-active .tgg_sider_icon img {
          opacity: 1;
          filter: brightness(1.2);
        }

        /* 菜单文字样式 */
        .tgg_sider_text {
          font-size: 16px;
          font-weight: 600;
          transition: all 0.25s ease;
        }

        .el-menu-item:hover .tgg_sider_text,
        .el-menu-item.is-active .tgg_sider_text {
          color: #1e90ff !important;
          font-weight: 600;
          font-size: 18px;
        }

        /* 处理重复菜单问题 */
        .container-main .sidebar-container {
          display: none !important;
        }

        /* LOGO样式调整为文字 */
        .style_one_logo .logo.text-logo {
            color: #ffcc00; /* 明亮的黄色文字 */
            font-size: 24px;
            font-weight: bold;
            padding: 6px 18px;
            text-align: center;
            letter-spacing: 2px;
            min-width: 160px; /* 增加最小宽度 */
            font-family: "Microsoft YaHei", sans-serif;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
            position: relative;
            display: inline-block;
        }
        
        /* 移除旧的边框效果 */
        .style_one_logo .logo.text-logo::after {
            display: none;
        }
        
        /* 小车图标特殊样式 - 使其变成深色 */
        .el-menu-item.is-active .tgg_sider_icon img {
          filter: brightness(0.1) contrast(1.5); /* 应用深色滤镜 */
          opacity: 1;
        }
    </style>
    <link href="css/my.css" rel="stylesheet">
    <link href="enhanced-buttons.css" rel="stylesheet">
    <link href="updated-buttons.css" rel="stylesheet">
    <!--<script type="text/javascript" charset="utf-8" async="" src="https://pc.ikaos.com.cn/static/js/6_0e899817202a0f46c7b5.js"></script>-->
    <!--<script type="text/javascript" charset="utf-8" async="" src="https://pc.ikaos.com.cn/static/js/1_da3deda24d76a1601f63.js"></script>-->
    <!--<script type="text/javascript" charset="utf-8" async="" src="https://pc.ikaos.com.cn/static/js/0_d79a64e3611c2ba788ea.js"></script>-->
    <!--<script type="text/javascript" charset="utf-8" async="" src="https://pc.ikaos.com.cn/static/js/3_2641dbb3bda9b78fafb8.js"></script>-->
        <script src="./js/jquery-3.7.1.js"></script>

    <script src="./js/global.js"></script>

</head>

<body style="font-size: 12px;">
    <div class="bg-gray h100 el-scrollbar">
        <div class="el-scrollbar__wrap" style="margin-bottom: -15px; margin-right: -15px;">
            <div class="el-scrollbar__view">
                <div id="app" class="h100">
                    <div data-v-14e2f3dc="" class="w100 h100 tgg_wrap_layout"><!---->
                        <div data-v-14e2f3dc="" id="qrcode" style="display: none;"></div>
                        <div data-v-14e2f3dc="" class="tgg_box_layout h100">
                            <div data-v-14e2f3dc="" class="tgg_main_layout h10px"><!---->
                                <div data-v-14e2f3dc="" class="styleone">
                                    <div data-v-14e2f3dc="" class="style_one_header" style="opacity: 0;">
                                        这是一个占位标签
                                    </div>
                                    <div data-v-14e2f3dc="" class="style_one_header style_one_header_fiexd">
                                        <div data-v-14e2f3dc="" class="style_one_headerlt">
                                            <div data-v-14e2f3dc="" class="style_one_logo" style="margin-top: 0px;">
                                                <!-- <div data-v-14e2f3dc="" class="logo text-logo">哈喽交规</div> -->
                                                 <img src="./images/logo2.png" style="width: 200px;" /> 
                                            </div>
                                        </div>
                                        <div data-v-14e2f3dc="" class="style_one_headerrt">
                                            <div data-v-14e2f3dc="" class="style_one_headerrtbox">
                                                <div data-v-14e2f3dc=""
                                                    style="display: none; align-items: center; cursor: pointer;"><img
                                                        data-v-14e2f3dc=""
                                                        src="data:image/png;base64,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"
                                                        class="list"
                                                        style="height: 30px; margin-top: 3px; display: none;"></div>
                                                <div data-v-14e2f3dc="" class="style_one_headericons" style='margin-left:90px'>
                                                    哈喽交规祝您早日拿证,加盟电话 18718889289
                                                </div>
                                                <div data-v-14e2f3dc="" class="style_one_headeruser">
                                                    <div data-v-14e2f3dc="" class="user-info" style="font-size: 16px;">
                                                        <!-- 在用户名前添加时钟元素 -->
                                                        <span id="current-time" style="color: #f9f9f9; font-size: 16px; margin-right: 15px; font-weight: 500;"></span>
                                                        <span data-v-14e2f3dc="" class="user_name" style="margin-right: 30px; font-size: 16px;">
                                                            <?php echo $_SESSION['username']?></span> <img data-v-14e2f3dc=""
                                                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACkAAAAtCAMAAAAEL7LSAAAAAXNSR0IArs4c6QAAAeBQTFRFAAAA////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////YHepkwAAAJ90Uk5TAAECAwQHCAsNDxETFBUWFxkaHB4fICEiJSYnKy4wMTI1Nj0+QEFFRkdJS0xPUVJUVVdYW15fYWJjamxtbm9yc3Z3eHt8fX5/gIKDhIaIjI6Rk5WXmJmam52eoKKmp6iqq6ytsbKztba3uLy9vr/AwsPExcbHyMnKy8zOz9DR0tPU19jZ2tvc3d7f4OHi4+Tl5ufp6uzt7u/w8vP09fb3ar3ntAAAAhVJREFUOMvN1NdXE1EQwOERNIK9Y6XYjR1BUTR27IAdFFBRBCViEAXBKAoICZuKYjS5y+9f9SEJstnsLo/O09w53zm7d+7cK2KObf7BRTKfWDkMHfOSm6Yg+P/Kjfnkms1m2DzcZpZLhsZu5MJPgMckfZC6Z4QBQJ0wyVaAd3NhL6Cu5vnPtwDt/2AnoDXm3furJKib2dVpBclrFl3q+APxHel8bRR4YdnPb8B4On0KjC+2lGVBUB4RkS0xiO+3OaNLCiIFItIIdNme5nfQK0UWROD3Xlt5Toc3IjvjELCfkA0R0FbIReC2wywNQGKfPIGZI8ahCsMXQ6UBOC8jEC011Av7od5QOapDu/ghtNo4Lq6mW8bCrhA8kyAEihxuQXkURmQQxpxkRRi8EoYfJQ7SnYBu8UG0wkFWAW3SCdN7HOQZ4ILUAY8c5BAkDspu53egJAKT68Q1AfEyW1mtoE9EmoGXtlID/XimreHtNrBWQaBYROR57igbo+AzqMvpJ3gUUncsZQ+gudJ5vYKoxwI+TkGsKrvyAtqpvLApBqn7s8uiADB91+wKu5NA/5xK8QSQ8rtz4MmvAD5DbekUQOL1oWWzpfWVozqQep/7oT4F8Cvira12lx+oOftxUgGoh+Z/qvtJJhLBmUymh2vybXNVi4YxQtcXWvRua8NALKv00AfPcrtpKD32oKWnt6v1yuGcCyt/AeO+FwsCmjUxAAAAAElFTkSuQmCC"
                                                            alt="" style="width: 30px; height: 30px;"> <!----> <!---->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div data-v-14e2f3dc="" class="container w100 h100">
                                    <div data-v-667f0e36="" data-v-14e2f3dc="" class="sidebar-container el-scrollbar">
                                        <div class="el-scrollbar__wrap"
                                            style="margin-bottom: -15px; margin-right: -15px;">
                                            <div class="el-scrollbar__view">
                                                <ul data-v-667f0e36="" role="menubar" class="el-menu-vertical el-menu">
                                                    <li data-v-667f0e36="" role="menuitem" tabindex="-1"
                                                        class="el-menu-item" unique-opened="true"
                                                        style="padding-left: 20px;"><!---->
                                                        <div   onclick="location.href='bus.php'" data-v-667f0e36="" class="tgg_sider_item style_one_sider"
                                                            style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                                                            <div data-v-667f0e36="" class="style_one_sider_item">
                                                                <div data-v-667f0e36="" class="tgg_sider_icon">
<img data-v-667f0e36="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEMAAAAnCAMAAABjcQUNAAAAAXNSR0IArs4c6QAAAnNQTFRFAAAA////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////elH21QAAANB0Uk5TAAECAwQFBgcICQoLDA0PEBESExQVFhcYGRobHR4fICEiJSYnKCssLS4vMDEyMzQ1ODk6Ozw9P0BBQ0RFR0hJSktMTVBRUlNUVldYW11eX2BhYmNkZWZoamtsbm9zdHV2d3h5en+AgYOEhoeIiYqLjI2PkJGSlZaXmJydn6GjpaanqKmqrK2ur7CxsrO0tba3uLm6u76/wMHCw8TFxsfJy8zNzs/Q0dLT1NXW19na293f4OHi4+Tl5ufo6err7O3u7/Dx8vP09fb3+Pn6+/z9/oVf58YAAAODSURBVEjHpZb9X1NVHMc/d2tT1gZkgYKPmJkRZZRRRgYZqZVYWloJleZKLFSIlJIesMDHLIvWslCUQNSiPVCjLZjTPXPZvZ8/qR8uMAb3jgWf3+653/N+fc85n/P9HiBV92w/7ZOYqrjrzM7FyFSGF3pHqSbp2o6szBD63X9TS0P1d2fEqOyXycC3h96zWq3WOnuE0Y4DVqv1gxMekv7GTCDZX0fIH9cZlS/T/iH692QDgO6Bz+PkzaYMIM+5yIFn5mEaA1jWECJvtyybMY32KNlUCDUGCg+EyPCXM0GqBkjXU0Z1Bgr2B8nIV8vTp3EySjYWQIOBRe8HyUjbinSMTR7S+aRRk4G8t/8lY+eLtRE5Z2Lk4YXQZiD3DR8p2ko0GZv/IZ1lhnQM5OzykeLPD2mlcS5OHsxDWgayd3pJ8ZeH1RlbfOSfjxlmYMCy1UmOdpdPmV1gPW+z2QYTpLfTNkl2l0jpptuZqoHbJOWw29Hd9s6Dd4whyv6SOUuN2CsVStesESSjLXcBQCzjCYlAckmuobGxziUASHbm4v8rq/TDQZKj3+QAJC9YMBvpVrRJpLh3LgwIhSdI2V00Fwb0xW4yUTMnBszNpHR2bgzjS6T82xRG1v3rn1g5P+1O5q5d//gS3VgveZaU/0hhrGn2ySQddUV6DcKd5SdDJONdr1smGE5I5OV8AQAMb7rHO9zVTSbVg1h6MDze+zpWJhl+crBED0C325v0pGOL2oIW1yddLf5aBBgqJMoOXJTJ9kUCUPq7RPbXbaz6ZFAmv1OpEeZXh8l4V82GrccjZPjYPOiKblA6jddEkn277rMcCZIdxXpAKL+U4K3DG8qmqvoHMvjZQgDmaj/lgVJAt7y2Jg+mLxLKAmMyvZXzAUC/z6N176TOtUp9biQDb01kuKB1ZDziyiplqKJHixFpzVeK3ItxhhomGaW6V0mFPasFAMDz17QYsXalD5pfTjBYn2K30tojR2+IDFebAcDUMMzEldaWqTrrIfsqlBM6Tg5vm7bre/xkf5UJyKp1k47NxmkRSz+SOfLTOgFCwSGRib57p0UU2kVy5ELj0d4YOdqk0p0NFddJOfB9fUs/ycC7Kg56pHviHSWfKhFUIiyvJG0YOmZWs3LxuajyP9y8Sqd6XUwbLyslXPbsM2lc5ac/vR691fPxo5rvNyF/2yl3zGvfO/kN8R9cgOvxiwR8ywAAAABJRU5ErkJggg==" alt="">
                                                                </div> <span data-v-667f0e36=""
                                                                    class="tgg_sider_text ">小车 </span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li data-v-667f0e36="" role="menuitem" tabindex="-1"
                                                        class="el-menu-item  is-active" unique-opened="true"
                                                        style="padding-left: 20px;"><!---->
                                                        <div  onclick="location.href='bus.php'" data-v-667f0e36="" class="tgg_sider_item style_one_sider"
                                                            style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                                                            <div data-v-667f0e36="" class="style_one_sider_item">
                                                                <div data-v-667f0e36="" class="tgg_sider_icon"><img
                                                                        data-v-667f0e36=""
                                                                        src="data:image/png;base64,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"
                                                                        alt=""></div> <span data-v-667f0e36=""
                                                                    class="tgg_sider_text style_title_active">客车 </span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li data-v-667f0e36="" role="menuitem" tabindex="-1"
                                                        class="el-menu-item" unique-opened="true"
                                                        style="padding-left: 20px;"><!---->
                                                        <div   onclick="location.href='truck.php'"  data-v-667f0e36="" class="tgg_sider_item style_one_sider"
                                                            style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                                                            <div data-v-667f0e36="" class="style_one_sider_item">
                                                                <div data-v-667f0e36="" class="tgg_sider_icon"><img
                                                                        data-v-667f0e36=""
                                                                        src="data:image/png;base64,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"
                                                                        alt=""></div> <span data-v-667f0e36=""
                                                                    class="tgg_sider_text">货车 </span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li data-v-667f0e36="" role="menuitem" tabindex="-1"
                                                        class="el-menu-item" unique-opened="true"
                                                        style="padding-left: 20px;"><!---->
                                                        <div  onclick="location.href='moto.php'"   data-v-667f0e36="" class="tgg_sider_item style_one_sider"
                                                            style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                                                            <div data-v-667f0e36="" class="style_one_sider_item">
                                                                <div data-v-667f0e36="" class="tgg_sider_icon"><img
                                                                        data-v-667f0e36=""
                                                                        src="data:image/png;base64,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"
                                                                        alt=""></div> <span data-v-667f0e36=""
                                                                    class="tgg_sider_text">摩托车 </span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li data-v-667f0e36="" role="menuitem" tabindex="-1"
                                                        class="el-menu-item" unique-opened="true"
                                                        style="padding-left: 20px;"><!---->
                                                        <div data-v-667f0e36="" class="tgg_sider_item style_one_sider"
                                                            style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                                                            <div data-v-667f0e36="" class="style_one_sider_item">
                                                                <div data-v-667f0e36="" class="tgg_sider_icon"><img
                                                                        data-v-667f0e36=""
                                                                        src="data:image/png;base64,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"
                                                                        alt=""></div> <span data-v-667f0e36=""
                                                                    class="tgg_sider_text">三力测试 </span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <div data-v-667f0e36="" class="sider_left"></div>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="el-scrollbar__bar is-horizontal">
                                            <div class="el-scrollbar__thumb" style="transform: translateX(0%);"></div>
                                        </div>
                                        <div class="el-scrollbar__bar is-vertical">
                                            <div class="el-scrollbar__thumb"
                                                style="height: 42.6667%; transform: translateY(0%);"></div>
                                        </div>
                                    </div>
                                    <div data-v-14e2f3dc="" class="container-main marginLeft200">
                                        <div data-v-667f0e36="" data-v-14e2f3dc="" class="sidebar-container el-scrollbar">
                                            <div class="el-scrollbar__wrap"
                                                style="margin-bottom: -15px; margin-right: -15px;">
                                                <div class="el-scrollbar__view">
                                                  
                                                </div>
                                            </div>
                                            <div class="el-scrollbar__bar is-horizontal">
                                                <div class="el-scrollbar__thumb" style="transform: translateX(0%);"></div>
                                            </div>
                                            <div class="el-scrollbar__bar is-vertical">
                                                <div class="el-scrollbar__thumb"
                                                    style="height: 42.6667%; transform: translateY(0%);"></div>
                                            </div>
                                        </div>
                                        <div data-v-14e2f3dc="" class="container-main marginLeft200">
                                            <div data-v-667f0e36="" data-v-14e2f3dc="" class="sidebar-container el-scrollbar">
                                                <div class="el-scrollbar__wrap"
                                                    style="margin-bottom: -15px; margin-right: -15px;">
                                                    <div class="el-scrollbar__view">
                                                        
                                            </div>
                                        </div>
                                        <div class="el-scrollbar__bar is-horizontal">
                                            <div class="el-scrollbar__thumb" style="transform: translateX(0%);"></div>
                                        </div>
                                        <div class="el-scrollbar__bar is-vertical">
                                            <div class="el-scrollbar__thumb"
                                                style="height: 42.6667%; transform: translateY(0%);"></div>
                                        </div>
                                    </div>
                                    <div data-v-14e2f3dc="" class="container-main marginLeft200">
                                        <div data-v-63f17d6e="" data-v-14e2f3dc="" class="style_one_main">
                                            <div data-v-63f17d6e="" class="el-row">
                                                <div data-v-63f17d6e="" class="el-col el-col-24"></div>
                                            </div>
                                            <div data-v-63f17d6e="" class="styleone_top_wrap">
                                                <div data-v-63f17d6e="" class="styleone_top_box">
                                                    <div data-v-63f17d6e="" class="styleone_top_nav">
                                                        <div data-v-63f17d6e="" class="styleone_nav_item stylenavcur"
                                                            style="width: 50px; height: 45px; border-radius: 3px; line-height: 45px;">
                                                            <div data-v-63f17d6e="" class="styleone_navbox">科目一</div>
                                                        </div>
                                                        <div data-v-63f17d6e="" class="styleone_nav_item"
                                                            style="width: 50px; height: 45px; border-radius: 3px; line-height: 45px;">
                                                            <div data-v-63f17d6e="" class="styleone_navbox" onclick="location.href='car_k4.php'">科目四</div>
                                                        </div>
                                                        <div data-v-63f17d6e="" class="styleone_nav_item"
                                                            style="width: 50px; height: 45px; border-radius: 3px; line-height: 45px;">
                                                            <div data-v-63f17d6e="" class="styleone_navbox">注销恢复</div>
                                                        </div>
                                                        <div data-v-63f17d6e="" class="styleone_nav_item"
                                                            style="width: 50px; height: 45px; border-radius: 3px; line-height: 45px;">
                                                            <div data-v-63f17d6e="" class="styleone_navbox">满分学习</div>
                                                        </div>
                                                    </div>
                                                    
                                                <!--  onclick="javascript:alert('开发中')" --> 
                                                    <div data-v-63f17d6e="" class="styleone_top_listbox">
                                                        <div data-v-63f17d6e="" class="styleone_top_list">
                                                            <!--<ul data-v-63f17d6e="" class="styleone_list_item">-->
                                                            <!--    <li data-v-63f17d6e="" id="color_0"-->
                                                            <!--        class="styleone_paper orange_bg"-->
                                                            <!--        style="cursor: pointer;"><span-->
                                                            <!--            data-v-63f17d6e="" onclick="location.href='./practice.php?id=1&name=科目一必考题一&veh=1&color=333&course=1'">科目一必考题一</span></li>-->
                                                            <!--    <li data-v-63f17d6e="" id="color_0"-->
                                                            <!--        class="styleone_paper orange_bg"-->
                                                            <!--        style="cursor: pointer;" onclick="location.href='./practice.php?id=1&name=科目一必考题二&veh=1&color=333&course=1'" ><span-->
                                                            <!--            data-v-63f17d6e="">科目一必考题二</span></li>-->
                                                            <!--    <li data-v-63f17d6e="" id="color_0"-->
                                                            <!--        class="styleone_paper orange_bg"-->
                                                            <!--        style="cursor: pointer;"  onclick="location.href='./practice.php?id=1&name=科目一必考题二&veh=1&color=333&course=1'"  ><span-->
                                                            <!--            data-v-63f17d6e="">科目一必考题三</span></li>-->
                                                            <!--    <li data-v-63f17d6e="" id="color_0"-->
                                                            <!--        class="styleone_paper orange_bg"-->
                                                            <!--        style="cursor: pointer;"><span-->
                                                            <!--            data-v-63f17d6e=""  onclick="location.href='./practice.php?id=1&name=科目一必考题四&veh=1&color=333&course=1'" >科目一必考题四</span></li>-->
                                                            <!--    <li data-v-63f17d6e="" id="color_0"-->
                                                            <!--        class="styleone_paper orange_bg"-->
                                                            <!--        style="cursor: pointer;"  onclick="location.href='./practice.php?id=1&name=科目一必考题五&veh=1&color=333&course=1'" ><span-->
                                                            <!--            data-v-63f17d6e="">科目一必考题五</span></li>-->
                                                            <!--    <li data-v-63f17d6e="" id="color_0"-->
                                                            <!--        class="styleone_paper orange_bg"-->
                                                            <!--        style="cursor: pointer;"  onclick="location.href='./practice.php?id=1&name=科目一必考题六&veh=1&color=333&course=1'" ><span-->
                                                            <!--            data-v-63f17d6e="">科目一必考题六</span></li>-->
                                                            <!--</ul>-->
                                                            <!--<ul data-v-63f17d6e="" class="styleone_list_item">-->
                                                            <!--    <li data-v-63f17d6e="" id="color_1"-->
                                                            <!--        class="styleone_paper orange_bg"-->
                                                            <!--        style="cursor: pointer;"><span-->
                                                            <!--            data-v-63f17d6e=""  onclick="location.href='./strengthen.php?id=1&name=科目一强化试题一&veh=1&color=333&course=1'" >科目一强化试题一</span></li>-->
                                                            <!--    <li data-v-63f17d6e="" id="color_1"-->
                                                            <!--        class="styleone_paper orange_bg"-->
                                                            <!--        style="cursor: pointer;" onclick="location.href='./strengthen.php?id=1&name=科目一强化试题二&veh=1&color=333&course=1'"><span-->
                                                            <!--            data-v-63f17d6e="">科目一强化试题二</span></li>-->
                                                            <!--    <li data-v-63f17d6e="" id="color_1"-->
                                                            <!--        class="styleone_paper orange_bg"-->
                                                            <!--        style="cursor: pointer;"  onclick="location.href='./strengthen.php?id=1&name=科目一强化试题三&veh=1&color=333&course=1'"><span-->
                                                            <!--            data-v-63f17d6e="">科目一强化试题三</span></li>-->
                                                            <!--    <li data-v-63f17d6e="" id="color_1"-->
                                                            <!--        class="styleone_paper orange_bg"-->
                                                            <!--        style="cursor: pointer;"><span-->
                                                            <!--            data-v-63f17d6e="" onclick="location.href='./strengthen.php?id=1&name=科目一强化试题四&veh=1&color=333&course=1'">科目一强化试题四</span></li>-->
                                                            <!--    <li data-v-63f17d6e="" id="color_1"-->
                                                            <!--        class="styleone_paper orange_bg"-->
                                                            <!--        style="cursor: pointer;" onclick="location.href='./strengthen.php?id=1&name=科目一强化试题五&veh=1&color=333&course=1'"><span-->
                                                            <!--            data-v-63f17d6e="">科目一强化试题五</span></li>-->
                                                            <!--</ul>-->
                                                            <!--<ul data-v-63f17d6e="" class="styleone_list_item">-->
                                                            <!--    <li data-v-63f17d6e="" id="color_2"-->
                                                            <!--        class="styleone_paper orange_bg"-->
                                                            <!--        style="cursor: pointer;" onclick="location.href='./choose.php?id=1&name=科目一选做题一&veh=1&color=333&course=1'"><span-->
                                                            <!--            data-v-63f17d6e="">科目一选做题一</span></li>-->
                                                            <!--    <li data-v-63f17d6e="" id="color_2"-->
                                                            <!--        class="styleone_paper orange_bg"-->
                                                            <!--        style="cursor: pointer;"  onclick="location.href='./choose.php?id=1&name=科目一选做题二&veh=1&color=333&course=1'"><span-->
                                                            <!--            data-v-63f17d6e="">科目一选做题二</span></li>-->
                                                            <!--    <li data-v-63f17d6e="" id="color_2"-->
                                                            <!--        class="styleone_paper orange_bg"-->
                                                            <!--        style="cursor: pointer;"  onclick="location.href='./choose.php?id=1&name=科目一选做题三&veh=1&color=333&course=1'"><span-->
                                                            <!--            data-v-63f17d6e="">科目一选做题三</span></li>-->
                                                            <!--    <li data-v-63f17d6e="" id="color_2"-->
                                                            <!--        class="styleone_paper orange_bg"-->
                                                            <!--        style="cursor: pointer;" onclick="location.href='./choose.php?id=1&name=科目一选做题四&veh=1&color=333&course=1'"><span-->
                                                            <!--            data-v-63f17d6e="">科目一选做题四</span></li>-->
                                                            <!--    <li data-v-63f17d6e="" id="color_2"-->
                                                            <!--        class="styleone_paper orange_bg"-->
                                                            <!--        style="cursor: pointer;" onclick="location.href='./choose.php?id=1&name=科目一选做题五&veh=1&color=333&course=1'"><span-->
                                                            <!--            data-v-63f17d6e="">科目一选做题五</span></li>-->
                                                            <!--</ul>-->
                                                            
                                                            <h1> 即将添加 </h1>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-v-63f17d6e="" class="styleone_buttom_wrap">
                                                <!-- 删除现有的垂直排列的按钮代码 -->
                                                
                                                <!-- 新的水平排列布局开始 -->
                                                <div style="display: flex; position: relative; margin-top: 40px; width: 100%; max-width: 100%;">
                                                    <!-- 左侧功能区 -->
                                                    <div style="flex: 1; display: flex; flex-direction: column; width: 33.33%;">
                                                        <!-- 错题记录 -->
                                                        <div style="background-color: white; margin: 10px; padding: 20px; border-radius: 8px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                                                            <div style="display: flex; align-items: center;">
                                                                <div style="width: 30px; height: 30px; border-radius: 5px; background-color: rgba(255, 99, 71, 0.1); display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                                                    <span style="color: #ff6347; font-size: 18px;">×</span>
                                                                </div>
                                                                <span style="font-size: 15px; color: #333;">错题记录</span>
                                                            </div>

                                                            <div style="display: flex; align-items: center;">
                                                                <div style="width: 30px; height: 30px; border-radius: 5px; background-color: rgba(46, 204, 113, 0.1); display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                                                    <span style="color: #2ecc71; font-size: 18px;">✓</span>
                                                </div>
                                                                <span style="font-size: 15px; color: #333;">成绩记录</span>
                                                            </div>


                                                            <span style="color: #ccc; font-size: 18px;">›</span>
                                                        </div>
                                                        
                                                        <!-- 我的收藏 -->
                                                        <div style="background-color: white; margin: 10px; padding: 20px; border-radius: 8px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                                                            <div style="display: flex; align-items: center;">
                                                                <div style="width: 30px; height: 30px; border-radius: 5px; background-color: rgba(65, 105, 225, 0.1); display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                                                    <span style="color: royalblue; font-size: 18px;">★</span>
                                                    </div>
                                                                <span style="font-size: 15px; color: #333;">我的收藏</span>
                                                            </div>
                                                            <span style="color: #ccc; font-size: 18px;">›</span>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- 中间模拟考试按钮 -->
                                                    <div style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); z-index: 10; margin-top: 10px;">
                                                        <!-- 添加外层光晕效果 -->
                                                        <div style="position: relative; width: 240px; height: 240px; display: flex; align-items: center; justify-content: center;">
                                                            <!-- 第三层光晕 - 最外层 -->
                                                            <div style="position: absolute; width: 240px; height: 240px; border-radius: 50%; background-color: rgba(200, 230, 255, 0.15); z-index: 1;"></div>
                                                            <!-- 第二层光晕 - 中间层 -->
                                                            <div style="position: absolute; width: 200px; height: 200px; border-radius: 50%; background-color: rgba(180, 230, 255, 0.3); z-index: 2;"></div>
                                                            <!-- 第一层光晕 - 内层 -->
                                                            <div style="position: absolute; width: 170px; height: 170px; border-radius: 50%; background-color: rgba(160, 230, 255, 0.45); z-index: 3;"></div>
                                                            
                                                            <!-- 主按钮 -->
                                                            <a href="#/practice?type=4&amp;course=1&amp;color=333&amp;veh=1" style="text-decoration: none; position: relative; z-index: 4;">
                                                                <div style="width: 150px; height: 150px; border-radius: 50%; background-image: linear-gradient(to right bottom, #36d1dc, #5b86e5); display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                                                    <div style="color: white; font-size: 24px; font-weight: bold; text-align: center;">
                                                                        模拟考试
                                                    </div>
                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- 右侧功能区 -->
                                                    <div style="flex: 1; display: flex; flex-direction: column; width: 33.33%;">
                                                        <!-- 成绩记录 -->
                                                        <div style="background-color: white; margin: 10px; padding: 20px; border-radius: 8px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                                                            
                                                            <div style="display: flex; align-items: center; margin-left: 30%;">
                                                                <span style="color: #ccc; font-size: 18px;">›</span>
                                                                <div style="margin-left: 10px; background-color: #ff9800; color: white; padding: 6px 10px; border-radius: 20px; font-size: 13px; white-space: nowrap; box-shadow: 0 2px 5px rgba(255,152,0,0.3); transition: all 0.3s ease; cursor: pointer;">
                                                                    <span style="display: inline-block; transform: scale(0.9);">精选试卷</span>
                                                                </div>
                                                                <div style="margin-left: 8px; background-color: #e91e63; color: white; padding: 6px 10px; border-radius: 20px; font-size: 13px; white-space: nowrap; box-shadow: 0 2px 5px rgba(233,30,99,0.3); transition: all 0.3s ease; cursor: pointer;">
                                                                    <span style="display: inline-block; transform: scale(0.9);">考前急训</span>
                                                                </div>
                                                                <div style="margin-left: 8px; background-color: #1bb394; color: white; padding: 6px 10px; border-radius: 20px; font-size: 13px; white-space: nowrap; box-shadow: 0 2px 5px rgba(27,179,148,0.3); transition: all 0.3s ease; cursor: pointer;">切换考前冲刺</div>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- 字体设置 -->
                                                        <div style="background-color: white; margin: 10px; padding: 15px; border-radius: 8px; display: flex; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05); overflow: hidden; white-space: nowrap;">
                                                            <div style="display: flex; align-items: center; width: 100%; overflow: hidden; margin-left: 30%;">
                                                                <div style="min-width: 30px; height: 30px; border-radius: 5px; background-color: rgba(142, 68, 173, 0.1); display: flex; align-items: center; justify-content: center; margin-right: 15px; flex-shrink: 0;">
                                                                    <span style="color: #9b59b6; font-size: 18px;">Aa</span>
                                                                </div>
                                                                <span style="font-size: 15px; color: #333; margin-right: 10px; flex-shrink: 0;">字号大小</span>
                                                                <select style="padding: 5px; border: 1px solid #eee; border-radius: 4px; margin-right: 15px; flex-shrink: 1; max-width: 80px;">
                                                                    <option>请选择</option>
                                                                    <option>16px </option>
                                                                    <option>20px </option>

                                                                    <option>24px </option>

                                                                    <option> 30px</option>

                                                                    <option> 36px </option>
                                                                </select>
                                                                
                                                                <span style="font-size: 15px; color: #333; margin-right: 10px; margin-left: 5px; flex-shrink: 0;">字体颜色</span>
                                                                <select style="padding: 5px; border: 1px solid #eee; border-radius: 4px; flex-shrink: 1; max-width: 80px;">
                                                                    <option>请选择</option>
                                                                    <option>红色</option>
                                                                    <option>黑色</option>

                                                                    <option>蓝色</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- 水平排列布局结束 -->
                                                
                                                <!-- 删除原来下方的样式和按钮 -->
                                                <div data-v-63f17d6e="" class="style_enter_item" style="display: none;">
                                                    <div data-v-63f17d6e="" class="enter_item_box font_item_box">
                                                       <!-- 原代码被隐藏 -->
</div>
                                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="el-scrollbar__bar is-horizontal">
            <div class="el-scrollbar__thumb" style="transform: translateX(0%);"></div>
        </div>
        <div class="el-scrollbar__bar is-vertical">
            <div class="el-scrollbar__thumb" style="transform: translateY(0%);"></div>
        </div>
    </div>
    <!--<script type="text/javascript" src="https://pc.ikaos.com.cn/static/js/manifest_5c65e1a2795e5caa624c.js"></script>-->
    <!--<script type="text/javascript" src="https://pc.ikaos.com.cn/static/js/vendor_e738ee143ffc1afbf537.js"></script>-->
    <!--<script type="text/javascript" src="https://pc.ikaos.com.cn/static/js/app_5e726c4be90141cb7bc3.js"></script>-->
</body>

</html>
<script>
    // 更新时间的函数
    function updateTime() {
        const now = new Date();
        const year = now.getFullYear();
        const month = now.getMonth() + 1;
        const date = now.getDate();
        const dayNames = ["日", "一", "二", "三", "四", "五", "六"];
        const dayOfWeek = dayNames[now.getDay()];
        
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        
        // 格式化时间为 YYYY年MM月DD日 星期X HH:MM:SS
        const timeString = `${year}年${month}月${date}日 星期${dayOfWeek} ${hours}:${minutes}:${seconds}`;
        
        // 更新时间显示
        document.getElementById('current-time').textContent = timeString;
    }
    
    // 页面加载完成后立即显示时间
    document.addEventListener('DOMContentLoaded', function() {
        updateTime();
        // 设置定时器，每秒更新一次
        setInterval(updateTime, 1000);
    });
    
    
    // 将插件初始化代码添加到页面
    $(document).ready(function() {
      // 如果页面中没有jQuery，先添加jQuery
    //   if (typeof jQuery === 'undefined') {
    //     addJQueryToPage();
    //     // 等待jQuery加载完成
    //     var checkJQuery = setInterval(function() {
    //       if (typeof jQuery !== 'undefined') {
    //         clearInterval(checkJQuery);
    //         createCustomDialog();
    //       }
    //     }, 100);
    //   } else {
    //     createCustomDialog();
    //   }
   //   createCustomDialog();
      
      // 示例用法 - 为按钮添加点击事件
      $(document).on('click', '.show-dialog-example', function() {
        $.customDialog({
          title: '提示',
          content: '确定退出登录？',
          onCancel: function() {
            console.log('用户取消了操作');
          },
          onConfirm: function() {
            console.log('用户确认了操作');
            // 这里可以添加退出登录的逻辑
            // location.href = 'logout.php';
          }
        });
      });


// 成功提示（单按钮）
// $.customDialog.success('操作已成功完成！');

// 失败提示（单按钮）
// $.customDialog.error('操作执行失败，请重试！');

// 标准确认框（双按钮）
// $.customDialog({
//   title: '确认',
//   content: '是否确认删除该记录？',
//   onConfirm: function() {
//     // 删除操作
//   }
// });

    });
    
    
</script>
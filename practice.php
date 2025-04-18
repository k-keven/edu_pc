<?php
session_start();

include_once("./config.php");


if ($_SESSION['user_id'] == '') {
  header("location:login.php");
  exit;
}


if (empty($_REQUEST['name'])) {
  header("location:login.php");
  exit;
}
$sql = "select * from tests where 1 ";

$sql .= " and tips ='" . trim($_REQUEST['name']) . "' ";
$result = mysqli_query($link, $sql);

$i = 1;
while ($r = mysqli_fetch_assoc($result)) {
  $lists[$i] = $r;
  $i++;
}

if (empty($_REQUEST['course']) || $_REQUEST['course'] <= 0) {
  $course = 1;
} else {
  $course = $_REQUEST['course'];
}


if (empty($lists[$course]) || count($lists) <= 0) {

  include('s.php');
  die();
} else {
  $cur = $lists[$course];
}
// print_r($cur);

?>



<html lang="zh-CN" data-dpr="1" style="font-size: 143.8px;">

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

  <title>理论速成-哈喽交规</title>
  <style></style>
  <link href="css/my.css" rel="stylesheet">
  <script src="./js/jquery-3.7.1.js"></script>

  <script src="./js/global.js"></script>


  <script>
    var tmp = '<?php echo json_encode($lists); ?>';
    var cur = '<?php echo json_encode($cur) ?>';

    var curjson = JSON.parse(cur);

    var lists = JSON.parse(tmp);
  </script>
  <style>
    #table {
      border-collapse: collapse;
      width: 100%;
    }

    #table th,
    #table td {
      border: 1px solid #000;
      /*padding: 8px;*/
      text-align: center;
    }

    .header {
      background-color: #a8d1ff;
    }

    /* 添加选中效果的CSS */
    #table td.selected {
      background-color: #ffeb3b;
      /* 选中后的背景色为黄色 */
      font-weight: bold;
      /* 选中后文字加粗 */
    }

    /* 鼠标悬停效果 */
    #table td:not(.header):hover {
      background-color: #f5f5f5;
      /* 悬停时的背景色为浅灰色 */
      cursor: pointer;
      /* 鼠标变为手型 */
      transition: background-color 0.3s;
      /* 添加过渡效果 */
    }
  </style>



</head>

<body ondragstart="return false" oncontextmenu="return false" onselectstart="return false" style="font-size: 12px;" class="">
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
                        <div data-v-14e2f3dc="" class="logo">



                        </div>
                      </div>
                    </div>
                    <div data-v-14e2f3dc="" class="style_one_headerrt">
                      <div data-v-14e2f3dc="" class="style_one_headerrtbox">
                        <div data-v-14e2f3dc="" style="display: flex; align-items: center; cursor: pointer;"><img data-v-14e2f3dc="" src="data:image/png;base64,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" class="list" style="height: 30px; margin-top: 3px;" onclick="location.href='index.php'"></div>
                        <div data-v-14e2f3dc="" class="style_one_headericons">
                          哈喽交规 , 加盟电话 18202058117
                        </div>
                        <div data-v-14e2f3dc="" class="style_one_headeruser">
                          <div data-v-14e2f3dc="" class="user-info"><span data-v-14e2f3dc="" class="user_name" style="margin-right: 30px;"> 202304178</span> <img data-v-14e2f3dc="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACkAAAAtCAMAAAAEL7LSAAAAAXNSR0IArs4c6QAAAeBQTFRFAAAA////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////YHepkwAAAJ90Uk5TAAECAwQHCAsNDxETFBUWFxkaHB4fICEiJSYnKy4wMTI1Nj0+QEFFRkdJS0xPUVJUVVdYW15fYWJjamxtbm9yc3Z3eHt8fX5/gIKDhIaIjI6Rk5WXmJmam52eoKKmp6iqq6ytsbKztba3uLy9vr/AwsPExcbHyMnKy8zOz9DR0tPU19jZ2tvc3d7f4OHi4+Tl5ufp6uzt7u/w8vP09fb3ar3ntAAAAhVJREFUOMvN1NdXE1EQwOERNIK9Y6XYjR1BUTR27IAdFFBRBCViEAXBKAoICZuKYjS5y+9f9SEJstnsLo/O09w53zm7d+7cK2KObf7BRTKfWDkMHfOSm6Yg+P/Kjfnkms1m2DzcZpZLhsZu5MJPgMckfZC6Z4QBQJ0wyVaAd3NhL6Cu5vnPtwDt/2AnoDXm3furJKib2dVpBclrFl3q+APxHel8bRR4YdnPb8B4On0KjC+2lGVBUB4RkS0xiO+3OaNLCiIFItIIdNme5nfQK0UWROD3Xlt5Toc3IjvjELCfkA0R0FbIReC2wywNQGKfPIGZI8ahCsMXQ6UBOC8jEC011Av7od5QOapDu/ghtNo4Lq6mW8bCrhA8kyAEihxuQXkURmQQxpxkRRi8EoYfJQ7SnYBu8UG0wkFWAW3SCdN7HOQZ4ILUAY8c5BAkDspu53egJAKT68Q1AfEyW1mtoE9EmoGXtlID/XimreHtNrBWQaBYROR57igbo+AzqMvpJ3gUUncsZQ+gudJ5vYKoxwI+TkGsKrvyAtqpvLApBqn7s8uiADB91+wKu5NA/5xK8QSQ8rtz4MmvAD5DbekUQOL1oWWzpfWVozqQep/7oT4F8Cvira12lx+oOftxUgGoh+Z/qvtJJhLBmUymh2vybXNVi4YxQtcXWvRua8NALKv00AfPcrtpKD32oKWnt6v1yuGcCyt/AeO+FwsCmjUxAAAAAElFTkSuQmCC" alt="" style="width: 30px; height: 30px;"> <!----> <!----></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div data-v-14e2f3dc="" class="container w100 h100">
                  <div data-v-667f0e36="" data-v-14e2f3dc="" class="sidebar-container el-scrollbar">
                    <div class="el-scrollbar__wrap" style="margin-bottom: -15px; margin-right: -15px;">
                      <div class="el-scrollbar__view">
                        <ul data-v-667f0e36="" role="menubar" class="el-menu-vertical el-menu--collapse el-menu">
                          <li data-v-667f0e36="" role="menuitem" tabindex="-1" class="el-menu-item is-active is-disabled" unique-opened="true" style="padding-left: 20px;"><!---->
                            <div data-v-667f0e36="" class="tgg_sider_item style_one_sider" style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                              <div data-v-667f0e36="" class="style_one_sider_item">
                                <div data-v-667f0e36="" class="tgg_sider_icon"><img data-v-667f0e36="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEMAAAAnCAMAAABjcQUNAAAAAXNSR0IArs4c6QAAAnNQTFRFAAAA////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////elH21QAAANB0Uk5TAAECAwQFBgcICQoLDA0PEBESExQVFhcYGRobHR4fICEiJSYnKCssLS4vMDEyMzQ1ODk6Ozw9P0BBQ0RFR0hJSktMTVBRUlNUVldYW11eX2BhYmNkZWZoamtsbm9zdHV2d3h5en+AgYOEhoeIiYqLjI2PkJGSlZaXmJydn6GjpaanqKmqrK2ur7CxsrO0tba3uLm6u76/wMHCw8TFxsfJy8zNzs/Q0dLT1NXW19na293f4OHi4+Tl5ufo6err7O3u7/Dx8vP09fb3+Pn6+/z9/oVf58YAAAODSURBVEjHpZb9X1NVHMc/d2tT1gZkgYKPmJkRZZRRRgYZqZVYWloJleZKLFSIlJIesMDHLIvWslCUQNSiPVCjLZjTPXPZvZ8/qR8uMAb3jgWf3+653/N+fc85n/P9HiBV92w/7ZOYqrjrzM7FyFSGF3pHqSbp2o6szBD63X9TS0P1d2fEqOyXycC3h96zWq3WOnuE0Y4DVqv1gxMekv7GTCDZX0fIH9cZlS/T/iH692QDgO6Bz+PkzaYMIM+5yIFn5mEaA1jWECJvtyybMY32KNlUCDUGCg+EyPCXM0GqBkjXU0Z1Bgr2B8nIV8vTp3EySjYWQIOBRe8HyUjbinSMTR7S+aRRk4G8t/8lY+eLtRE5Z2Lk4YXQZiD3DR8p2ko0GZv/IZ1lhnQM5OzykeLPD2mlcS5OHsxDWgayd3pJ8ZeH1RlbfOSfjxlmYMCy1UmOdpdPmV1gPW+z2QYTpLfTNkl2l0jpptuZqoHbJOWw29Hd9s6Dd4whyv6SOUuN2CsVStesESSjLXcBQCzjCYlAckmuobGxziUASHbm4v8rq/TDQZKj3+QAJC9YMBvpVrRJpLh3LgwIhSdI2V00Fwb0xW4yUTMnBszNpHR2bgzjS6T82xRG1v3rn1g5P+1O5q5d//gS3VgveZaU/0hhrGn2ySQddUV6DcKd5SdDJONdr1smGE5I5OV8AQAMb7rHO9zVTSbVg1h6MDze+zpWJhl+crBED0C325v0pGOL2oIW1yddLf5aBBgqJMoOXJTJ9kUCUPq7RPbXbaz6ZFAmv1OpEeZXh8l4V82GrccjZPjYPOiKblA6jddEkn277rMcCZIdxXpAKL+U4K3DG8qmqvoHMvjZQgDmaj/lgVJAt7y2Jg+mLxLKAmMyvZXzAUC/z6N176TOtUp9biQDb01kuKB1ZDziyiplqKJHixFpzVeK3ItxhhomGaW6V0mFPasFAMDz17QYsXalD5pfTjBYn2K30tojR2+IDFebAcDUMMzEldaWqTrrIfsqlBM6Tg5vm7bre/xkf5UJyKp1k47NxmkRSz+SOfLTOgFCwSGRib57p0UU2kVy5ELj0d4YOdqk0p0NFddJOfB9fUs/ycC7Kg56pHviHSWfKhFUIiyvJG0YOmZWs3LxuajyP9y8Sqd6XUwbLyslXPbsM2lc5ac/vR691fPxo5rvNyF/2yl3zGvfO/kN8R9cgOvxiwR8ywAAAABJRU5ErkJggg==" alt=""></div> <span data-v-667f0e36="" class="tgg_sider_text style_title_active">小车 </span>
                              </div>
                            </div>
                          </li>
                          <li data-v-667f0e36="" role="menuitem" tabindex="-1" class="el-menu-item is-disabled" unique-opened="true" style="padding-left: 20px;"><!---->
                            <div data-v-667f0e36="" class="tgg_sider_item style_one_sider" style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                              <div data-v-667f0e36="" class="style_one_sider_item">
                                <div data-v-667f0e36="" class="tgg_sider_icon"><img data-v-667f0e36="" src="data:image/png;base64,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" alt=""></div> <span data-v-667f0e36="" class="tgg_sider_text">客车 </span>
                              </div>
                            </div>
                          </li>
                          <li data-v-667f0e36="" role="menuitem" tabindex="-1" class="el-menu-item is-disabled" unique-opened="true" style="padding-left: 20px;"><!---->
                            <div data-v-667f0e36="" class="tgg_sider_item style_one_sider" style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                              <div data-v-667f0e36="" class="style_one_sider_item">
                                <div data-v-667f0e36="" class="tgg_sider_icon"><img data-v-667f0e36="" src="data:image/png;base64,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" alt=""></div> <span data-v-667f0e36="" class="tgg_sider_text">货车 </span>
                              </div>
                            </div>
                          </li>
                          <li data-v-667f0e36="" role="menuitem" tabindex="-1" class="el-menu-item is-disabled" unique-opened="true" style="padding-left: 20px;"><!---->
                            <div data-v-667f0e36="" class="tgg_sider_item style_one_sider" style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                              <div data-v-667f0e36="" class="style_one_sider_item">
                                <div data-v-667f0e36="" class="tgg_sider_icon"><img data-v-667f0e36="" src="data:image/png;base64,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" alt=""></div> <span data-v-667f0e36="" class="tgg_sider_text">摩托车 </span>
                              </div>
                            </div>
                          </li>
                          <li data-v-667f0e36="" role="menuitem" tabindex="-1" class="el-menu-item is-disabled" unique-opened="true" style="padding-left: 20px;"><!---->
                            <div data-v-667f0e36="" class="tgg_sider_item style_one_sider" style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
                              <div data-v-667f0e36="" class="style_one_sider_item">
                                <div data-v-667f0e36="" class="tgg_sider_icon"><img data-v-667f0e36="" src="data:image/png;base64,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" alt=""></div> <span data-v-667f0e36="" class="tgg_sider_text">三力测试 </span>
                              </div>
                            </div>
                          </li>
                          <div data-v-667f0e36="" class="sider_left"></div>
                        </ul>
                      </div>
                    </div>
                    <div class="el-scrollbar__bar is-horizontal">
                      <div class="el-scrollbar__thumb" style="width: 0.666667%; transform: translateX(0%);"></div>
                    </div>
                    <div class="el-scrollbar__bar is-vertical">
                      <div class="el-scrollbar__thumb" style="height: 58.8652%; transform: translateY(0%);"></div>
                    </div>
                  </div>
                  <div data-v-14e2f3dc="" class="container-main marginLeft65">
                    <div data-v-69824944="" data-v-14e2f3dc="" element-loading-text="拼命加载中" element-loading-spinner="el-icon-loading" element-loading-background="rgba(0, 0, 0, 0.5)" class="w100 h100 practice-wrap" style="background-color: rgb(255, 255, 255);"><audio data-v-69824944="" id="audio" src="http://video.ikaos.com.cn/uploads/test/1_1.mp3"></audio> <audio data-v-69824944="" id="musicMp3" src="http://video.ikaos.com.cn/uploads/test/1_2.mp3"></audio>
                      <div data-v-69824944="" class="practice-con h100 el-row">
                        <div data-v-69824944="" class="h100 el-col el-col-24" style="display: flex; flex-flow: row; flex: 2 0 0%;">
                          <div data-v-69824944="" class="sub-wrap">
                            <div data-v-69824944="" class="exam-user-info-box">
                              <div data-v-69824944="" class="exam-title-box">
                                <div data-v-69824944="" class="title" style="background-color: rgb(255, 255, 255);"><span data-v-69824944="">理论速成</span></div>
                                <div data-v-69824944="" style="font-size: 20px; color: rgb(255, 102, 102); font-weight: 900;">
                                  第001考台
                                </div>
                              </div>
                              <div data-v-69824944="" class="exam-user-box">
                                <div data-v-69824944="" class="title" style="background-color: rgb(255, 255, 255);">
                                  考生信息
                                </div>
                                <div data-v-69824944="" class="user-Info"><span data-v-69824944="" class="el-avatar el-avatar--circle" style="height: 60px; width: 60px; line-height: 60px;"><img src="http://pc.ikaos.com.cn/touxiang.png" style="object-fit: cover;"></span></div>
                                <div data-v-69824944="" class="exam-info-item" style="margin-top: 15px;">
                                  <div data-v-69824944="" class="exam-info-box">
                                    <div data-v-69824944="" style="margin-top: 15px;"><span data-v-69824944="" style="font-weight: bold;">考生姓名：</span> <?= $_SESSION['username'] ?>
                                    </div>
                                    <div data-v-69824944="" style="margin-top: 15px;"><span data-v-69824944="" style="font-weight: bold; text-align: center;">考试车型：</span> <?php echo $cur['cate_name']; ?>
                                    </div> <!---->
                                    <div data-v-69824944="" style="margin-top: 15px;">
                                      <div data-v-69824944=""><span data-v-69824944="" style="font-weight: bold;">科　　目：</span><?php echo $cur['tips']; ?>
                                      </div>
                                    </div>
                                    <div data-v-69824944="" style="margin-top: 15px;"><span data-v-69824944="" style="font-weight: bold;">申请原因：</span> <?php echo $cur['suject']; ?>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div data-v-69824944="" class="exam-timer">
                                <div data-v-7ec56ece="" data-v-69824944="" class="record-item" style="font-size: 25px; position: relative; height: 100%; line-height: 58px; color: rgb(255, 102, 102);">
                                  <div data-v-7ec56ece="" class="title" style="background-color: rgb(255, 255, 255);">
                                    剩余时间
                                  </div> <span data-v-7ec56ece="" class="minute" style="color: rgb(255, 102, 102); font-weight: 900; font-size: 16px;">34</span>
                                  :
                                  <span data-v-7ec56ece="" class="second" style="color: rgb(255, 102, 102); font-weight: 900; font-size: 16px;">53</span>
                                </div>
                              </div>
                            </div>
                            <div data-v-32239fca="" data-v-69824944="" class="subject-wrap w100 h100"><audio data-v-32239fca=""></audio>
                              <div data-v-32239fca="" class="sub-box">
                                <div data-v-32239fca="" class="sub-title font27">
                                  <div data-v-32239fca=""><!----> <span data-v-32239fca="" style="white-space: nowrap; color: rgb(51, 51, 51);">1.</span> <!---->

                                    <span data-v-32239fca="" style="color: rgb(51, 51, 51);"><span data-v-32239fca="">

                                        <?php if ($cur['type'] == '1') {

                                          echo '	(判断题)';
                                        } else if ($cur['type'] == '2') {

                                          echo '	(单选题)';
                                        } else if ($cur['type'] == '3') {

                                          echo '	(多选题)';
                                        }

                                        ?>

                                      </span> <span data-v-32239fca="" class="title_news_box" style="color: rgb(51, 51, 51);">
                                        <?php echo $cur['question']; ?>
                                      </span></span>
                                  </div>
                                </div>
                                <div data-v-32239fca="" class="sub-answer-wrap">
                                  <div data-v-32239fca="" class="sub-answer" style="width:100%; color: rgb(51, 51, 51);">

                                    <?php if ($cur['type'] == '1') : ?>
                                      <?php if ($cur['ex1'] != '') : ?>
                                        <div data-v-32239fca="" id='s1' attr='<?= $cur['ex1'] ?>' class="sub-answer-item font27">
                                          A：<?= $cur['ex1'] ?>
                                        </div>
                                      <?php endif; ?>
                                      <!--<div data-v-32239fca="" class="sub-answer-item font27">-->
                                      <!--  B:错误-->
                                      <!--</div>-->

                                      <?php if ($cur['ex2'] != '') : ?>
                                        <div data-v-32239fca="" id='s2' attr='<?= $cur['ex2'] ?>' class="sub-answer-item font27">
                                          B：<?= $cur['ex2'] ?>
                                        </div>
                                      <?php endif; ?>


                                    <?php endif; ?>
                                    <!-- 单选题 -->
                                    <?php if ($cur['type'] == '2') : ?>

                                      <?php if ($cur['ex1'] != '') : ?>
                                        <div data-v-32239fca="" id='s1' attr='<?= $cur['ex1'] ?>' class="sub-answer-item font27">
                                          A：<?= $cur['ex1'] ?>
                                        </div>
                                      <?php endif; ?>

                                      <?php if ($cur['ex2'] != '') : ?>
                                        <div data-v-32239fca="" id='s2' attr='<?= $cur['ex2'] ?>' class="sub-answer-item font27">
                                          B：<?= $cur['ex2'] ?>
                                        </div>
                                      <?php endif; ?>



                                      <?php if ($cur['ex3'] != '') : ?>
                                        <div data-v-32239fca="" id='s3' attr='<?= $cur['ex3'] ?>' class="sub-answer-item font27">
                                          C：<?= $cur['ex3'] ?>
                                        </div>
                                      <?php endif; ?>


                                      <?php if ($cur['ex4'] != '') : ?>
                                        <div data-v-32239fca="" id='s4' attr='<?= $cur['ex4'] ?>' class="sub-answer-item font27">
                                          D：<?= $cur['ex4'] ?>
                                        </div>
                                      <?php endif; ?>


                                    <?php endif; ?>

                                    <!-- 多选题 -->
                                    <?php if ($cur['type'] == '3') : ?>

                                      <?php if ($cur['ex1'] != '') : ?>
                                        <div data-v-32239fca="" id='s1' attr='<?= $cur['ex1'] ?>' class="sub-answer-item font27">
                                          A：<?= $cur['ex1'] ?>
                                        </div>
                                      <?php endif; ?>

                                      <?php if ($cur['ex2'] != '') : ?>
                                        <div data-v-32239fca="" id='s2' attr='<?= $cur['ex2'] ?>' class="sub-answer-item font27">
                                          B：<?= $cur['ex2'] ?>
                                        </div>
                                      <?php endif; ?>



                                      <?php if ($cur['ex3'] != '') : ?>
                                        <div data-v-32239fca="" id='s3' attr='<?= $cur['ex3'] ?>' class="sub-answer-item font27">
                                          C： <?= $cur['ex3'] ?>
                                        </div>
                                      <?php endif; ?>


                                      <?php if ($cur['ex4'] != '') : ?>
                                        <div data-v-32239fca="" id='s4' attr='<?= $cur['ex4'] ?>' class="sub-answer-item font27">
                                          D： <?= $cur['ex4'] ?>
                                        </div>
                                      <?php endif; ?>


                                    <?php endif; ?>


                                  </div> <!-- 图片 ？ -->
                                  <div>
                                    <?php if ($cur['question_img'] != '') : ?>

                                      <div data-v-2ef02a07="" class="el-image sub-img"><img src="https://images.halou68.com/<?= $cur['question_img'] ?>" class="el-image__inner el-image__preview" style="object-fit: scale-down;">
                                        <div tabindex="-1" class="el-image-viewer__wrapper" style="z-index: 2000; display: none;">
                                          <div class="el-image-viewer__mask"></div><span class="el-image-viewer__btn el-image-viewer__close"><i class="el-icon-circle-close"></i></span><!---->
                                          <div class="el-image-viewer__btn el-image-viewer__actions">
                                            <div class="el-image-viewer__actions__inner"><i class="el-icon-zoom-out"></i><i class="el-icon-zoom-in"></i><i class="el-image-viewer__actions__divider"></i><i class="el-icon-full-screen"></i><i class="el-image-viewer__actions__divider"></i><i class="el-icon-refresh-left"></i><i class="el-icon-refresh-right"></i></div>
                                          </div>
                                          <div class="el-image-viewer__canvas"><img src="http://video.ikaos.com.cn//uploads/new/K1Z2.S040.JPG" class="el-image-viewer__img" style="transform: scale(0.805) rotate(0deg); margin-left: 0px; margin-top: 0px; max-height: 100%; max-width: 100%;"></div>
                                        </div>
                                      </div>


                                    <?php endif;  ?>
                                  </div>

                                  <!---->
                                </div> <span data-v-32239fca=""><span data-v-32239fca="" class="skill-txt font27" style="display: none;" id='skills'>
                                    <span data-v-32239fca="" style="color: rgb(0, 204, 0);">
                                      答题技巧：
                                    </span>
                                    <span id='skills2'> </span>
                                  </span></span>
                              </div>
                              <div data-v-32239fca="" class="sbuject_answer_tggbox" style="width: 100%;">
                                <div data-v-32239fca="" class="sub-opera">
                                  <div data-v-32239fca="" class="xzda">
                                    您选择的答案:<!----></div>
                                  <div data-v-32239fca=""><span data-v-32239fca="">选项：</span> <button data-v-32239fca="" class="btn_11" style="font-family: emoji;">
                                      √
                                    </button> <button data-v-32239fca="" class="btn_11">
                                      ×
                                    </button></div>
                                </div>
                              </div>
                              <div data-v-32239fca="" class="el-dialog__wrapper" style="display: none;">
                                <div role="dialog" aria-modal="true" aria-label="技巧讲解" class="el-dialog" style="margin-top: 15vh;">
                                  <div class="el-dialog__header"><span class="el-dialog__title">技巧讲解</span><button type="button" aria-label="Close" class="el-dialog__headerbtn"><i class="el-dialog__close el-icon el-icon-close"></i></button></div><!----><!---->
                                </div>
                              </div>
                            </div>
                            <div data-v-69824944="" class="container-right">
                              <div data-v-69824944="" class="tgg_right_options" style="height: 100%;">
                                <div data-v-69824944="">

                                  <!-- 生成 -->
                                  <?php
                                  echo '<table id="table">';

                                  // 表头第一行
                                  echo '<tr>';
                                  echo '<th class="header">题目</th>';
                                  for ($i = 1; $i <= 10; $i++) {
                                    echo '<th class="header">' . $i . '列</th>';
                                  }
                                  echo '</tr>';

                                  // 生成10行10列的表格内容
                                  for ($row = 1; $row <= 10; $row++) {
                                    echo '<tr>';
                                    // 第一列显示行号
                                    echo '<td class="header">' . $row . '行</td>';

                                    // 生成每行的单元格
                                    for ($col = 1; $col <= 10; $col++) {
                                      $number = ($row - 1) * 10 + $col;
                                      if ($number == $course) {
                                        $s = ' class="selected" ';
                                      } else {
                                        $s = '';
                                      }
                                      echo '<td ' . $s . '>' . $number . '</td>';
                                    }
                                    echo '</tr>';
                                  }

                                  echo '</table>';
                                  ?>





                                </div> <!----> <!---->
                              </div> <!---->
                            </div>
                          </div>
                        </div>
                        <div data-v-69824944="" class="operation operation-record" style="flex-shrink: 0; height: 80px;">
                          <div data-v-69824944="" class="exam-operation"><span data-v-69824944="" class="record-item" style="font-size: 20px;">正确率:0.00%</span>
                            <div data-v-69824944="" class="record-item"><button data-v-69824944="" type="button" class="el-button el-button--primary el-button--small"><!----><!----><span>读题</span></button> <button data-v-69824944="" type="button" class="el-button el-button--success el-button--small"><!----><!----><span onclick="show_skill('<?= $cur['skills'] ?>')">答题技巧</span></button> <button data-v-69824944="" type="button" class="el-button el-button--warning el-button--small"><!----><!----><span>视频教程</span></button> <!----></div>
                            <div data-v-69824944="" class="collect"><i data-v-69824944="" class="el-icon-star-off collect-active"></i><span data-v-69824944="" class="collect-text">收藏</span></div>
                            <div data-v-69824944=""><span data-v-69824944="" class="record-item" style="display: block; margin-bottom: 2%;"><label data-v-69824944="" class="el-checkbox"><span class="el-checkbox__input"><span class="el-checkbox__inner"></span><input type="checkbox" aria-hidden="false" class="el-checkbox__original" value=""></span><span class="el-checkbox__label">背题模式<!----></span></label></span> <span data-v-69824944="" class="record-item" style="display: block; margin-bottom: 2%;"><label data-v-69824944="" class="el-checkbox"><span class="el-checkbox__input"><span class="el-checkbox__inner"></span><input type="checkbox" aria-hidden="false" class="el-checkbox__original" value=""></span><span class="el-checkbox__label">是否显示正确答案<!----></span></label></span> <span data-v-69824944="" class="record-item" style="display: block;"><label data-v-69824944="" class="el-checkbox"><span class="el-checkbox__input"><span class="el-checkbox__inner"></span><input type="checkbox" aria-hidden="false" class="el-checkbox__original" value=""></span><span class="el-checkbox__label">答对自动下一题<!----></span></label></span></div>
                            <div data-v-69824944="" style="display: flex; align-items: center;">
                              <div data-v-69824944="" class="record-item" style="width: 300px;"><!----> <button data-v-69824944="" type="button" class="el-button el-button--default el-button--large" style="width: 120px; background: none; border: 0px solid rgb(241, 244, 236);"><!----><!----><!----></button> <button data-v-69824944="" type="button" class="el-button el-button--default el-button--large" style="width: 120px; height: 50px; font-size: 23px;"><!----><!----><span onclick="next('<?= $cur["tips"] ?>')">下一题</span></button></div> <button data-v-69824944="" type="button" class="el-button el-button--default el-button--large record-item" style="width: 120px; height: 50px; font-size: 22px;"><!----><!----><span onclick="end_exam()">结束</span></button>
                            </div>
                          </div>
                        </div>
                        <div data-v-69824944="" class="tgg_bottom_option_default">
                          <div data-v-69824944="" class="sub-img-box" style="flex-shrink: 0;"><!---->







                          </div> <!----> <!----> <!---->
                        </div> <!---->
                        <div data-v-69824944="" class="el-dialog__wrapper" style="display: none;">
                          <div role="dialog" aria-modal="true" aria-label="技巧讲解" class="el-dialog" style="margin-top: 15vh;">
                            <div class="el-dialog__header"><span class="el-dialog__title">技巧讲解</span><button type="button" aria-label="Close" class="el-dialog__headerbtn"><i class="el-dialog__close el-icon el-icon-close"></i></button></div><!----><!---->
                          </div>
                        </div>
                      </div> <!----> <!---->
                      <div data-v-69824944="" class="el-dialog__wrapper" style="display: none;">
                        <div role="dialog" aria-modal="true" aria-label="视频教程查看" class="el-dialog el-dialog--center" style="margin-top: 15vh; width: 90%;">
                          <div class="el-dialog__header"><span class="el-dialog__title">视频教程查看</span><!----></div><!---->
                          <div class="el-dialog__footer"><span data-v-69824944="" class="dialog-footer"><button data-v-69824944="" type="button" class="el-button el-button--primary el-button--small"><!----><!----><span>关闭</span></button></span></div>
                        </div>
                      </div>
                      <div class="el-loading-mask" style="background-color: rgba(0, 0, 0, 0.5); display: none;">
                        <div class="el-loading-spinner"><i class="el-icon-loading"></i>
                          <p class="el-loading-text">拼命加载中</p>
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
  <!--<script type="text/javascript" src="./static/js/manifest_5c65e1a2795e5caa624c.js"></script>-->
  <!--<script type="text/javascript" src="./static/js/vendor_e738ee143ffc1afbf537.js"></script>-->
  <!--<script type="text/javascript" src="./static/js/app_5e726c4be90141cb7bc3.js"></script>-->
  <div tabindex="-1" role="dialog" aria-modal="true" aria-label="注意" class="el-message-box__wrapper" style="z-index: 3003; display: none;">
    <div class="el-message-box el-message-box--center">
      <div class="el-message-box__header">
        <div class="el-message-box__title"><!----><span>注意</span></div><!---->
      </div>
      <div class="el-message-box__content">
        <div class="el-message-box__container"><!---->
          <div class="el-message-box__message">
            <p>倒计时准备，请点击确认开始</p>
          </div>
        </div>
        <div class="el-message-box__input" style="display: none;">
          <div class="el-input el-input--small"><!----><input type="text" autocomplete="off" placeholder="" class="el-input__inner"><!----><!----><!----><!----></div>
          <div class="el-message-box__errormsg" style="visibility: hidden;"></div>
        </div>
      </div>
      <div class="el-message-box__btns"><button type="button" class="el-button el-button--default el-button--small"><!----><!----><span>
            取消
          </span></button><button type="button" class="el-button el-button--default el-button--small el-button--primary "><!----><!----><span>
            确定
          </span></button></div>
    </div>
  </div>
  <script>
    function show_skill(str) {
      $("#skills").show();
      $("#skills2").html(str);

    }


    function next(e) {
      // alert(e)
      var cur = '<?= $course ?>';
      if (cur >= 100) {
        alert('当前已经是最后一题了');
        return false;
      }
      var ne = cur * 1 + 1;

      location.href = 'practice.php?id=1&name=' + e + '&veh=1&color=333&course=' + ne;

    }

    function end_exam() {
      alert('交卷完成，本次成绩不保存')
      var int = self.setInterval(function() { // 这个方法是说在延迟两秒后执行大括号里的方法
        location.href = 'index.php' // 这个方法是刷新当前页面
      }, 1000) //这里2000代表两秒


    }
    $(document).ready(function() {
      $('#table td:not(.header)').on({
        // 单击事件
        click: function(e) {
          // console.log(e)
          let value = $(this).text();
          let rowIndex = $(this).parent().index();
          let colIndex = $(this).index();
          //console.log(`选中的数字是: ${value}, 位于第${rowIndex}行, 第${colIndex}列`);



          // $('#table td').removeClass('selected');
          // $(this).addClass('selected');
          location.href = "practice.php?id=1&name=<?php echo $cur['tips']; ?>&veh=1&color=333&course=" + value;
        },
        // 双击事件
        dblclick: function() {
          //  alert('你选择了数字: ' + $(this).text());
        }
      });


      createCustomDialog();
      $.customDialog({
        title: '注意',
        content: '倒计时准备，请点击确认开始',
        onCancel: function() {
          //console.log('用户取消了操作');
          window.history.go(-1);

        },
        onConfirm: function() {
          console.log('用户确认了操作');
          // 这里可以添加退出登录的逻辑
          // location.href = 'logout.php';
        }
      });

    });
  </script>

</body>

</html>
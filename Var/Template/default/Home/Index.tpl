<!--
Credit: 折影轻梦 (https://nexmoe.com/)
-->

<!DOCTYPE html>
<html>

<head>
    <title>Mixcm Avatar</title>
    <meta charset="utf-8">
    <meta name="description" content="用于对公共头像源的缓存加速，目前支持 QQ 头像、 Gravatar 和 Github">
    <meta name="keywords" content="Mixcm">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <style type="text/css">
        body {
            margin: 0;
            overflow-x: hidden;
        }

        .mixcm-container {
            width: 700px;
            margin: auto;
            font-family: "SF Pro SC", "SF Pro Display", "SF Pro Icons", "AOS Icons", "PingFang SC", "Helvetica Neue", "Helvetica", "Arial", sans-serif;
        }

        .mixcm-container .mixcm-info {
            width: 100vw;
            margin-left: calc(350px - 50vw);
            padding: 50px calc(50vw - 350px);
            background-color: #f8f9fa;
            box-sizing: border-box;
            color: #454d5d;
        }

        .mixcm-container .mixcm-version {
            overflow: hidden;
            padding: 10px;
            margin: -10px;
        }

        .mixcm-container .mixcm-version h4,
        .mixcm-container .mixcm-version ul,
        .mixcm-container .mixcm-version li,
        .mixcm-container h3 {
            color: #454d5d;
        }

        .mixcm-container .mixcm-version ul {
            margin-left: 10px;
        }

        .mixcm-container h2 {
            margin: 0;
            font-size: 2.4em;
            position: relative;
            color: #454d5d;
        }

        .mixcm-container h2::after {
            content: "{{ Version }}";
            position: absolute;
            top: -3px;
            font-size: 16px;
            color: #fff;
            border-radius: 15px;
            padding: 2px 8px;
            background-color: #5755d9;
        }

        .mixcm-container h3::before {
            content: "# ";
            color: #e06870;
        }

        .mixcm-container h4 {
            font-size: 1.2em;
            position: relative;
        }

        .mixcm-container blockquote {
            font-family: "SF Mono", "Segoe UI Mono", "Roboto Mono", Menlo, Courier, monospace;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            margin: 0;
            color: #e06870;
            font-size: .9em;
            line-height: 25px;
        }


        .mixcm-container h4::before {
            content: "";
            width: 14px;
            height: 14px;
            background: #5755d9;
            display: inline-block;
            vertical-align: middle;
            margin-top: -4px;
            margin-right: 11px;
            border-radius: 100%;
            border: 3px solid #fff;
            box-shadow: 0 0 5px #b0b0b0;
            z-index: 1;
            position: relative;
        }

        .mixcm-container h4::after {
            content: "";
            height: 100vh;
            width: 2px;
            background-color: #5755d9;
            position: absolute;
            left: 9px;
            top: 6px;
        }

        .mixcm-container p {
            color: #acb3c2;
        }

        .mixcm-container a,
        .mixcm-container a:hover,
        .mixcm-container a:active {
            text-decoration: none;
            color: #5755d9;
        }

        .mixcm-container .mixcm-info a::after {
            content: ">";
            margin-left: 5px;
            display: inline-block;
            font-family: cursive;
            font-weight: 800;
        }

        @media screen and (max-width:720px) {
            .mixcm-container {
                width: calc(100% - 40px);
                margin: 0 20px;
            }
            .mixcm-container .mixcm-info {
                width: 100vw;
                margin-left: -20px;
                padding: 50px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="mixcm-container">
        <div class="mixcm-info">
            <h2>Mixcm Avatar</h2>
            <p>Simple and convenient public avatar api. (Node: {{ Node }})</p>
            <a href="https://blog.lim-light.com/archives/mixcm-avatar-cache-doc.html" target="_blank">阅读使用文档</a>&nbsp;&nbsp;&nbsp;
            <a href="mailto:idawn@live.com" target="_blank">联系我</a>
        </div>
        <h3>QQ</h3>
        <blockquote>
            调用方式：<a>https://avatar.dawnlab.me/qq/{qqnum}?s={size}</a><br>
            调用示例：<a>https://avatar.dawnlab.me/qq/776194970?s=100</a>
        </blockquote>
        <h3>Gravatar</h3>
        <blockquote>
            调用方式：<a>https://avatar.dawnlab.me/gravatar/{mailmd5}?s={size}&d={default}&r={rating}</a><br>
            调用示例：<a>https://avatar.dawnlab.me/gravatar/605f8c6c64b8fcd514a0b53c6cc3680c?s=100&d=mm&r=X</a><br>
        </blockquote>
        <h3>Github</h3>
        <blockquote>
            调用方式：<a>https://avatar.dawnlab.me/github/{username}?s={size}</a><br>
            调用示例：<a>https://avatar.dawnlab.me/github/idawnlight?s=100</a><br>
        </blockquote>
        <div class="mixcm-version" id="mixcm-version"></div>
    </div>
    <script type="text/javascript" src="https://api.lim-light.com/avatar.php" async defer></script>
</body>
</html>

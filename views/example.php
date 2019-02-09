<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sarps\Mail-Scheduler</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,400,600" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Major+Mono+Display" rel="stylesheet">
    <style>
        html,
        body {
            background-color: #000;
            color: #dedede;
            font-family: 'Major Mono Display', monospace;
            font-weight: 100;
            height: 100vh;
            width: 100vw;
            margin: 0;
        }

        .container {
            align-items: center;
            display: flex;
            justify-content: center;
            position: relative;
            height: 100vh;
        }

        .content {
            text-align: center;
        }

        .content>div {
            margin-bottom: 30px;
        }

        .title {
            font-size: 48px;
        }

        .subtitle {
            font-size: 14px;
            font-style: italic;
            font-weight: 400;
            color: #ececec;
        }

        .links>a {
            display: inline-flex;
            padding: 10px 25px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: underline;
            color: #ececec;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="title">@Sarps\mAIl-ScHedUler</div>
            <div class="subtitle">composer create-project sarps/mail-scheduler <?= $app_name ?></div>

            <div class="links">
                <a href="https://sarps.github.io/">Website</a>
                <a href="https://github.com/Sarps/mail-scheduler">Github</a>
                <a href="https://packagist.org/packages/sarps/mail-scheduler">Documentation</a>
                <a href="https://packagist.org/packages/sarps/mail-scheduler">Packagist</a>
            </div>
        </div>
    </div>
</body>

</html>
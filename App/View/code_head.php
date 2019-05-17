<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo isset($metaTitle) ? $metaTitle : 'Noticias' ?></title>
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo ASSETS ?>/images/favicon.png">
    <link rel="stylesheet" href="<?php echo ASSETS ?>/css/style.css">
    <style>
        .box1{background: #c4e6ff}
        .box2{background: #ffc4e7}
        .box3{background: #dcc4ff}
        .box4{background: #c4d6ff}
        .box5{background: #c4f5ff}
        .box6{background: #c4ffe4}
        .box7{background: #e3ffc4}
        .box8{background: #fffec4}
    </style>
</head>
<body>
    <?php include __DIR__ . '/../../public/images/sprite-svg.svg' ?>
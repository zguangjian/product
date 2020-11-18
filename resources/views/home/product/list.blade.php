<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .shop{
            /*background: #00F7DE;*/
            width: 300px;
            height: 300px;
            border: 1px solid lightslategray;
            margin-left: 10px;

        }
        .pic{
            background: pink;
            width: 300px;
            height: 150px;
        }
    </style>
</head>
<body>
    <h1>商品详情</h1>

    <div class="shop">

        <div class="pic">图片</div>
        <div class="name">商品名称：<a href="#">苹果</a></div>
        <div class="name">价格：100元</div>
        <div class="store">库存：100</div>
    </div>
    <div><a href="{{url('addOrder')}}">购买</a></div>

</body>
</html>

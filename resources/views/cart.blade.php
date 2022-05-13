@extends('layouts.qp')

@section('content')
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Cart Detail</title>
    <link rel="icon" href="img/logo.png" />
    <!-- <link rel="stylesheet" href="css/NavbarCSS.css">  -->
    <link rel="stylesheet" href="{{asset('css/CartDetail.css')}}">
    <link rel="stylesheet" href="{{asset('css/styleALL.css')}}">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            margin: 0px;
            padding: 0px;
            font-family: poppins;
            background-color: #ffffff;
        }

        /*            a{
                            text-decoration: none;
                        }*/
    </style>
</head>

<body>

    <?php
    if(!isset($_SESSION)){
        session_start();
    }
    $message;
    if (!isset($_SESSION['cart']) || $_SESSION['cart'] == null) {
        $message = "<h1>Khong co san pham nao</h1>";
    } else {
        $totalItem = sizeof($_SESSION['cart']);
        $product = $_SESSION['cart'];
        $_SESSION['tong'] = 0;
    }



    ?>
    <form action="{{route('checkout.index')}}" method="get">
        <div class="card">
            <div class="row">
                <div class="col-md-8 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col">
                                <h4><b>GIỎ HÀNG</b></h4>
                            </div>
                            <div class="col align-self-center text-right text-muted">
                                <?php if (isset($totalItem)) echo ($totalItem) ?> items</div>
                        </div>
                    </div>
                    <?php
                    if (!empty($_SESSION['cart'])) {
                        $count = 0;
                        $tong = 0;
                        $id = 0;
                        foreach ($product as $item) {
                            $id++;
                            $tong = $tong + $item['quantity'] * $item['price'];
                            $_SESSION['tong'] = $tong;
                            $pid = $item['id'];
                    ?>
                            <div class="row">
                                <div class="row main align-items-center">
                                    <input type="text" name="productId" id="productId" value="{{$item['id']}}" hidden>
                                    <div class="col-2"><img class="img-fluid" src="img/{{$item['image_url']}}"></div>
                                    <div class="col">
                                        <!--                                    <div class="row text-muted">Shirt</div>-->
                                        <div class="row">{{$item['name']}}</div>
                                    </div>

                                    <div class="col">
                                        <!--                                            <button >-->
                                        <span class="minus" id="minus+{{$count}}" onclick="process({{$count}}, false,{{$id}})" style="text-decoration: none">-</span>
                                        <!--</button>-->
                                        <input type="hidden" class="amount+{{$pid}}" id="amount{{$id}}" name="amount{{$pid}}" value="{{$item['quantity']}}">
                                        <a class="amount+{{$pid}}" id="amount{{$count.$id}}" href="#" style="text-decoration: none" style="border: 1px solid black">{{$item['quantity']}}</a>
                                        <!--<button>-->
                                        <span class="add" id="add+{{$count}}" onclick="process({{$count}}, true,{{$id}})" style="text-decoration: none" href="#">+</span>
                                        <!--</button>-->
                                    </div>
                                    <div class="col">
                                        <span>{{number_format($item['price'],0,'.',',')}}₫</span>
                                        <span hidden id='gia{{$count++}}'>{{$item['price']}}</span>
                                        <a href="{{route('cart.edit',$item['id'])}}"><span class="close">&#10005;</span></a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>



                        <div class="back-to-shop"><a href="shop.php" style="text-decoration: none">&leftarrow;</a>
                            <a href="{{route('product.index')}}" style="text-decoration: none">
                                <span class="text-muted">Back to shop</span></a>
                        </div>
                </div>
                <div class="col-md-4 summary">
                    <div>
                        <h5><b>Summary</b></h5>
                    </div>
                    <hr>
                    <form>
                        <p>SHIPPING</p> <select>
                            <option class="text-muted">STANDARD - 30,000 VNĐ</option>
                        </select>
                        <p>GIVE CODE</p> <input disabled id="code" placeholder="UNSUPPORTED">
                    </form>

                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <div class="col">TOTAL PRICE</div>$
                        <div class="col text-right" id="tong"><?php echo ($_SESSION['tong']) ?> </div>
                        <input type=hidden id='inputtong' name="tong" value=<?php echo ($_SESSION['tong']) ?>>
                    </div><input type="submit" class="btn" value="CHECKOUT">
                </div>

            </div>
        </div>
    </form>
<?php
                    }
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function process(x, sign, id) {
        value = parseInt(document.getElementById(('amount' + x + id)).innerHTML);
        tong = parseFloat(document.getElementById("tong").innerHTML);
        document.getElementById('amount' + x + id).innerHTML = (value + (sign ? 1 : -1));
        price = parseFloat(document.getElementById("gia" + x).innerHTML);
        document.getElementById("tong").innerHTML = tong + (sign ? 1 : -1) * price;
        document.getElementById("inputtong").value = tong + (sign ? 1 : -1) * price;
        document.getElementById('amount' + id).value = (value + (sign ? 1 : -1));
        console.log(document.getElementById("inputtong"));
    }
</script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
@endsection
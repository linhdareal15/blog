@extends('layouts.qp')

@section('content')

<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="img/logo.png" />
        <link rel="stylesheet" href="css/styleALL.css" />
        <link rel="stylesheet" href="css/NavbarCSS.css" />
        <script crossorigin="anonymous" src="https://kit.fontawesome.com/c8e4d183c2.js"></script>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
              integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

        <link rel="stylesheet" href="static/css/main.css">
        <title>Prepare Shipping</title>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-5">
                    <div class="card">
                        <div class="card-body mt-5" style="border: 1px solid #ced4da;border-radius: 5px">
                            <h4 class="mt-3">DANH SÁCH SẢN PHẨM</h4>
                            <table class="w-100 table table-striped mt-3">
                                <tbody>
                                    <tr>
                                        <th>Id</th>
                                        <th>ẢNH</th>
                                        <th>TÊN SẢN PHẨM</th>
                                        <th>GIÁ</th>
                                        <th>SỐ LƯỢNG</th>
                                        <th>TỔNG</th>
                                    </tr>
                                    @foreach($product as $item)
                                            <tr>
                                            <td>1</td>
                                            <td>
                                                <img src="img/{{$item['image_url']}}" style="width: 100px">
                                            </td>
                                            <td>{{$item['name']}}</td>
                                            <td>
                                                {{number_format($item['price'],0,'.',',')}} VNĐ
                                            </td>
                                            <td>
                                                {{$item['quantity']}}
                                            </td>
                                            <td>
                                                {{number_format($item['quantity'] * $item['price'],0,'.',',')}}
                                            </td>
                                        </tr>
                                    @endforeach
                            
                                </tbody>
                            </table>
                            <hr>
                            <div class="text-right">
                                <h4>TỔNG: {{number_format($tong,0,'.',',')}} VNĐ</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mt-5"><a onclick="document.getElementById('inf').submit()" class="btn btn-outline-success ml-auto w-100">Vận chuyển đến địa chỉ này
                        </a></div>
                            <div class="mt-3"><a onclick="document.getElementById('address').style.display = 'block'"
                                                 class="btn btn-outline-info ml-auto w-100">Vận chuyển đến địa chỉ khác</a>
                            </div>
                        </div>

                        <div class="col-md-9 mt-3">
                            <form id="inf" action="/shipping" method="post"
                                
                                  style="border: 1px solid #ced4da !important; border-radius: 5px !important">
                                  @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <h4 style="color: orange">Ship to address</h4>
                                        <h6 style="overflow: visible !important">YOUR ORDER WILL BE SHIPPING TO THIS</h6><br>
                                        <div>YOUR NAME:<span class="ml-4"> <b> {{$name}} </b><span></span></span></div>
                                        <input type="hidden" name="name" value="{{$name}}">
                                        <input type="hidden" name="phone" value="{{$phone}}">
                                        <input type="hidden" name="email" value="{{$email}}">
                                        <input type="hidden" name="address" value="{{$address}}">
                                        <input type="hidden" name="note" value="{{isset($note) ? $note : ''}}">
                                        <div>YOUR EMAIL: <span class="ml-4">{{$email}}<span></span></span></div>
                                        <div>YOUR PHONE NUMBER: <span class="ml-4">{{$phone}}<span></span></span></div>
                                        <div>YOUR ADDRESS: <span class="ml-4">{{$address}}</span></div>
                                        <div>NOTE:  <span class="ml-4">{{isset($note) ? $note : ''}}</span></div>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>
                    <div class="row">

                        <div class="col-md-3">

                        </div>
                        <div id="address" class="col-md-9 mt-5" style="display: none;">
                            <div class="card">
                                <div class="card-body" style="border: 1px solid #ced4da;border-radius: 5px !important">
                                    <h4 class="mt-3" style="color: black">Infomation of Customer</h4>
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <form action="Shipping.php" method="POST">
                                                <div class="form-group">
                                                    <label for="name">Full Name</label>
                                                    <input type="text" name="name" class="form-control"
                                                           placeholder="Enter name">
                                                    <label for="name">EMAIL</label>
                                                    <input type="text" name="email" class="form-control" placeholder="Enter email"
                                                           value=""
                                                           required="">
                                                    <small id="emailHelp" class="form-text text-muted"></small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sdt">Phone number</label>
                                                    <input type="number" name="mobile" class="form-control"
                                                           placeholder="enter phone number">
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <textarea class="form-control" rows="3" name="address"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Note</label>
                                                    <textarea class="form-control" rows="3" name="note"></textarea>
                                                </div>

                                                <button type="submit" class="btn btn-success w-100">Accept</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
        crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/styleCarousel.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
    </body>
</html>

@endsection
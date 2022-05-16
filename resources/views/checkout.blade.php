@extends('layouts.qp')

@section('content')
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>SHIPPING</title>
        <link rel="icon" href="img/logo.png" />
        <link rel="stylesheet" href="css/styleALL.css" />
        <link rel="stylesheet" href="css/NavbarCSS.css" />
        <script crossorigin="anonymous" src="https://kit.fontawesome.com/c8e4d183c2.js"></script>
    </head>
    <body>
        
        <div class="container" style="margin-top: 5rem">
            <div class="row">
                <div class="col-md-8" style="border: 1px solid #ced4da;border-radius: 5px !important">
                    <h4 class="mt-3">DANH SÁCH SẢN PHẨM</h4>
                    <table class="w-100 table table-striped mt-3">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <th>ẢNH</th>
                                <th>TÊN SẢN PHẨM</th>
                                <th>ĐƠN GIÁ</th>
                                <th>SỐ LƯỢNG</th>
                                <th>TỔNG</th>
                            </tr>
                            <?php
                                if(isset($products) && !empty($products)){
                                        ?>
                                @foreach($products as $item)
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <img src="img/{{$item['image_url']}}" style="width: 100px">
                                    </td>
                                    <td>{{$item['name']}}</td>
                                    <td>
                                        {{number_format($item['price'],0,'.',',')}}đ
                                    </td>
                                    <td>
                                    {{$item['quantity']}}
                                    </td>
                                    <td>
                                        {{number_format($item['price'] * $item['quantity'],0,'.',',')}}đ
                                    </td>
                                </tr>
                                @endforeach
                            <?php
                                }
                            ?>

                        </tbody>
                    </table>
                    <hr>
                    <div class="text-right">
                        <h4>Tổng tiền: VND {{number_format($tong,0,'.',',')}}</h4>
                    </div>


                </div>
                <div class="col-md-4 pl-5" style="border: 1px solid #ced4da;border-radius: 5px !important;">
                    <h3 class="mt-3" style="color: black">THÔNG TIN KHÁCH HÀNG</h3>
                    <div class="card mt-3">
                        <div class="card-body">
                            <form action="/prepare" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">HỌ VÀ TÊN</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter name"
                                           value="" required="">
                                    <label for="name">EMAIL</label>
                                    <input type="text" name="email" class="form-control" placeholder="Enter email"
                                           value=""
                                           required="">
                                    <!-- <small id="emailHelp" class="form-text text-muted"></small> -->
                                </div>
                                <div class="form-group">
                                    <label for="phone">SỐ ĐIỆN THOẠI</label>
                                    <input type="number" name="phone" class="form-control" placeholder="enter phone number"
                                           value="" required="">
                                </div>
                                <div class="form-group">
                                    <label for="address">ĐỊA CHỈ</label>
                                    <textarea class="form-control" rows="3" name="address" value="" required=""></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="address">GHI CHÚ</label>
                                    <textarea class="form-control" rows="3" name="note"></textarea>
                                </div>
                                
                                <a><button type="submit" class="btn btn-success w-100">ĐẶT HÀNG</button></a> 
                            </form>
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
    </body>
</html>
@endsection
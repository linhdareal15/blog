@extends('layouts.qp')

@section('content')
<?php
        session_start();
    ?>
<div class=" mt-1">
    <div class="lv-filters-bar-new__title">
        <div class="lv-category__title">
            <h1 class="text-center">
                LV Fall
            </h1>
            <div class="vue-portal-target"></div>
        </div>
    </div>
</div>
<div class="product-show">
    <section class="feature-item">
        <!-- <div class="feature-heading">
            <strong style="text-transform:uppercase;">Featured Items</strong>
            <p>We Provide You New Fasion Design Clothes</p>
        </div> -->
        

        
        <div class="product-container">
        
            @foreach($products as $row)
            <?php
                $img = asset("img/$row->image_url");
            ?>
            <div class="product-box">
                <div class="product-img">
                    <a href="/add-to-cart/{{$row->id}}" class="add-cart"><i class="fas fa-shopping-cart"></i></a>
                       
                        <a href="{{route('product.show',$row->id)}}" class=""><img src="{{$img}}"></a>
                </div>
                    <div class="product-details">
                        <a href="{{route('product.show',$row->id)}}" class="p-name">{{$row->name}}</a>
                         <span class="p-price">{{number_format($row->price,0,'.',',')}}₫</span>
                    </div>
            </div>
            @endforeach

        </div>
    </section>

    <section class="categories">
        <!--                <div class="col-md-2">-->
        <h5 class="labelhead">
            <div class="alert alert-success" role="alert">
                Category
            </div>
        </h5>
        <div class="category">
            <a href="#" class="pt-3" style="color: #d71e1e; font-size: 20px">All
                Product</a>
                @foreach($categories as $cate)
                    <a href="#" class="pt-3" style="color: #d71e1e; font-size: 20px">{{$cate->category_name}}</a>
                @endforeach
        </div>
    </section>
</div>
                {{$products->links()}}
@endsection
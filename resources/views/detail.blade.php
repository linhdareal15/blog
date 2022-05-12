@extends('layouts.qp')


@if (isset($msg) && $msg!=null)

@else
@section('content')
    @foreach($product as $p)
    <div class="pd-wrap">

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <div id="slider" class="owl-carousel p-slider">
                <div class="item">
                    <?php
                        $image= asset("img/$p->image_url");
                        echo $image;
                    ?>
                    <img src="{{$image}}" />
                </div>
                <?php
                // foreach ($listImage as $image) {
                //     echo ('<div class="item">
                //             <img src="' . $image['image_url'] . '" />
                //       </div>');
                // }
                //echo($p->name);
                ?>
            </div>
            <div id="thumb" class="owl-carousel product-thumb" style="margin-top: 20px;">
                <div class="item">
                    <img src="{{$image}}" />
                </div>
                <?php
                // foreach ($listImage as $image) {
                //     echo ('<div class="item">
                //             <img src="' . $image['image_url'] . '" />
                //       </div>');
                // }
                ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="product-dtl">
                <div class="product-info">
                    <div class="product-name">{{$p->name}}</div>
                    <div class="reviews-counter">
                        <div class="rate">
                            <input type="radio" id="star5" name="rate" value="5" checked />
                            <label for="star5" title="text">5 stars</label>
                            <input type="radio" id="star4" name="rate" value="4" />
                            <label for="star4" title="text">4 stars</label>
                            <input type="radio" id="star3" name="rate" value="3" />
                            <label for="star3" title="text">3 stars</label>
                            <input type="radio" id="star2" name="rate" value="2" />
                            <label for="star2" title="text">2 stars</label>
                            <input type="radio" id="star1" name="rate" value="1" />
                            <label for="star1" title="text">1 star</label>
                        </div>
                        <span>15 Reviews</span>
                    </div>
                    <div class="product-price-discount">
                        <?php
                        // if ($product['sale'] > 0 && isset($giaSauSale)) {
                        //     echo ('<span>' . $giaSauSale . '</span>');
                        //     echo ('<span class="line-through">' . $product['price'] . '</span>');
                        // } else {
                        //     echo ('<span>' . $product['price'] . '</span>');
                        // }
                        ?>
                    </div>
                </div>
                <p>{{$p->description}}</p>
                <div class="row">
                    <div class="col-md-6">
                        <label for="color">Màu</label>
                        <select id="color" name="color" class="form-control">
                            <option>Xanh Dương</option>
                            <option>Xanh Lá</option>
                            <option>Đỏ</option>
                        </select>
                    </div>
                </div>
                <div class="product-count">
                    <label for="size">Số lượng</label>
                    <form action="#" class="display-flex">
                        <div class="qtyminus">-</div>
                        <input type="text" name="quantity" value="1" class="qty">
                        <div class="qtyplus">+</div>
                    </form>
                    <a href="#" class="round-black-btn">Thêm vào giỏ hàng</a>
                </div>
            </div>
        </div>
    </div>
    <div class="product-info-tabs">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews (0)</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                <?php 
                // if (!empty($product['des']))
                //     echo ($product['des']);
                ?>
            </div>
            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="review-heading">REVIEWS</div>
                <p class="mb-20">There are no reviews yet.</p>
                <form class="review-form">
                    <div class="form-group">
                        <label>Your rating</label>
                        <div class="reviews-counter">
                            <div class="rate">
                                <input type="radio" id="star5" name="rate" value="5" />
                                <label for="star5" title="text">5 stars</label>
                                <input type="radio" id="star4" name="rate" value="4" />
                                <label for="star4" title="text">4 stars</label>
                                <input type="radio" id="star3" name="rate" value="3" />
                                <label for="star3" title="text">3 stars</label>
                                <input type="radio" id="star2" name="rate" value="2" />
                                <label for="star2" title="text">2 stars</label>
                                <input type="radio" id="star1" name="rate" value="1" />
                                <label for="star1" title="text">1 star</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Your message</label>
                        <textarea class="form-control" rows="10"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="" class="form-control" placeholder="Name*">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="" class="form-control" placeholder="Email Id*">
                            </div>
                        </div>
                    </div>
                    <button class="round-black-btn">Submit Review</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
        @endforeach
        
@endsection
@endif
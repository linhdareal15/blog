@extends('layouts.qp')

@section('content')
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

            <?php
            use App\Http\Controllers\ShopController;

            $a = new ShopController();
            $product = $a->getProduct();
            foreach ($product as $row) {
                $as = asset("img/$row->image_url");
                echo ('<div class="product-box">
                        
                    <div class="product-img">
                       
                        <a href="addtocart.php?action=add&id=' . $row->id . '" class="add-cart"><i class="fas fa-shopping-cart"></i></a>
                       
                        <a href="detail.php?productId='.$row->id. '"><img src="'.$as.'"></a>
                    </div>
                   
                     <div class="product-details">
                     <a href="detail?productId=${product.id}" class="p-name">' . $row->name . '</a>
                         <span class="p-price">');
                echo number_format($row->price, 0, '.', ',');
                echo (' ₫</span>
                        </div>
                    </div>');
            }
            ?>

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
            <?php
                $category = $a->GetCategory();
                foreach($category as $cate){
                    echo('
                    <a href="#" class="pt-3" style="color: #d71e1e; font-size: 20px">'. $cate->category_name .'</a>
                    ');
                }
            ?>
        </div>
    </section>

</div>
@endsection
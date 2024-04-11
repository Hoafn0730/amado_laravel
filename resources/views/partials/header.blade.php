<header class="header-area clearfix">

    <div class="header-wrapper">

        <!-- Close Icon -->
        <div class="nav-close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </div>
        <!-- Logo -->
        <div class="logo">
            <a href="/"><img src="{{asset('img/core-img/logo.png')}}" alt=""></a>
        </div>
        <!-- Amado Nav -->
        <nav class="amado-nav">
            <ul>
                <li class="active"><a href="/">Home</a></li>
                <li><a href="/shop">Shop</a></li>
                <li><a href="/cart">Cart <span>({{$cart->totalQuantity}})</span></a></li>
                <li><a href="/checkout">Checkout</a></li>
                <li><a href="/invoice">Order</a></li>
            </ul>
        </nav>
        <!-- Button Group
    <div class="amado-btn-group mt-30 mb-30">
        <a href="#" class="btn amado-btn mb-15">Discount</a>
        <a href="#" class="btn amado-btn active">New this week</a>
    </div> -->
        <!--  Menu -->
        <div class="menu">
            <div class="search btn-action">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span>Search</span>
            </div>
            <div class="user-menu btn-action">
                <img class="avatar" src="https://files.fullstack.edu.vn/f8-prod/user_avatars/330533/656b17e84ff15.jpg"
                    alt="">
                <span>Hoafn0730</span>
            </div>

        </div>

        <div class="social-info d-flex justify-content-between mt-4">
            <a href="#"><i class="fa-brands fa-pinterest" aria-hidden="true"></i></a>
            <a href="#"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
            <a href="#"><i class="fa-brands fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="fa-brands fa-twitter" aria-hidden="true"></i></a>
        </div>
    </div>
</header>
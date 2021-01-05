<!-- Footer -->
<footer>
    <div class="container-fluid wrapper">
        <div class="container">
            <div class="row align-items-center content">
                <div class="col-12 col-md-4 pb-3">
                    <div class="text-center">
                        <img src="{{ asset('pix/delivery-truck.png') }}" data-aos="fade-right" data-aos-duration="1500" data-aos-easing="ease-in-sine" style="height: 180px; margin-top: -90px;" />
                    </div>
                </div>
                <div class="col-12 col-md-4 pt-3 pb-3">
                    <div class="text-center">
                        <a href="#" target="_blank">
                            <img src="{{ asset('pix/icon_facebook.png') }}" style="height: 2rem;  border-radius: 50%;">
                        </a>
                        <a href="#" target="_blank" class="pr-3 pl-3">
                            <img src="{{ asset('pix/icon_email.png') }}" style="height: 2rem">
                        </a>
                        <a href="#" target="_blank">
                            <img src="{{ asset('pix/icon_map.png') }}" style="height: 2rem; border-radius: 50%;">
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-4 pt-3 pb-3">
                    <div id="copyright" class="text-white" style="line-height: 30px;">
                        <span><img src="{{ asset('pix/bird.png') }}" height="25" /> <a href="#" target="_blank">www.smallhaul.com</a></span>
                        <br/>
                        <small>&copy;{{ date('Y', time()) }} <a href="#">Small Haul</a> All rights reserved.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer -->
<footer>
    <div class="container-fluid wrapper">
        <div class="container">
            <div class="row align-items-center content">
                <div class="col-12 col-md-4 pb-3">
                    <div class="text-center">
                        <img src="{{ asset('pix/amblum.png') }}" style="height: 180px; margin-top: -90px;" />
                    </div>
                </div>
                <div class="col-12 col-md-4 pt-3 pb-3">
                    <div class="text-center">
                        <a href="https://www.fb.com/ZaynabFishFarm" target="_blank">
                            <img src="{{ asset('pix/icon_facebook.png') }}" style="height: 2rem;  border-radius: 50%;">
                        </a>
                        <a href="mailto:info@zaynabfishfarm.com" target="_blank" class="pr-3 pl-3">
                            <img src="{{ asset('pix/icon_email.png') }}" style="height: 2rem">
                        </a>
                        <a href="https://goo.gl/maps/Bg7Nw2zjMj62" target="_blank">
                            <img src="{{ asset('pix/icon_map.png') }}" style="height: 2rem; border-radius: 50%;">
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-4 pt-3 pb-3">
                    <div id="copyright" class="text-white" style="line-height: 30px;">
                        <span><img src="{{ asset('pix/bird.png') }}" height="25" /> <a href="http://www.intercraftsol.com" target="_blank">www.intercraftsol.com</a></span>
                        <br/>
                        <small>&copy;2016-{{ date('Y', time()) }} <a href="http://zaynabfishfarm.com">Zaynab Fish Farm</a> All rights reserved.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
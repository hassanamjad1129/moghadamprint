<div class="drawerItem activeItem">
    <a class="drawerItemLink" href="{{ route('customerDashboard') }}">
        <i class="ion-person manuItemIcon text-primary col-sm-3"></i>
        <span class="menuItemText col-sm-7">پروفایل کاربری</span>
    </a>
</div>
<div class="drawerItem">
    <a class="drawerItemLink" href="{{ route('customer.order') }}">
        <i class="ion-plus manuItemIcon color7 col-sm-3"></i>
        <span class="menuItemText col-sm-7">ثبت سفارش</span>
    </a>
</div>

<div class="drawerItem">

    <a class="drawerItemLink" onclick="userPanelMenuSubItemHandler(this)">
        <i class="ion-document-text manuItemIcon color2 col-sm-3"></i>
        <span class="menuItemText col-sm-7">سفارشات</span>
        <i class="ion-arrow-down-b color4 menuItemArrowDown col-sm-2"></i>
    </a>
    <div class="subMenuWrap" style="display: none;">
        <a href="{{ route('customer.inCompleteOrders') }}" class="submenuItem">
            <i class="ion-document submenuIcon color5"></i>
            <p>سفارشات در حال انجام</p>
        </a>
        <a href="{{ route('customer.completedOrders') }}" class="submenuItem">
            <i class="ion-document-text submenuIcon color6"></i>
            <p>آرشیو سفارشات</p>
        </a>
    </div>
</div>

<div class="drawerItem">
    <a class="drawerItemLink" onclick="userPanelMenuSubItemHandler(this)">
        <i class="ion-social-usd manuItemIcon color3 col-sm-3"></i>
        <span class="menuItemText col-sm-7">کیف پول</span>
        <i class="ion-arrow-down-b color4 menuItemArrowDown col-sm-2"></i>
    </a>
    <div class="subMenuWrap" style="display: none;">
        <a href="{{ route('customer.moneybag.increase') }}" class="submenuItem">
            <i class="ion-plus submenuIcon color5"></i>
            <p>شارژ کیف پول</p>
        </a>
        <a href="{{ route('customer.moneybag.index') }}" class="submenuItem">
            <i class="ion-document-text submenuIcon color6"></i>
            <p>تاریخچه کیف پول</p>
        </a>
    </div>
</div>
@if(auth()->user()->level=='representation')
    <div class="drawerItem">
        <a class="drawerItemLink" onclick="userPanelMenuSubItemHandler(this)">
            <i class="ion-ios-people manuItemIcon color7 col-sm-3"></i>
            <span class="menuItemText col-sm-7">نمایندگی</span>
            <i class="ion-arrow-down-b color4 menuItemArrowDown col-sm-2"></i>
        </a>
        <div class="subMenuWrap" style="display: none;">
            <a href="#" class="submenuItem">
                <i class="ion-social-usd submenuIcon color6"></i>
                <p>درآمد</p>
            </a>
            <a href="#" class="submenuItem">
                <i class="ion-document-text submenuIcon color7"></i>
                <p>تاریخچه</p>
            </a>
        </div>
    </div>
@endif

<div class="drawerItem">
    <a class="drawerItemLink" href="{{ route('customer.galleries') }}">
        <i class="icon ion-images manuItemIcon color4 col-sm-3"></i>
        <span class="menuItemText col-sm-7">گالری</span>
    </a>
</div>
<!--
<div class="drawerItem">
    <a class="drawerItemLink" href="#">
        <i class="icon ion-android-volume-up manuItemIcon text-danger col-sm-3"></i>
        <span class="menuItemText col-sm-7">اخبار</span>
    </a>
</div>
-->
<div class="drawerItem">
    <a class="drawerItemLink" href="{{ route('customer.downloads') }}">
        <i class="ion-folder manuItemIcon color1 col-sm-3"></i>
        <span class="menuItemText col-sm-7">دانلودها</span>
    </a>
</div>

<div class="drawerItem">
    <a class="drawerItemLink" href="{{ route('customer.state.city') }}">
        <i class="ion-folder manuItemIcon color1 col-sm-3"></i>
        <span class="menuItemText col-sm-7">ارسال به شهرستان</span>
    </a>
</div>

<div class="drawerItem">
    <a class="drawerItemLink" href="{{ route('customer.reportOrders') }}">
        <i class="ion-folder manuItemIcon color1 col-sm-3"></i>
        <span class="menuItemText col-sm-7">گزارش سفارشات</span>
    </a>
</div>


<div class="drawerItem">
    <a class="drawerItemLink" href="{{ route('customer.cart') }}">
        <i class="ion-android-cart manuItemIcon color8 col-sm-3"></i>
        <span class="menuItemText col-sm-7">سبد خرید  <span class="badge badge-info">{{ $cart }}</span></span>
    </a>
</div>
<!--
<div class="drawerItem">
    <a class="drawerItemLink" href="https://t.me/servermoghadam" target = "_blank">
        <i class="ion-paper-airplane manuItemIcon color1 col-sm-3"></i>
        <span class="menuItemText col-sm-7">تیکت در تلگرام </span>
    </a>
</div>
-->
<div class="drawerItem">
    <a class="drawerItemLink" href="{{ url('tickets') }}" target="_blank">
        <i class="ion-ios-chatboxes manuItemIcon color3 col-sm-3"></i>
        <span class="menuItemText col-sm-7">تیکت و پشتیبانی </span>
    </a>
</div>

<div class="drawerItem" style="margin-top : 2rem;">
    <div class="drawerItem" style="justify-content : center; align-items : center ;">
        <div id="pageTopLeftSide" class="animated fadeInUp">
            <a href="{{$linkInstagram}}" target="_blank" class="topSocialItem insta">
                <i class="ion-social-instagram"></i>
            </a>
            <a href="{{$linkTelegram}}" target="_blank" class="topSocialItem telegram">
                <i class="ion-paper-airplane"></i>
            </a>
        </div>
    </div>
</div>


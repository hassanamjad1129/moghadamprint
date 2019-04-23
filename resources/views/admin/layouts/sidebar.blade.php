<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-right image">
      <img src="{{ auth()->user()->avatar?asset(auth()->user()->avatar):" /adminAsset/img/avatar.png " }}" class="img-circle">
    </div>
    <div class="pull-left info">
      <p>{{ auth()->user()->name }}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> آنلاین</a>
    </div>
  </div>
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">ناوبری اصلی</li>
    <li class="active treeview">
      <a href="{{ route('adminDashboard') }}">
                <i class="fa fa-dashboard"></i> <span>پیشخوان</span>
            </a>
    </li>
    <li class="treeview">
      <a href="#">
                <i class="fa fa-clipboard"></i>
                <span>دسته بندی محصولات</span>
                <i class="fa fa-angle-left pull-left"></i>
            </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('categories.index') }}"><i class="fa fa-circle-o"></i> مدیریت دسته بندی
                        محصولات</a></li>
        <li><a href="{{ route('categories.create') }}"><i class="fa fa-circle-o"></i> افزودن به دسته بندی</a>
        </li>

        <li><a href="{{ route('subCategories.index') }}"><i class="fa fa-circle-o"></i> مدیریت زیردسته
                        محصولات</a></li>
        <li><a href="{{ route('subCategories.create') }}"><i class="fa fa-circle-o"></i> افزودن به زیردسته </a>
        </li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#">
                <i class="fa fa-truck"></i>
                <span>روش ارسال سفارشات</span>
                <i class="fa fa-angle-left pull-left"></i>
            </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('shippings.index') }}"><i class="fa fa-circle-o"></i> مدیریت روش ها</a></li>
        <li><a href="{{ route('shippings.create') }}"><i class="fa fa-circle-o"></i> افزودن به روش ها</a>
        </li>
      </ul>
    </li>

    <li class="treeview">
      <a href="#">
                <i class="fa fa-shopping-bag"></i>
                <span>محصول</span>
                <i class="fa fa-angle-left pull-left"></i>
            </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('products.create') }}"><i class="fa fa-circle-o"></i>ایجاد محصول جدید</a></li>
        <li><a href="{{ route('products.index') }}"><i class="fa fa-circle-o"></i>مدیریت محصولات</a>
        </li>
      </ul>
    </li>

    <li class="treeview">
      <a href="#">
                <i class="fa fa-file"></i>
                <span>سفارشات</span>
                <i class="fa fa-angle-left pull-left"></i>
            </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('admin.orders.incomplete') }}"><i class="fa fa-circle-o"></i>سفارشات در حال انجام</a></li>
        <li><a href="{{ route('admin.orders.completedOrders') }}"><i class="fa fa-circle-o"></i>آرشیو سفارشات</a>
        </li>
      </ul>
    </li>

    <li class="treeview">
      <a href="{{ url('tickets-admin') }}">
                <i class="fa fa-envelope"></i>
                <span>تیکت و پشتیبانی</span>
            </a>
    </li>

    <li class="treeview">
      <a href="{{ route('benefits.index') }}">
                <i class="ion-closed-captioning"></i>
                &nbsp;&nbsp;
                <span>محاسبه سود</span>
            </a>
    </li>

    <li class="treeview">
      <a href="#">
                <i class="fa fa-users"></i>
                <span>مشتریان</span>
                <i class="fa fa-angle-left pull-left"></i>
            </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('customers.index') }}"><i class="fa fa-circle-o"></i>مدیریت مشتریان</a></li>
        <li><a href="{{ route('admin.customers.notVerified') }}"><i class="fa fa-circle-o"></i>مشتریان در انتظار تایید <span class="label label-primary">{{ $notVerifiedCustomers }}</span></a></li>
      </ul>
    </li>

    <li class="treeview">
      <a href="/admin/customers/signup">
                <i class="fa fa-user-plus"></i>
                <span>ثبت نام کاربر</span>
            </a>
    </li>
    <li class="treeview">
      <a href="#">
                <i class="fa fa-folder"></i>
                <span>دانلود ها</span>
                <i class="fa fa-angle-left pull-left"></i>
            </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('admin.downloads.categories') }}"><i class="fa fa-circle-o"></i>مدیریت دسته بندی ها</a></li>
        <li><a href="{{ route('downloads.index') }}"><i class="fa fa-circle-o"></i>مدیریت دانلود ها </a></li>
      </ul>
    </li>

    <li class="treeview">
      <a href="#">
                <i class="fa fa-folder"></i>
                <span>گالری</span>
                <i class="fa fa-angle-left pull-left"></i>
            </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('admin.galleryCategory.index') }}"><i class="fa fa-circle-o"></i> دسته بندی گالری</a></li>
        <li><a href="{{ route('admin.gallery.index') }}"><i class="fa fa-circle-o"></i> گالری</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="{{ route('admin.priceLists') }}">
                <i class="fa fa-credit-card"></i>
                <span>مدیریت لیست قیمت</span>
            </a>
    </li>

    <li class="treeview">
      <a href="{{ url('admin/options') }}">
                <i class="fa fa-credit-card"></i>
                <span>تنظیمات وبسایت</span>
            </a>
    </li>

    <li class="treeview">
      <a href="{{ route('admin.slideshows') }}">
                <i class="fa fa-image"></i>
                <span>مدیریت اسلایدشو</span>
            </a>
    </li>
    
    <li class="treeview">
      <a href="{{ route('admin.sendMethod.index') }}">
                <i class="fa fa-image"></i>
                <span>مدیریت باربری</span>
            </a>
    </li>
    
    <li class="treeview">
      <a href="{{ route('admin.deliverie.index') }}">
                <i class="fa fa-image"></i>
                <span>مدیریت ارسال به شهرستان <span class="badge badge-info">{{ $countDeliveries }}</span></span>
            </a>
    </li>


    <li class="treeview">
      <a href="#">
                <i class="fa fa-folder"></i>
                <span>خدمات پس از چاپ</span>
                <i class="fa fa-angle-left pull-left"></i>
            </a>
      <ul class="treeview-menu">
        <li><a href="{{ route('admin.services.index') }}"><i class="fa fa-circle-o"></i>دسته بندی خدمات</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="{{ route('groupMessage') }}">
                <i class="fa fa-envelope"></i>
                <span>ارسال پیامک گروهی</span>
                
            </a>
    </li>

  </ul>
</section>
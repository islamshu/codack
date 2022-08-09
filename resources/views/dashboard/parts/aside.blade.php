<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
  <div class="main-menu-content">
    @if(auth()->user()->type  != 'famous')
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item  ">
            <a href="/dashboard/home">
                <i class="fa fa-tachometer"></i>
                <span class="menu-title">الرئيسية</span></a>
           
        </li>
          <li class="nav-item has-sub ">
              <a href="#">
                  <i class="fa fa-user-circle"></i>
                  <span class="menu-title">المتاجر</span></a>
              <ul class="menu-content" style="">
                  <li class="is-shown"><a class="menu-item" href="{{ route('stores.index') }}">جميع المتاجر</a>
                  </li>


              </ul>
          </li>
          <li class="nav-item has-sub ">
              <a href="#">
                  <i class="fa fa-user"></i>
                  <span class="menu-title">المشاهير</span></a>
              <ul class="menu-content" style="">
                  <li class="is-shown"><a class="menu-item" href="{{ route('famous.index') }}">جميع المشاهير</a>
                  </li>


              </ul>
          </li>
          <li class="nav-item has-sub ">
            <a href="#">
                <i class="fa fa-cog"></i>
                <span class="menu-title">الاعدادت</span></a>
            <ul class="menu-content" style="">
                
                <li class="is-shown"><a class="menu-item" href="{{ route('generalinfo.index') }}">الاعدادات العامة  </a>
                </li>
                <li class="is-shown"><a class="menu-item" href="{{ route('country.index') }}">جميع الدول</a>
                </li>
                <li class="is-shown"><a class="menu-item" href="{{ route('famoustype.index') }}">جميع المجالات</a>
                </li>
                <li class="is-shown"><a class="menu-item" href="{{ route('soical.index') }}">جميع منصات السوشل ميديا</a>
                </li>


            </ul>
        </li>
          <li class="nav-item has-sub ">
              <a href="#">
                  <i class="fa fa-bookmark"></i>
                  <span class="menu-title">اكواد الخصم</span></a>
              <ul class="menu-content" style="">
                  <li class="is-shown"><a class="menu-item" href="codes.html">جميع اكواد الخصم</a>
                  </li>


              </ul>
          </li>
          <li class="nav-item has-sub ">
              <a href="#">
                  <i class="fa fa-bookmark"></i>
                  <span class="menu-title">بوابة المشهور </span></a>
              <ul class="menu-content" style="">
                  <li class="is-shown"><a class="menu-item" href="famous_portal.html">دخول كمشهور  </a>
                  </li>


              </ul>
          </li>
      </ul>
      @endif
      @if(auth()->user()->type  == 'famous')
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item  ">
            <a href="{{ route('famous-dashboard') }}">
                <i class="fa fa-tachometer"></i>
                <span class="menu-title">الرئيسية</span></a>
           
        </li>
          <li class="nav-item has-sub ">
              <a href="#">
                  <i class="fa fa-archive"></i>
                  <span class="menu-title">المحفظة</span></a>
              <ul class="menu-content" style="">
                  <li class="is-shown"><a class="menu-item" href="{{ route('wallet') }}">المحفظة </a>
                  </li>


              </ul>
          </li>
          <li class="nav-item has-sub ">
            <a href="#">
                <i class="fa fa-cog"></i>
                <span class="menu-title">الاعدادات</span></a>
            <ul class="menu-content" style="">
                <li class="is-shown"><a class="menu-item" href="{{ route('edit_profile') }}">تعديل الملف الشخصي </a>
                </li>
                <li class="is-shown"><a class="menu-item" href="{{ route('edit_bank_profile') }}">تعديل بيانات البنك  </a>
                </li>



            </ul>
        </li>
         
      </ul>
      @endif
  </div>
</div>
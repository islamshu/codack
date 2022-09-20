<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
  <div class="main-menu-content">
    {{-- @if(auth()->user()->type  != 'famous' || auth()->user()->famous == null) --}}
    @if(auth()->user()->hasRole('Admin'))
    
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
          
        {{-- <li class="nav-item has-sub ">
            <a href="#">
                <i class="fa fa-info-circle"></i>
                <span class="menu-title"> بيانات الحسابات البنكية للمشاهير </span></a>
            <ul class="menu-content" style="">
                <li class="is-shown"><a class="menu-item" href="{{ route('changes.index') }}">طلبات تعديل بيانات الحساب البنكي   </a>
                </li>
                <li class="is-shown"><a class="menu-item" href="{{ route('my_order_admin') }}">طلبات التحويل للحساب البنكي   </a>
                </li>


            </ul>
        </li> --}}
        <li class="nav-item has-sub ">
            <a href="#">
                <i class="fa fa-archive"></i>
                <span class="menu-title">المحفظة</span></a>
            <ul class="menu-content" style="">
               
                <li class="is-shown"><a class="menu-item" href="{{ route('my_order_admin') }}">طلبات التحويل للحساب البنكي   </a>
                </li>
                <li class="is-shown"><a class="menu-item" href="{{ route('changes.index') }}">طلبات تعديل بيانات الحساب البنكي   </a>
                </li>
                <li class="is-shown"><a class="menu-item" href="{{ route('wallet') }}">عمليات الايداع للمشاهير </a>
                </li>
                

            </ul>
        </li>
          <li class="nav-item has-sub ">
              <a href="#">
                  <i class="fa fa-bookmark"></i>
                  <span class="menu-title">اكواد الخصم</span></a>
              <ul class="menu-content" style="">
                  <li class="is-shown"><a class="menu-item" href="{{ route('codes.index') }}">جميع اكواد الخصم</a>
                  </li>


              </ul>
          </li>
          <li class="nav-item  ">
            <a href="{{ route('history_for_income') }}">
                <i class="fa fa-calendar"></i>
                <span class="menu-title">سجل العمليات </span></a>
          
        </li>
          {{-- <li class="nav-item has-sub ">
            <a href="#">
                <i class="fa fa-bookmark"></i>
                <span class="menu-title">الكوبنات </span></a>
            <ul class="menu-content" style="">
                <li class="is-shown"><a class="menu-item" href="{{ route('copouns.index') }}">جميع الكوبونات </a>
                </li>


            </ul>
        </li> --}}
         
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
          
      </ul>
      @endif
     
      @if(auth()->user()->hasRole('Famous'))
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item  ">
            <a href="{{ route('famous-dashboard') }}">
                <i class="fa fa-tachometer"></i>
                <span class="menu-title">الرئيسية</span></a>
           
        </li>
        <li class="nav-item has-sub ">
            <a href="#">
                <i class="fa fa-user"></i>
                <span class="menu-title">حسابي  </span></a>
            <ul class="menu-content" style="">
                <li class="is-shown"><a class="menu-item" href="{{ route('edit_profile') }}">تعديل الملف الشخصي </a>
                </li>
                <li class="is-shown"><a class="menu-item" href="{{ route('edit_bank_profile') }}">تعديل بيانات البنك  </a>
                </li>
                <li class="is-shown"><a class="menu-item" href="{{ route('my_order_edit') }}">طلبات تغير بيانات البنك    </a>
                </li>



            </ul>
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
                  <i class="fa fa-archive"></i>
                  <span class="menu-title">المحفظة</span></a>
              <ul class="menu-content" style="">
                  <li class="is-shown"><a class="menu-item" href="{{ route('wallet') }}">اجمالي عمليات التحويل </a>
                  </li>
                  <li class="is-shown"><a class="menu-item" href="{{ route('my_order_money') }}">طلبات التحويل </a>
                  </li>


              </ul>
          </li>
          {{-- <li class="nav-item has-sub ">
            <a href="#">
                <i class="fa fa-sort"></i>
                <span class="menu-title">طلبات التحويل</span></a>
            <ul class="menu-content" style="">
                <li class="is-shown"><a class="menu-item" href="{{ route('my_order_money') }}">طلبات التحويل </a>
                </li>


            </ul>
        </li> --}}
          
       
        <li class="nav-item has-sub ">
            <a href="#">
                <i class="fa fa-bookmark"></i>
                <span class="menu-title">اكواد الخصم</span></a>
            <ul class="menu-content" style="">
                <li class="is-shown"><a class="menu-item" href="{{ route('codes.index') }}">جميع اكواد الخصم</a>
                </li>


            </ul>
        </li>
        <li class="nav-item has-sub ">
            <a href="#">
                <i class="fa fa-cog"></i>
                <span class="menu-title">الاعدادت</span></a>
            <ul class="menu-content" style="">
                
                </li>
                <li class="is-shown"><a class="menu-item" href="{{ route('country.index') }}">جميع الدول</a>
                </li>
                <li class="is-shown"><a class="menu-item" href="{{ route('famoustype.index') }}">جميع المجالات</a>
                </li>
                <li class="is-shown"><a class="menu-item" href="{{ route('soical.index') }}">جميع منصات السوشل ميديا</a>
                </li>


            </ul>
        </li>
         
      </ul>
      @endif
  </div>
</div>
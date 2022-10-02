
   <div id="sidebar-wrap" class="col-auto col-md-3 col-xl-2 px-0 flex-column d-flex">
          <div id="logo-wrap" class="flex-basis-20 flex-center w-100">
            <a href="/dashboard/home" class="d-flex align-items-center m-auto">
              <span class="fs-5 d-none d-sm-inline">
                <img src="{{asset('new_dash/images/logo.png')}}" alt="" />
              </span>
            </a>
          </div>
          <div id="navigation-wrap" class="flex-basis-80 w-100">
            @if(auth()->user()->hasRole('Admin'))
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="main-nav">
              <li class="nav-item active ps-4 pe-3">
                <a href="/dashboard/home" class="nav-link align-middle px-0">
                  <img src="{{asset('new_dash/images/icons/nav-icons/home.png')}}" class="nav-icon me-2" alt="" />
                  <span class="ms-1 d-none d-sm-inline"> الرئيسية </span>
                </a>
              </li>
              <li class="nav-item ps-4 pe-3">
                <a href="{{ route('stores.index') }}" class="nav-link align-middle px-0">
                  <img src="{{asset('new_dash/images/icons/nav-icons/vendors.png')}}" class="nav-icon me-2" alt="" />
                  <span class="ms-1 d-none d-sm-inline"> المتاجر </span>
                </a>
              </li>
              <li class="nav-item ps-4 pe-3">
                <a href="{{ route('famous.index') }}" class="nav-link align-middle px-0">
                  <img src="{{asset('new_dash/images/icons/nav-icons/famous.png')}}" class="nav-icon me-2" alt="" />
                  <span class="ms-1 d-none d-sm-inline"> المشاهير </span>
                </a>
              </li>
              <li class="nav-item ps-4 pe-3 has-children">
                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link align-middle px-0">
                  <img src="{{asset('new_dash/images/icons/nav-icons/bank-accounts.png')}}" class="nav-icon me-2" alt="" />
                  <span class="ms-1 d-none d-sm-inline"> المحفظة </span>
                </a>
                <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#main-nav">
                  <li class="w-100">
                    <a href="{{ route('my_order_admin') }}" class="nav-link align-middle px-0">
                      <img src="{{asset('new_dash/images/icons/nav-icons/discount-coupons.png')}}" class="nav-icon me-2" alt="" />
                      <span class="ms-1 d-none d-sm-inline"  >طلبات التحويل للحساب البنكي  </span>
                    </a>
                  </li>
                  <li class="w-100">
                    <a href="{{ route('changes.index') }}" class="nav-link align-middle px-0">
                      <img src="{{asset('new_dash/images/icons/nav-icons/discount-coupons.png')}}" class="nav-icon me-2" alt="" />
                      <span class="ms-1 d-none d-sm-inline" >طلبات تعديل بيانات الحساب البنكي  </span>
                    </a>
                  </li>
                  <li class="w-100">
                    <a href="{{ route('wallet') }}" class="nav-link align-middle px-0">
                      <img src="{{asset('new_dash/images/icons/nav-icons/discount-coupons.png')}}" class="nav-icon me-2" alt="" />
                      <span class="ms-1 d-none d-sm-inline">عمليات الايداع للمشاهير   </span>
                    </a>
                  </li>
                  
                </ul>
              </li>
              <li class="nav-item ps-4 pe-3">
                <a href="{{ route('codes.index') }}" class="nav-link align-middle px-0">
                  <img src="{{asset('new_dash/images/icons/nav-icons/wallet.png')}}" class="nav-icon me-2" alt="" />
                  <span class="ms-1 d-none d-sm-inline"> اكواد الخصم </span>
                </a>
              </li>
              <li class="nav-item ps-4 pe-3">
                <a href="{{ route('history_for_income') }}" class="nav-link align-middle px-0">
                  <img src="{{asset('new_dash/images/icons/nav-icons/wallet.png')}}" class="nav-icon me-2" alt="" />
                  <span class="ms-1 d-none d-sm-inline"> سجل العمليات  </span>
                </a>
              </li>
            

              <li class="nav-item ps-4 pe-3 has-children">
                <a href="#submenu2" data-bs-toggle="collapse" class="nav-link align-middle px-0">
                  <img src="{{asset('new_dash/images/icons/nav-icons/settings.png')}}" class="nav-icon me-2" alt="" />
                  <span class="ms-1 d-none d-sm-inline">الإعدادات</span>
                </a>
                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#main-nav">
                  <li class="w-100">
                    <a href="{{ route('wallet') }}" class="nav-link align-middle px-0">
                      <img src="{{asset('new_dash/images/icons/nav-icons/discount-coupons.png')}}" class="nav-icon me-2" alt="" />
                      <span class="ms-1 d-none d-sm-inline">عمليات     </span>
                    </a>
                  </li>
                  <li class="w-100">
                    <a href="{{ route('generalinfo.index') }}" class="nav-link align-middle px-0">
                        <img src="{{ asset('new_dash/images/icons/nav-icons/discount-coupons.png') }}" class="nav-icon me-2"
                            alt="" />
                        <span class="ms-1 d-none d-sm-inline"> الاعدادات العامة </span>
                    </a>
                </li>
                <li class="w-100">
                    <a href="{{ route('country.index') }}" class="nav-link align-middle px-0">
                        <img src="{{ asset('new_dash/images/icons/nav-icons/discount-coupons.png') }}" class="nav-icon me-2"
                            alt="" />
                        <span class="ms-1 d-none d-sm-inline"> جميع الدول </span>
                    </a>
                </li>
                <li class="w-100">
                    <a href="{{ route('famoustype.index') }}" class="nav-link align-middle px-0">
                        <img src="{{ asset('new_dash/images/icons/nav-icons/discount-coupons.png') }}" class="nav-icon me-2"
                            alt="" />
                        <span class="ms-1 d-none d-sm-inline"> جميع المجالات </span>
                    </a>
                </li>
                <li class="w-100">
                    <a href="{{ route('soical.index') }}" class="nav-link align-middle px-0">
                        <img src="{{ asset('new_dash/images/icons/nav-icons/discount-coupons.png') }}" class="nav-icon me-2"
                            alt="" />
                        <span class="ms-1 d-none d-sm-inline"> جميع منصات السوشل ميديا </span>
                    </a>
                </li>
                </ul>
              </li>
            </ul>
            @else
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="main-nav">
            
            <li class="nav-item  ps-4 pe-3">
              <a href="index.html" class="nav-link align-middle px-0">
                <img src="{{asset('new_dash/images/icons/nav-icons/home.png')}}" class="nav-icon me-2" alt="" />
                <span class="ms-1 d-none d-sm-inline"> الرئيسية </span>
              </a>
            </li>
            
            <li class="nav-item ps-4 pe-3 has-children">
              <a href="#submenu3" data-bs-toggle="collapse" class="nav-link align-middle px-0">
                <img src="{{asset('new_dash/images/icons/nav-icons/user.png')}}" class="nav-icon me-2" alt="" />
                <span class="ms-1 d-none d-sm-inline">حسابي</span>
              </a>
              <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#main-nav">
                <li class="w-100">
                  <a href="{{ route('edit_profile') }}" class="nav-link align-middle px-0">
                    <img src="{{asset('new_dash/images/icons/nav-icons/discount-coupons.png')}}" class="nav-icon me-2" alt="" />
                    <span class="ms-1 d-none d-sm-inline">تعديل الملف الشخصي</span>
                  </a>
                </li>

                <li>
                  <a href="{{ route('edit_bank_profile') }}" class="nav-link align-middle px-0">
                    <img src="{{asset('new_dash/images/icons/nav-icons/discount-coupons.png')}}" class="nav-icon me-2" alt="" />
                    <span class="ms-1 d-none d-sm-inline">تعديل بيانات البنك</span>
                  </a>
                </li>

                <li class="active">
                  <a href="{{ route('my_order_edit') }}" class="nav-link align-middle px-0">
                    <img src="{{asset('new_dash/images/icons/nav-icons/discount-coupons.png')}}" class="nav-icon me-2" alt="" />
                    <span class="ms-1 d-none d-sm-inline">طلبات تغيير بيانات البنك</span>
                  </a>
                </li>

              </ul>
            </li>

            <li class="nav-item ps-4 pe-3">
              <a href="{{ route('stores.index') }}" class="nav-link align-middle px-0">
                <img src="{{asset('new_dash/images/icons/nav-icons/vendors.png')}}" class="nav-icon me-2" alt="" />
                <span class="ms-1 d-none d-sm-inline"> المتاجر </span>
              </a>
            </li>

            <li class="nav-item ps-4 pe-3 has-children">
              <a href="#submenu1" data-bs-toggle="collapse" class="nav-link align-middle px-0">
                <img src="{{asset('new_dash/images/icons/nav-icons/bank-accounts.png')}}" class="nav-icon me-2" alt="" />
                <span class="ms-1 d-none d-sm-inline"> المحفظة</span>
              </a>
              <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#main-nav">

                <li>
                  <a href="{{ route('wallet') }}" class="nav-link align-middle px-0">
                    <img src="{{asset('new_dash/images/icons/nav-icons/discount-coupons.png')}}" class="nav-icon me-2" alt="" />
                    <span class="ms-1 d-none d-sm-inline"> اجمالي طلبات التحويل </span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('my_order_money') }}" class="nav-link align-middle px-0">
                    <img src="{{asset('new_dash/images/icons/nav-icons/discount-coupons.png')}}" class="nav-icon me-2" alt="" />
                    <span class="ms-1 d-none d-sm-inline"> طلبات التحويل </span>
                  </a>
                </li>
              </ul>
            </li>
          
            <li class="nav-item ps-4 pe-3">
              <a href="{{ route('codes.index') }}" class="nav-link align-middle px-0">
                <img src="{{asset('new_dash/images/icons/nav-icons/discount-coupons.png')}}" class="nav-icon me-2" alt="" />
                <span class="ms-1 d-none d-sm-inline"> أكواد الخصم </span>
              </a>
            </li>

            <li class="nav-item ps-4 pe-3 has-children">
              <a href="#submenu2" data-bs-toggle="collapse" class="nav-link align-middle px-0">
                <img src="{{asset('new_dash/images/icons/nav-icons/settings.png')}}" class="nav-icon me-2" alt="" />
                <span class="ms-1 d-none d-sm-inline">الإعدادات</span>
              </a>
              <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#main-nav">
               
                <li class="w-100">
                  <a href="{{ route('country.index') }}" class="nav-link align-middle px-0">
                    <img src="{{asset('new_dash/images/icons/nav-icons/discount-coupons.png')}}" class="nav-icon me-2" alt="" />
                    <span class="ms-1 d-none d-sm-inline"> جميع الدول </span>
                  </a>
                </li>
                <li>
                  <a href="{{ route('famoustype.index') }}" class="nav-link align-middle px-0">
                    <img src="{{asset('new_dash/images/icons/nav-icons/discount-coupons.png')}}" class="nav-icon me-2" alt="" />
                    <span class="ms-1 d-none d-sm-inline"> جميع المجالات </span>
                  </a>
                </li>

                <li>
                  <a href="{{ route('soical.index') }}" class="nav-link align-middle px-0">
                    <img src="{{asset('new_dash/images/icons/nav-icons/discount-coupons.png')}}" class="nav-icon me-2" alt="" />
                    <span class="ms-1 d-none d-sm-inline"> جميع المنصات </span>
                  </a>
                </li>
              </ul>
            </li>
            </ul>
            @endif
          </div>
        </div>
<div id="content-header" class="primary-background px-4 py-3">
    <div class="row flex-nowrap">
        <div class="col-6 text-start">
            <a href="" class="mx-2"><img src="{{ asset('new_dash/images/icons/nav-back.png') }}"
                    alt="" /></a>
            <a href="" class="mx-2"><img src="{{ asset('new_dash/images/icons/full-screen.png') }}"
                    alt="" /></a>
            <a href="" class="mx-2"><img src="{{ asset('new_dash/images/icons/refresh.png') }}"
                    alt="" /></a>
        </div>
        <div class="col-6 text-end">

            {{ auth()->user()->name }}
            @php
          $notifications = auth()->user()->unreadNotifications;
          $count = auth()->user()->unreadNotifications->count();

         @endphp
         
            <a style=" width: 14% !important;" class="nav-link dropdown-toggle d-inline-block" href="#"
                role="button" data-bs-toggle="dropdown" aria-expanded="false" class="mx-2">{{ $count }}<img
                    src="{{ asset('new_dash/images/icons/notifications.png') }}" alt="" /> </a>

            <ul class="dropdown-menu">
              @foreach  ($notifications as $item)

                <li>

                  <a class="dropdown-item" href="{{ route('show.notification',$item->id) }}">@if(get_lang() == 'ar') {{$item->data['title_ar'] }} @else {{$item->data['title_en'] }} @endif</a>
                          </li>
                          @endforeach

            </ul>
            <a style=" width: 8% !important;" class="nav-link dropdown-toggle d-inline-block" href="#"
                role="button" data-bs-toggle="dropdown" aria-expanded="false" class="mx-2"><img
                    src="{{ asset('new_dash/images/icons/account.png') }}" alt="" /></a>
            <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item" href="{{ route('logout') }}">تسجيل خروج <img
                            src="{{ asset('new_dash/images/icons/view.png') }}" class="ms-2" alt="" /></a>
                </li>
            </ul>
        </div>

    </div>
</div>

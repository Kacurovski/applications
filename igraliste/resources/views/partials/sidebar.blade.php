@vite([
'resources/js/sidebar.js',
'resources/css/components/sidebar.css'

])

<div class="sidebar p-1 sidebar-collapse h-100">
    <div class="profile d-flex p-2 mb-3 mt-2 ">
        <div>
            @php
            $adminImage = auth()->user()->picture ? Storage::url(auth()->user()->picture) : asset('images/default-profile-image.png');
            @endphp
            <img src="{{ $adminImage }}" alt="">
        </div>
        <div class="d-none profile-collapsed">
            <div>
                <p class="p-0 m-0 ms-3 fw-bold">{{ auth()->user()->name }}</p>
                <p class="p-0 m-0 ms-3 fw-normal">{{ auth()->user()->email }}</p>
            </div>
            <button class="disable-expand btn-close-sidebar position-absolute top-0 end-0 me-4 mt-3" aria-label="Close">
                <img src="{{ asset('images/close-icon.svg') }}" alt="Close" class="img-fluid disable-expand">
            </button>
        </div>
    </div>
    <ul class="p-3 pb-0 sidebar-elements h-100 position-relative">
        <li class="sidebar-li-elements d-flex justify-content-start align-items-start rounded-3 mb-2 p-0 {{ Request::routeIs('homepage') ? 'active' : '' }}">
            <a href="{{ route('homepage') }}" class="a_tags p-3 disable-expand">
                <div class="d-flex disable-expand">
                    <div class="disable-expand">
                        <img src="{{ asset('images/products.svg') }}" alt="" class="disable-expand">
                    </div>
                    <p class="d-none p-0 m-0 ms-2 fw-bold text-secondary collapsed">Vintage облека</p>
                </div>
            </a>
        </li>
        <li class="sidebar-li-elements d-flex justify-content-start align-items-start rounded-3 mb-2 p-0 {{ Request::routeIs('discounts.index') ? 'active' : '' }}">
            <a href="{{ route('discounts.index') }}" class="a_tags p-3 disable-expand">
                <div class="d-flex disable-expand">
                    <div class="disable-expand">
                        <img src="{{ asset('images/menu.svg') }}" alt="" class="disable-expand">
                    </div>
                    <p class="d-none p-0 m-0 ms-2 fw-bold text-secondary collapsed">Попусти/промо</p>
                </div>
            </a>
        </li>
        <li class="sidebar-li-elements d-flex justify-content-start align-items-start rounded-3 mb-2 p-0 {{ Request::routeIs('brands.index') ? 'active' : '' }}">
            <a href="{{ route('brands.index') }}" class="a_tags p-3 disable-expand">
                <div class="d-flex disable-expand">
                    <div class=" disable-expand">
                        <img src="{{ asset('images/brands.svg') }}" alt="" class="disable-expand">
                    </div>
                    <p class="d-none p-0 m-0 ms-2 fw-bold text-secondary collapsed">Брендови</p>
                </div>
            </a>
        </li>
        <li class="sidebar-li-elements d-flex justify-content-start align-items-start rounded-3 mb-2 p-0 {{ Request::routeIs('admin.profile') ? 'active' : '' }}">
            <a href="{{route('admin.profile')}}" class="a_tags disable-expand p-3">
                <div class="d-flex disable-expand">
                    <div class=" disable-expand">
                        <img src="{{ asset('images/profile.svg') }}" alt="" class="disable-expand">
                    </div>
                    <p class="d-none p-0 m-0 ms-2 fw-bold text-secondary collapsed">Профил</p>
                </div>
            </a>
        </li>
        <li class="position-absolute bottom-0 sidebar-li-elements d-flex justify-content-start align-items-start rounded p-0 @if(Request::is('logout')) active @endif">
            <form action="{{ route('admin.logout') }}" method="POST" class="a_tags disable-expand p-2">
                @csrf
                <button type="submit" class="d-flex disable-expand align-items-center border-0 bg-transparent p-0">
                    <div class="disable-expand">
                        <img src="{{ asset('images/logout-icon-expanded.svg') }}" alt="" class="disable-expand logout-icon logout-border">
                    </div>
                    <p class="d-none p-0 m-0 ms-2 fw-bold text-secondary collapsed">Одјави се</p>
                </button>
            </form>
        </li>
    </ul>
</div>
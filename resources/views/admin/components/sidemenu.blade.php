<div id="mySidenav" class="sidenav hide">

    <div class="sidemenu-toggler text-center w-100px my-5" onclick="toggleNav()">
        <i class="fa fa-bars fa-2x" style="color: white"></i>
    </div>

    <div class="text-center w-100px my-5">
        <img style="width: 80%" src="{{ asset('images/icon.png') }}" alt="logo" srcset="">
    </div>
        <a class="py-4" href="{{ route('shoop2', [app()->getLocale()]) }}"><i
            class="fa fa-2x fa-id-card w-100px text-center"></i><span>csascasc</span></a>        
            
    <a class="py-4" href="{{ route('admin.users.index', [app()->getLocale()]) }}"><i
            class="fa fa-2x fa-user w-100px text-center"></i><span>{{ __('Manage Users') }}</span></a>
    <a class="py-4" href="{{ route('admin.banners', [app()->getLocale()]) }}"><i
            class="fa fa-2x fa-sticky-note w-100px text-center"></i><span>{{ __('Banners') }}</span></a>
    <a class="py-4" href="{{ route('admin.realestates', [app()->getLocale()]) }}"><i
            class="fa fa-2x fa-home w-100px text-center"></i><span>{{ __('Real Estates') }}</span></a>
    <a class="py-4" href="{{ route('admin.approve_real_estates_page', [app()->getLocale()]) }}"><i
            class="fa fa-2x fa-dollar w-100px text-center"></i><span>{{ __('Paid Real Estates') }}</span></a>
    <a class="py-4" href="{{ route('admin.comments', [app()->getLocale()]) }}"><i
            class="fa fa-2x fa-comments w-100px text-center"></i><span>{{ __('Comments') }}</span></a>
    <a class="py-4" href="{{ route('admin.testimonials', [app()->getLocale()]) }}"><i
            class="fa fa-2x fa-id-card w-100px text-center"></i><span>{{ __('Testimonials') }}</span></a>

</div>

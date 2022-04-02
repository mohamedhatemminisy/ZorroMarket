<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">


            <li class=" nav-item"><a href="{{route('admin.dashboard')}}"><i class="la la-arrows-h"></i><span class="menu-title" data-i18n="nav.horz_nav.main">{{trans('admin.home')}}</span></a>
            </li>


            <li class=" nav-item"><a href="{{route('users')}}"><i class="la la-arrows-h"></i><span class="menu-title" data-i18n="nav.horz_nav.main">{{trans('admin.users')}}</span></a>
            </li>


            <li class=" nav-item"><a href="#"><i class="la la-arrows-h"></i><span class="menu-title" data-i18n="nav.horz_nav.main">{{trans('admin.categories')}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('categories.create')}}" data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                            {{trans('admin.create_category')}}</a>
                    </li>
                    <li><a class="menu-item" href="{{route('categories.index')}}" data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                            {{trans('admin.show_categories')}}</a>

                    </li>
                </ul>
            </li>


            <li class=" nav-item"><a href="{{route('contact')}}"><i class="la la-arrows-h"></i><span class="menu-title" data-i18n="nav.horz_nav.main">{{trans('admin.contact')}}</span></a>
            </li>
        </ul>
    </div>
</div>
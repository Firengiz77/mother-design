  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="{{route('admin.index')}}" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="{{ asset('admin/logo/logo.png') }}" width="160px">
              </span>

            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item @if(Route::is('admin.index')) active @endif">
              <a href="{{route('admin.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">{{ __('Dashboard') }}</div>
              </a>
            </li>

      
            @can(['role-list','permission-list'])
            <li class="menu-item @if(Route::is('admin.roles') || Route::is('admin.roles')) active @endif">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="fa fa-rocket menu-icon" aria-hidden="true"></i>
                <div data-i18n="Account Settings"> {{ __('Roles') }} {{ __('and')}} {{__('Permissions')}} </div>
              </a>
              <ul class="menu-sub">
                @can('role-list')
                <li class="menu-item">
                  <a href="{{route('admin.roles.index')}}" class="menu-link">
                  <i class="fa fa-users menu-icon" aria-hidden="true"></i>
                    <div data-i18n="Roles"> {{ __('Roles') }} </div>
                  </a>
                </li>
                @endcan
                @can('permission-list')
                <li class="menu-item">
                  <a href="{{route('admin.permissions.index')}}" class="menu-link">
                  <i class="fa fa-check-square-o menu-icon" aria-hidden="true"></i>
                    <div data-i18n="Permissions"> {{ __('Permissions') }} </div>
                  </a>
                </li>
                @endcan

              </ul>
            </li>
            @endcan


            <li class="menu-item @if(Route::is('admin.roles') || Route::is('admin.roles')) active @endif">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="fa fa-sliders menu-icon" aria-hidden="true"></i>
                <div data-i18n="Account Settings"> {{ __('Site Settings') }}</div>
              </a>
              <ul class="menu-sub">
          
              @can('contact-list')
                <li class="menu-item">
                  <a href="{{route('admin.setting.edit',1)}}" class="menu-link">
                  <i class="fa fa-file menu-icon" aria-hidden="true"></i>

                    <div data-i18n="Site Setting"> {{ __('Site Settings') }} </div>
                  </a>
                </li>
                @endcan


                @can('contact-list')
                <li class="menu-item">
                  <a href="{{route('admin.contact.edit',1)}}" class="menu-link">
                  <i class="fa fa-phone menu-icon" aria-hidden="true"></i>
                    <div data-i18n="Contact"> {{ __('Contact') }} </div>
                  </a>
                </li>
                @endcan
                @can('about-list')
                <li class="menu-item">
                  <a href="{{route('admin.about.index')}}" class="menu-link">
                  <i class="fa fa-file-text-o menu-icon" aria-hidden="true"></i>
                    <div data-i18n="About"> {{ __('About') }} </div>
                  </a>
                </li>
                @endcan
                @can('socialLink-list')
                <li class="menu-item">
                  <a href="{{route('admin.socialLink.index')}}" class="menu-link">
                  <i class="fa fa-facebook menu-icon" aria-hidden="true"></i>
                    <div data-i18n="SocialLink"> {{ __('SM Link') }} </div>
                  </a>
                </li>
                @endcan

              </ul>
            </li>
      

            @can('slider-list')
                <li class="menu-item">
                  <a href="{{route('admin.slider.index')}}" class="menu-link">
                  <i class="fa fa-file-image-o menu-icon" aria-hidden="true"></i>
                    <div data-i18n="Slider"> {{ __('Slider') }} </div>
                  </a>
                </li>
                @endcan
  
                
            @can('family-list')
                <li class="menu-item">
                  <a href="{{route('admin.family.index')}}" class="menu-link">
                  <i class="fa fa-users menu-icon" aria-hidden="true"></i>
                    <div data-i18n="Family"> {{ __('Family') }} </div>
                  </a>
                </li>
                @endcan

                @can('work-list')
                <li class="menu-item">
                  <a href="{{route('admin.work.index')}}" class="menu-link">
                  <i class="fa fa-briefcase menu-icon" aria-hidden="true"></i>
                    <div data-i18n="Work"> {{ __('Work') }} </div>
                  </a>
                </li>
                @endcan
                

                
                @can('word-list')
                <li class="menu-item">
                  <a href="{{route('admin.word.index')}}" class="menu-link">
                  <i class="fa fa-sort-alpha-desc menu-icon" aria-hidden="true"></i>
                    <div data-i18n="Word"> {{ __('Word') }} </div>
                  </a>
                </li>
                @endcan

            


         

               
            <li class="menu-item @if(Route::is('admin.account') || Route::is('admin.register')) active @endif">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings"> {{ __('Settings') }} </div>
              </a>
              <ul class="menu-sub">

                <li class="menu-item">
                  <a href="{{route('admin.account')}}" class="menu-link">
                  <i class="fa fa-user menu-icon" aria-hidden="true"></i>
                    <div data-i18n="Account"> {{ __('Account') }} </div>
                  </a>
                </li>
                @can('admin-list')
                <li class="menu-item">
                  <a href="{{route('admin.all')}}" class="menu-link">
                  <i class="fa fa-smile-o menu-icon" aria-hidden="true"></i>
                    <div data-i18n="Notifications">{{ __('All Admin') }}</div>
                  </a>
                </li>
                @endcan

              </ul>
            </li>
         



              @can('language-list')
            <li class="menu-item @if(Route::is('admin.language.index')) active @endif">
              <a href="{{route('admin.language.index')}}" class="menu-link">
                <i class='bx bx-flag menu-icon'></i>
                <div data-i18n="Notifications">{{ __('Language')}} </div>
              </a>
            </li>
            @endcan



        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
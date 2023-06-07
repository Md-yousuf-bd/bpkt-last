<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-info elevation-4">
    <!-- Brand Logo -->

    <a href="{{route('home')}}" class="brand-link navbar-light-info">
        <img src="{{asset('images/logos/logo.png')}}" alt="{{ config('app.name', 'Laravel') }} Logo" class="brand-image img-circle elevation-3"
             style="opacity: 1;">
        <span class="brand-text" title="{{ config('app.full_name', 'Laravel') }}"> {{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(auth()->user()->can('edit-profile'))
                    <a href="{{route('profile_edit')}}" title="@lang('commons/sidebar_menu.Click to see Profile Detail.')" class="d-block">
                    @if(\Illuminate\Support\Facades\Auth::user()->detail->picture==null || \Illuminate\Support\Facades\Auth::user()->detail->picture=='')
                        <img src="{{asset('images/defaults/user_profile_picture.png')}}" class="img-circle elevation-2" alt="User Image" >
                    @else
                        <img src="{{asset('storage/images/users/'.\Illuminate\Support\Facades\Auth::user()->detail->picture)}}"  class="img-circle elevation-2" alt="User Image">
                    @endif
                    </a>
                @else
                    <a href="" title="Click to see Profile Detail." class="d-block">
                        @if(\Illuminate\Support\Facades\Auth::user()->detail->picture==null || \Illuminate\Support\Facades\Auth::user()->detail->picture=='')
                            <img src="{{asset('images/defaults/user_profile_picture.png')}}" class="img-circle elevation-2" alt="User Image" >
                        @else
                            <img src="{{asset('storage/images/users/'.\Illuminate\Support\Facades\Auth::user()->detail->picture)}}"  class="img-circle elevation-2" alt="User Image">
                        @endif
                    </a>
                @endif
            </div>
            <div class="info">
                @if(auth()->user()->can('edit-profile'))
                <a href="{{route('profile_edit')}}" class="d-block" title="@lang('commons/sidebar_menu.Click to see Profile Detail.')">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                @else
                <a href="" class="d-block" title="@lang('commons/sidebar_menu.Click to see Profile Detail.')">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
                @endif
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm nav-legacy" style="line-height: 2;" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link @if($page_name=='Dashboard') active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            @lang('commons/sidebar_menu.Dashboard')
                        </p>
                    </a>
                </li>

                @if(auth()->user()->can('read-code')
                    ||auth()->user()->can('create-code')
                    )
                    <li class="nav-item has-treeview  @if(in_array($page_name,['Code List','Add Code','Edit Code'])) menu-open @endif">
                        <a href="#" class="nav-link  @if(in_array($page_name,['Code List','Add Code','Edit Code'])) active @endif">
                            <i class="nav-icon fa fa-cubes"></i>
                            <p>
                                @lang('commons/sidebar_menu.Codes')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(auth()->user()->can('read-code'))
                                <li class="nav-item">
                                    <a href="{{route('code.index')}}" class="nav-link @if(in_array($page_name,['Code List'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('commons/sidebar_menu.List')</p>
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->can('create-code'))
                                <li class="nav-item">
                                    <a href="{{route('code.create')}}" class="nav-link @if(in_array($page_name,['Add Code'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('commons/sidebar_menu.Add')</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(auth()->user()->can('read-code-allotment')
                    ||auth()->user()->can('create-code-allotment')
                    )
                    <li class="nav-item has-treeview  @if(in_array($page_name,['Code Allotment List','Add Code Allotment','Edit Code Allotment','Show Code Allotment'])) menu-open @endif">
                        <a href="#" class="nav-link  @if(in_array($page_name,['Code Allotment List','Add Code Allotment','Edit Code Allotment','Show Code Allotment'])) active @endif">
                            <i class="nav-icon fa fa-money-bill-wave-alt"></i>
                            <p>
                                @lang('commons/sidebar_menu.Code Allotments')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(auth()->user()->can('read-code-allotment'))
                                <li class="nav-item">
                                    <a href="{{route('code-allotment.index')}}" class="nav-link @if(in_array($page_name,['Code Allotment List'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('commons/sidebar_menu.List')</p>
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->can('create-code-allotment'))
                                <li class="nav-item">
                                    <a href="{{route('code-allotment.create')}}" class="nav-link @if(in_array($page_name,['Add Code Allotment'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('commons/sidebar_menu.Add')</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(auth()->user()->can('read-code-surrender')
                     ||auth()->user()->can('create-code-surrender')
                     ||auth()->user()->can('edit-master-surrender-letter')
                     ||auth()->user()->can('read-surrender-letter')
                     ||auth()->user()->can('add-surrender-letter')
                     )
                    <li class="nav-item has-treeview  @if(in_array($page_name,['Code Surrender List','Add Code Surrender','Edit Code Surrender','Show Code Surrender','Edit Master Surrender Letter','Surrender Letter List','Add Surrender Letter','Edit Surrender Letter','Show Surrender Letter'])) menu-open @endif">
                        <a href="#" class="nav-link  @if(in_array($page_name,['Code Surrender List','Add Code Surrender','Edit Code Surrender','Show Code Surrender','Edit Master Surrender Letter','Surrender Letter List','Add Surrender Letter','Edit Surrender Letter','Show Surrender Letter'])) active @endif">
                            <i class="nav-icon fa fa-money-check"></i>
                            <p>
                                @lang('commons/sidebar_menu.Code Surrenders')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(auth()->user()->can('read-code-surrender'))
                                <li class="nav-item">
                                    <a href="{{route('code-surrender.index')}}" class="nav-link @if(in_array($page_name,['Code Surrender List'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('commons/sidebar_menu.List')</p>
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->can('create-code-surrender'))
                                <li class="nav-item">
                                    <a href="{{route('code-surrender.create')}}" class="nav-link @if(in_array($page_name,['Add Code Surrender'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('commons/sidebar_menu.Add')</p>
                                    </a>
                                </li>
                            @endif
                                @if(auth()->user()->can('edit-master-surrender-letter')
                                ||auth()->user()->can('read-surrender-letter')
                                ||auth()->user()->can('add-surrender-letter'))
                                    <li class="nav-item has-treeview @if(in_array($page_name,['Edit Master Surrender Letter','Surrender Letter List','Add Surrender Letter','Edit Surrender Letter','Show Surrender Letter'])) menu-open @endif">
                                        <a href="#" class="nav-link  @if(in_array($page_name,['Edit Master Surrender Letter','Surrender Letter List','Add Surrender Letter','Edit Surrender Letter','Show Surrender Letter'])) active @endif">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>
                                                @lang('commons/sidebar_menu.Letters')
                                                <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            @if(auth()->user()->can('edit-master-surrender-letter'))
                                                <li class="nav-item">
                                                    <a href="{{route('master-surrender-letter.edit')}}" class="nav-link @if(in_array($page_name,['Edit Master Surrender Letter'])) active @endif">
                                                        <i class="far fa-dot-circle nav-icon"></i>
                                                        <p>@lang('commons/sidebar_menu.Master Letter')</p>
                                                    </a>
                                                </li>
                                            @endif
                                            @if(auth()->user()->can('read-surrender-letter'))
                                                <li class="nav-item">
                                                    <a href="{{route('code-surrender-letter.index')}}" class="nav-link @if(in_array($page_name,['Surrender Letter List'])) active @endif">
                                                        <i class="far fa-dot-circle nav-icon"></i>
                                                        <p>@lang('commons/sidebar_menu.List')</p>
                                                    </a>
                                                </li>
                                            @endif
                                            @if(auth()->user()->can('create-surrender-letter'))
                                                <li class="nav-item">
                                                    <a href="{{route('code-surrender-letter.create')}}" class="nav-link @if(in_array($page_name,['Add Surrender Letter'])) active @endif">
                                                        <i class="far fa-dot-circle nav-icon"></i>
                                                        <p>@lang('commons/sidebar_menu.Add')</p>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </li>
                                @endif
                        </ul>
                    </li>
                @endif

{{--                @if(auth()->user()->can('read-recipient')--}}
{{--                    ||auth()->user()->can('create-recipient')--}}
{{--                    )--}}
{{--                    <li class="nav-item has-treeview  @if(in_array($page_name,['Recipient List','Add Recipient','Edit Recipient','Show Recipient'])) menu-open @endif">--}}
{{--                        <a href="#" class="nav-link  @if(in_array($page_name,['Recipient List','Add Recipient','Edit Recipient','Show Recipient'])) active @endif">--}}
{{--                            <i class="nav-icon fa fa-users"></i>--}}
{{--                            <p>--}}
{{--                                @lang('commons/sidebar_menu.Recipients')--}}
{{--                                <i class="right fas fa-angle-left"></i>--}}
{{--                            </p>--}}
{{--                        </a>--}}
{{--                        <ul class="nav nav-treeview">--}}
{{--                            @if(auth()->user()->can('read-recipient'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{route('recipient.index')}}" class="nav-link @if(in_array($page_name,['Recipient List'])) active @endif">--}}
{{--                                        <i class="far fa-circle nav-icon"></i>--}}
{{--                                        <p>@lang('commons/sidebar_menu.List')</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                            @if(auth()->user()->can('create-recipient'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="{{route('recipient.create')}}" class="nav-link @if(in_array($page_name,['Add Recipient'])) active @endif">--}}
{{--                                        <i class="far fa-circle nav-icon"></i>--}}
{{--                                        <p>@lang('commons/sidebar_menu.Add')</p>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                @endif--}}

                @if(auth()->user()->can('read-unit')
                    ||auth()->user()->can('create-unit')
                    )
                    <li class="nav-item has-treeview  @if(in_array($page_name,['Unit List','Add Unit','Edit Unit','Show Unit'])) menu-open @endif">
                        <a href="#" class="nav-link  @if(in_array($page_name,['Unit List','Add Unit','Edit Unit','Show Unit'])) active @endif">
                            <i class="nav-icon fa fa-university"></i>
                            <p>
                                @lang('commons/sidebar_menu.Units')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(auth()->user()->can('read-unit'))
                                <li class="nav-item">
                                    <a href="{{route('unit.index')}}" class="nav-link @if(in_array($page_name,['Unit List'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('commons/sidebar_menu.List')</p>
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->can('create-unit'))
                                <li class="nav-item">
                                    <a href="{{route('unit.create')}}" class="nav-link @if(in_array($page_name,['Add Unit'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('commons/sidebar_menu.Add')</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(auth()->user()->can('read-unit-allotment')
                    ||auth()->user()->can('create-unit-allotment')
                    ||auth()->user()->can('edit-master-allotment-letter')
                    ||auth()->user()->can('read-allotment-letter')
                    ||auth()->user()->can('add-allotment-letter')
                    )
                    <li class="nav-item has-treeview  @if(in_array($page_name,['Unit Allotment List','Add Unit Allotment','Edit Unit Allotment','Show Unit Allotment','Edit Master Allotment Letter','Allotment Letter List','Add Allotment Letter','Edit Allotment Letter','Show Allotment Letter'])) menu-open @endif">
                        <a href="#" class="nav-link  @if(in_array($page_name,['Unit Allotment List','Add Unit Allotment','Edit Unit Allotment','Show Unit Allotment','Edit Master Allotment Letter','Allotment Letter List','Add Allotment Letter','Edit Allotment Letter','Show Allotment Letter'])) active @endif">
                            <i class="nav-icon fa fa-money-check-alt"></i>
                            <p>
                                @lang('commons/sidebar_menu.Unit Allotments')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(auth()->user()->can('read-unit-allotment'))
                                <li class="nav-item">
                                    <a href="{{route('unit-allotment.index')}}" class="nav-link @if(in_array($page_name,['Unit Allotment List'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('commons/sidebar_menu.List')</p>
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->can('create-unit-allotment'))
                                <li class="nav-item">
                                    <a href="{{route('unit-allotment.create')}}" class="nav-link @if(in_array($page_name,['Add Unit Allotment'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('commons/sidebar_menu.Add')</p>
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->can('edit-master-allotment-letter')
                            ||auth()->user()->can('read-allotment-letter')
                            ||auth()->user()->can('add-allotment-letter'))
                                <li class="nav-item has-treeview @if(in_array($page_name,['Edit Master Allotment Letter','Allotment Letter List','Add Allotment Letter','Edit Allotment Letter','Show Allotment Letter'])) menu-open @endif">
                                    <a href="#" class="nav-link  @if(in_array($page_name,['Edit Master Allotment Letter','Allotment Letter List','Add Allotment Letter','Edit Allotment Letter','Show Allotment Letter'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            @lang('commons/sidebar_menu.Letters')
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if(auth()->user()->can('edit-master-allotment-letter'))
                                            <li class="nav-item">
                                                <a href="{{route('master-allotment-letter.edit')}}" class="nav-link @if(in_array($page_name,['Edit Master Allotment Letter'])) active @endif">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>@lang('commons/sidebar_menu.Master Letter')</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if(auth()->user()->can('read-allotment-letter'))
                                            <li class="nav-item">
                                                <a href="{{route('unit-allotment-letter.index')}}" class="nav-link @if(in_array($page_name,['Allotment Letter List'])) active @endif">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>@lang('commons/sidebar_menu.List')</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if(auth()->user()->can('create-allotment-letter'))
                                            <li class="nav-item">
                                                <a href="{{route('unit-allotment-letter.create')}}" class="nav-link @if(in_array($page_name,['Add Allotment Letter'])) active @endif">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>@lang('commons/sidebar_menu.Add')</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(auth()->user()->can('read-unit-surrender')
                    ||auth()->user()->can('create-unit-surrender')
                    )
                    <li class="nav-item has-treeview  @if(in_array($page_name,['Unit Surrender List','Add Unit Surrender','Edit Unit Surrender','Show Unit Surrender'])) menu-open @endif">
                        <a href="#" class="nav-link  @if(in_array($page_name,['Unit Surrender List','Add Unit Surrender','Edit Unit Surrender','Show Unit Surrender'])) active @endif">
                            <i class="nav-icon fa fa-money-bill"></i>
                            <p>
                                @lang('commons/sidebar_menu.Unit Surrenders')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(auth()->user()->can('read-unit-surrender'))
                                <li class="nav-item">
                                    <a href="{{route('unit-surrender.index')}}" class="nav-link @if(in_array($page_name,['Unit Surrender List'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('commons/sidebar_menu.List')</p>
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->can('create-unit-surrender'))
                                <li class="nav-item">
                                    <a href="{{route('unit-surrender.create')}}" class="nav-link @if(in_array($page_name,['Add Unit Surrender'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('commons/sidebar_menu.Add')</p>
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->can('create-unit-surrender'))
                                <li class="nav-item">
                                    <a href="{{route('unit-surrender.create-expense')}}" class="nav-link @if(in_array($page_name,['Add Unit Expense'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('commons/sidebar_menu.Unit Expense')</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(auth()->user()->can('read-allotment-report')
                    ||auth()->user()->can('read-top-sheet'))
                    <li class="nav-item has-treeview @if(in_array($page_name,['Allotment Report','Top Sheet'])) menu-open @endif">
                        <a href="#" class="nav-link  @if(in_array($page_name,['Allotment Report','Top Sheet'])) active @endif">
                            <i class="fa fa-columns nav-icon"></i>
                            <p>
                                @lang('commons/sidebar_menu.Report')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(auth()->user()->can('read-allotment-report'))
                                <li class="nav-item">
                                    <a href="{{route('report.allotment-report')}}" class="nav-link @if(in_array($page_name,['Allotment Report'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('commons/sidebar_menu.Allotment Report')</p>
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->can('read-top-sheet'))
                                <li class="nav-item">
                                    <a href="{{route('report.top-sheet')}}" class="nav-link @if(in_array($page_name,['Top Sheet'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('commons/sidebar_menu.Top Sheet')</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                 {{-- new --}}
                @if(auth()->user()->can('read-allotment-report')
                    ||auth()->user()->can('read-top-sheet'))
                    <li class="nav-item has-treeview @if(in_array($page_name,['Allotment Report','Top Sheet'])) menu-open @endif">
                        <a href="#" class="nav-link  @if(in_array($page_name,['Allotment Report','Top Sheet'])) active @endif">
                            <i class="fa fa-columns nav-icon"></i>
                            <p>
                                @lang('commons/sidebar_menu.Report new')
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if(auth()->user()->can('read-allotment-report'))
                            <li class="nav-item">
                                <a href="{{route('report.allotment-report-new')}}" class="nav-link @if(in_array($page_name,['Allotment Report'])) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('commons/sidebar_menu.Allotment Report new')</p>
                                </a>
                            </li>
                            @endif
                            @if(auth()->user()->can('read-top-sheet'))
                                <li class="nav-item">
                                    <a href="{{route('report.top-sheet-new')}}" class="nav-link @if(in_array($page_name,['Top Sheet'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>@lang('commons/sidebar_menu.Top Sheet new')</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif



                @if(auth()->user()->can('edit-setting')
                    ||auth()->user()->can('read-user')
                    ||auth()->user()->can('read-role')
                    ||auth()->user()->can('read-permission')
                    ||auth()->user()->can('read-lookup')
                    ||auth()->user()->can('read-log')
                    ||auth()->user()->can('read-all-user-log')
                    )
                <li class="nav-item has-treeview  @if(in_array($page_name,['Edit Setting','User List','Registration','Lookup List','Add Lookup','Edit Lookup','Role List','Add Role','Edit Role','Permission List','Add Permission','Edit Permission','Logs'])) menu-open @endif">
                    <a href="#" class="nav-link  @if(in_array($page_name,['Edit Setting','User List','Registration','Lookup List','Add Lookup','Edit Lookup','Role List','Add Role','Edit Role','Permission List','Add Permission','Edit Permission','Logs'])) active @endif">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            @lang('commons/sidebar_menu.Settings')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(auth()->user()->can('edit-setting'))
                            <li class="nav-item">
                                <a href="{{route('settings.edit')}}" class="nav-link @if(in_array($page_name,['Edit Setting'])) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('commons/sidebar_menu.Settings') @lang('commons/sidebar_menu.Edit')</p>
                                </a>
                            </li>
                        @endif
                            @if(auth()->user()->can('read-user')
                                ||auth()->user()->can('register-user'))
                            <li class="nav-item has-treeview @if(in_array($page_name,['User List','Registration'])) menu-open @endif">
                                <a href="#" class="nav-link  @if(in_array($page_name,['User List','Registration'])) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        @lang('commons/sidebar_menu.Users')
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    @if(auth()->user()->can('read-user'))
                                        <li class="nav-item">
                                            <a href="{{route('settings.user.index')}}" class="nav-link @if(in_array($page_name,['User List'])) active @endif">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>@lang('commons/sidebar_menu.List')</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if(auth()->user()->can('register-user'))
                                        <li class="nav-item">
                                            <a href="{{route('register')}}" class="nav-link @if(in_array($page_name,['Registration'])) active @endif">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>@lang('commons/sidebar_menu.Register')</p>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                            @endif

                            @if(auth()->user()->can('read-lookup')
                                ||auth()->user()->can('create-lookup'))
                                <li class="nav-item has-treeview @if(in_array($page_name,['Lookup List','Add Lookup','Edit Lookup'])) menu-open @endif">
                                    <a href="#" class="nav-link  @if(in_array($page_name,['Lookup List','Add Lookup','Edit Lookup'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            @lang('commons/sidebar_menu.Lookups')
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if(auth()->user()->can('read-lookup'))
                                            <li class="nav-item">
                                                <a href="{{route('settings.lookup.index')}}" class="nav-link @if(in_array($page_name,['Lookup List'])) active @endif">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>@lang('commons/sidebar_menu.List')</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if(auth()->user()->can('create-lookup'))
                                            <li class="nav-item">
                                                <a href="{{route('settings.lookup.create')}}" class="nav-link @if(in_array($page_name,['Add Lookup'])) active @endif">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>@lang('commons/sidebar_menu.Add')</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif

                            @if(auth()->user()->can('read-role')
                                ||auth()->user()->can('create-role'))
                                <li class="nav-item has-treeview @if(in_array($page_name,['Role List','Add Role','Edit Role'])) menu-open @endif">
                                    <a href="#" class="nav-link  @if(in_array($page_name,['Role List','Add Role','Edit Role'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            @lang('commons/sidebar_menu.Roles')
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                <ul class="nav nav-treeview">
                                    @if(auth()->user()->can('read-role'))
                                        <li class="nav-item">
                                            <a href="{{route('settings.role.index')}}" class="nav-link @if(in_array($page_name,['Role List'])) active @endif">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>@lang('commons/sidebar_menu.List')</p>
                                            </a>
                                        </li>
                                    @endif
                                    @if(auth()->user()->can('create-role'))
                                        <li class="nav-item">
                                            <a href="{{route('settings.role.create')}}" class="nav-link @if(in_array($page_name,['Add Role'])) active @endif">
                                                <i class="far fa-dot-circle nav-icon"></i>
                                                <p>@lang('commons/sidebar_menu.Add')</p>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                                </li>
                            @endif
                            @if(auth()->user()->can('read-permission')
                                ||auth()->user()->can('create-permission'))
                                <li class="nav-item has-treeview @if(in_array($page_name,['Permission List','Add Permission','Edit Permission'])) menu-open @endif">
                                    <a href="#" class="nav-link @if(in_array($page_name,['Permission List','Add Permission','Edit Permission'])) active @endif">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            @lang('commons/sidebar_menu.Permissions')
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if(auth()->user()->can('read-permission'))
                                            <li class="nav-item">
                                                <a href="{{route('settings.permission.index')}}" class="nav-link @if(in_array($page_name,['Permission List'])) active @endif">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>@lang('commons/sidebar_menu.List')</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if(auth()->user()->can('create-permission'))
                                            <li class="nav-item">
                                                <a href="{{route('settings.permission.create')}}" class="nav-link @if(in_array($page_name,['Add Permission'])) active @endif">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>@lang('commons/sidebar_menu.Add')</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                            @if(auth()->user()->can('backup'))
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            @lang('commons/sidebar_menu.Backup')
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="{{route('settings.backup.all')}}" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>@lang('commons/sidebar_menu.All')</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{route('settings.backup.db')}}" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>@lang('commons/sidebar_menu.Only Database')</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{route('settings.backup.files')}}" class="nav-link">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>@lang('commons/sidebar_menu.Only Files')</p>
                                                </a>
                                            </li>
                                    </ul>
                                </li>
                            @endif
                        @if(auth()->user()->can('read-log')||auth()->user()->can('read-all-user-log'))
                            <li class="nav-item">
                                <a href="{{route('settings.log.index')}}" class="nav-link @if(in_array($page_name,['Logs'])) active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>@lang('commons/sidebar_menu.Logs')</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

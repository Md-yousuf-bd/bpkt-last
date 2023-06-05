<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a id="left_bar_collapse_btn" class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        @if(auth()->user()->can('edit-profile'))
            <li class="nav-item">
                <a  class="nav-link" href="{{route('profile_edit')}}" title="@lang('commons/top_nav.My Profile')"><i class="fa fa-id-card"></i></a>
            </li>
        @endif
        @if(auth()->user()->can('change-password'))
            <li class="nav-item">
                <a  class="nav-link" href="{{route('change_password')}}" title="@lang('commons/top_nav.Change Password')"><i class="fa fa-key"></i></a>
            </li>
        @endif
        @if(auth()->user()->can('read-mail'))
            <li class="nav-item">
                <a  class="nav-link" href="{{route('email.index')}}" title="@lang('commons/top_nav.Send Emails')"><i class="fa fa-envelope"></i></a>
            </li>
        @endif
        @if(auth()->user()->can('read-sms'))
            <li class="nav-item">
                <a  class="nav-link" href="{{route('sms.index')}}" title="@lang('commons/top_nav.Send SMS')"><i class="fa fa-comment"></i></a>
            </li>
        @endif

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a title="@lang('commons/top_nav.Log Out')" class="nav-link btn btn-sm btn-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out-alt"></i> @lang('commons/top_nav.Log Out')
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

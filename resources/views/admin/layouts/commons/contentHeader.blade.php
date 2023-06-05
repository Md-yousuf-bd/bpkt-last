
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                {{--                <h5 class="m-0 text-dark">@lang('commons/content_header.'.$page_name)</h5>--}}
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @foreach($breadcumb as $b)
                        @if($b[1]=='active')
                            <li class="breadcrumb-item active">@if($b[0]=='Home') <span class="fa fa-home"></span> @else @lang('commons/content_header.'.$b[0]) @endif</li>
                        @else
                            <li class="breadcrumb-item"><a href="@if(isset($b[2])){{ route($b[1],$b[2]) ?? ''}}@else {{ route($b[1]) ?? ''}} @endif">@if($b[0]=='Home') <span class="fa fa-home"></span> @else @lang('commons/content_header.'.$b[0]) @endif</a></li>
                        @endif
                    @endforeach
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

@push('styles')
<link href="{{ asset('vendor/Snrc97/css/sidebar/main.css') }}" rel="stylesheet">
@endpush

<nav class="navbar navbar-default no-margin">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header fixed-brand">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" id="menu-toggle">
<span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
</button>
         <a class="navbar-brand" href="#"><img width="50" height="50" src="{{ asset('vendor/Snrc97/assets/img/logo.png') ?? '' }}"/></i> MYSIS SOFT</a>
      </div>
      <!-- navbar-header-->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav">
            <li class="active">
               <button class="navbar-toggle collapse in" data-toggle="collapse" id="menu-toggle-2"> <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span>
               </button>
            </li>
         </ul>
      </div>
      <!-- bs-example-navbar-collapse-1 -->
   </nav>
   <div id="wrapper">
      <!-- Sidebar -->
      <div id="sidebar-wrapper">
         <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
            @foreach($sidebarItems as $sidebarItem)
            <li class="{{ ($sidebarItem['active'] ?? '') ? 'active' : '' }}">
               <a href="{{ $sidebarItem['href'] }}">
                  <span class="fa-stack fa-lg pull-left">
                     <i class="{{ $sidebarItem['icon'] ?? '' }}"></i>
                  </span>
                  {{ $sidebarItem['title'] }}
               </a>
               @if(isset($sidebarItem['children']) && count($sidebarItem['children']))
               <ul class="nav-pills nav-stacked" style="list-style-type:none;">
                  @foreach($sidebarItem['children'] as $child)
                  <li><a href="{{ $child['href'] }}">{{ $child['title'] }}</a></li>
                  @endforeach
               </ul>
               @endif
            </li>
            @endforeach
         </ul>
      </div>
      <!-- /#sidebar-wrapper -->
      <!-- Page Content -->
      <div id="page-content-wrapper">
         <div class="container-fluid xyz">
            <div class="row">
               <div class="col-lg-12">

               </div>
            </div>
         </div>
      </div>
      <!-- /#page-content-wrapper -->
   </div>
   <!-- /#wrapper -->
   <!-- jQuery -->

@push('scripts')
    <script src="{{ asset('vendor/Snrc97/js/sidebar/main.js') }}"></script>
@endpush
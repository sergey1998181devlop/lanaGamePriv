<!DOCTYPE html>
<html  lang="RU">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Custom fonts for this template -->
  
  <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{ asset('admin/css/sb-admin-2.min.css') }}?v=5" rel="stylesheet">
  <!-- <link href="{{ asset('css/css.css') }}" rel="stylesheet"> -->
  @yield('page')
  <title><?php echo (isset($title))  ?  $title : env('APP_NAME');?></title>
  <?php $page=(isset($page)) ? $page  :''; ?>
  <style>
    .pointer{
      cursor: pointer;
    }
  </style>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/')}}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">LanGame</div>
      </a>
      <!-- Divider -->
      <!-- <hr class="sidebar-divider my-0"> -->
      <li class="nav-item">
        <a class="nav-link" href="{{url('/')}}">
        <i class="fas fa-house-damage"></i>
          <!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
          <span>Сайт</span></a>
      </li>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?php if($page=="main") echo 'active'; ?>">
        <a class="nav-link" href="{{url('/panel')}}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Панель</span></a>
      </li>
  
      <li class="nav-item">
          <a class="nav-link <?=($page=="clubs" || $page=="hidded-clubs" || $page=="new-clubs" || $page=="deleted-clubs" || $page=="drafts") ? null: 'collapsed' ?>" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              <i class="fas fa-network-wired"></i>
              <span>Клубы</span>
          </a>
        
          <div id="collapseTwo" class="collapse <?=($page=="clubs" || $page=="hidded-clubs" || $page=="new-clubs" || $page=="deleted-clubs" || $page=="drafts") ? ' show': null ?> collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item<?=($page=="clubs")? ' active': null ?>" href="{{url('/panel/clubs/clubs')}}">Все клубы</a>
                  <a class="collapse-item<?=($page=="new-clubs")? ' active': null ?>" href="{{url('/panel/clubs/new-clubs')}}">Новые заявки</a>
                  <a class="collapse-item<?=($page=="hidded-clubs")? ' active': null ?>" href="{{url('/panel/clubs/hidded-clubs')}}">Снятые клубы</a>
                  <a class="collapse-item<?=($page=="deleted-clubs")? ' active': null ?>" href="{{url('/panel/clubs/deleted-clubs')}}">Удалённые</a>
                  <a class="collapse-item<?=($page=="drafts")? ' active': null ?>" href="{{url('/panel/clubs/drafts')}}">Черновики</a>
                  
              </div>
          </div>
      </li>

      
      <li class="nav-item">
          <a class="nav-link <?php if($page!="posts" && $page!="addPost") echo 'collapsed'; ?> " data-toggle="collapse" data-target="#collapsePosts" aria-expanded="false" aria-controls="collapsePosts">
          <i class="far fa-newspaper"></i>
              <span>Статьи</span>
          </a>
        
          <div id="collapsePosts" class="collapse <?=($page=="posts" || $page=="addPost") ? ' show': null ?> collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item <?php if($page=="posts") echo 'active'; ?>" href="{{url('panel/posts/all')}}">Все</a>
                  <a class="collapse-item <?php if($page=="addPost") echo 'active'; ?>" href="{{url('post/new')}}">Добавить пост</a>
              </div>
          </div>
      </li>
      <li class="nav-item">
          <a class="nav-link <?php if($page!="users") echo 'collapsed'; ?> " data-toggle="collapse" data-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
          <i class="fas fa-users"></i>
              <span>Пользователи</span>
          </a>
        
          <div id="collapseUsers" class="collapse <?=($page=="users") ? ' show': null ?> collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item <?php if($page=="users") echo 'active'; ?>" href="{{url('panel/users')}}">Все пользователи</a>
              </div>
          </div>
      </li>
      <?
        $newMessagesC = \App\contact::whereNull('seen_at')->count();
        $newReportsC = \App\report::whereNull('seen_at')->count();
        $newClubErrorsC= \App\club_report::whereNull('seen_at')->count();
        $newLangameRequestsC= \App\langame_request::whereNull('seen_at')->count();
      ?>
      <li class="nav-item">
          <a class="nav-link <?=($page=="contacts" || $page=="langame_soft" || $page=="error-reports" )? null:'collapsed' ?> " data-toggle="collapse" data-target="#collapseTwoContact" aria-expanded="false" aria-controls="collapseTwo">
          <i class="fas fa-comments"></i>
              <span>Обратная связь <span class="badge badge-pill badge-warning">{{$newMessagesC + $newReportsC + $newClubErrorsC + $newLangameRequestsC}}</span></span>
          </a>
        
          <div id="collapseTwoContact" class="collapse <?=($page=="contacts" || $page=="langame_soft" || $page=="error-reports" || $page=="club_errors"  )? ' show': null ?> collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item<?=($page=="contacts")? ' active': null ?>" href="{{url('/panel/contacts')}}">Напишите нам <span class="badge badge-pill badge-warning">{{$newMessagesC > 0 ? $newMessagesC : null}}</span></a>
                  <a class="collapse-item<?=($page=="langame_soft")? ' active': null ?>" href="{{url('/panel/langame-requests')}}">Заявки LanGame Soft. <span class="badge badge-pill badge-warning">{{$newLangameRequestsC > 0 ? $newLangameRequestsC : null}}</span></a>
                  <a class="collapse-item<?=($page=="error-reports")? ' active': null ?>" href="{{url('/panel/error-reports')}}">Сообщения об ошибках <span class="badge badge-pill badge-warning">{{$newReportsC > 0 ? $newReportsC : null}}</span></a>
                  <a class="collapse-item<?=($page=="club_errors")? ' active': null ?>" href="{{url('/panel/club-error-reports')}}">Комментария к клубам <span class="badge badge-pill badge-warning">{{$newClubErrorsC > 0 ? $newClubErrorsC : null}}</span></a>
              </div>
          </div>
      </li>
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                 
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                           
                    </ul>
                </div>
      </nav>
      @include('admin.layouts.messages')
      @yield('content')
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>LanGame 2021</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>


  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>
  <script src="{{asset('js/inputmask.js')}}"></script>
  <script src="{{asset('admin/js/js.js')}}"></script>

@yield('scripts')

</body>
</html>

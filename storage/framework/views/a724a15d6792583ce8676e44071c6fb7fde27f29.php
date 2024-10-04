<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Admin</title>
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--DataTables [ OPTIONAL ]-->
    


    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/main.css')); ?>">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="<?php echo e(route('homepage')); ?>">Accounts</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!--Notification Menu-->
        
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="<?php echo e(url('admin/profile')); ?>"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i><?php echo e(__('Logout')); ?></a>
             <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
            </form>
            </li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?php if(Auth::User()->photo): ?><?php echo e(asset('images')); ?>/<?php echo e(Auth::User()->photo); ?><?php else: ?><?php echo e(asset('1.png')); ?><?php endif; ?>"  height="50px" width="50px" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?php echo e(Auth::User()->name); ?></p>
          
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item" href="<?php echo e(url('admin/dashboard')); ?>" id="dashboard"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

        


        <?php if(Auth::user()->is_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions))): ?>
        <li><a class="app-menu__item" href="<?php echo e(url('admin/register')); ?>" id="admin"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Admin</span></a></li>
        <li><a class="app-menu__item" href="<?php echo e(route('admin.account')); ?>" id="account"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Account</span></a></li>
        <?php endif; ?>

        

        <?php if(Auth::user()->is_type == 'admin' || in_array('3', json_decode(Auth::user()->staff->role->permissions))): ?>
        
        <?php endif; ?>

        <?php if(Auth::user()->is_type == 'admin' || in_array('3', json_decode(Auth::user()->staff->role->permissions))): ?>
        
        <?php endif; ?>
        
        

        <?php if(Auth::user()->is_type == 'admin' || in_array('3', json_decode(Auth::user()->staff->role->permissions))): ?>
        <li><a class="app-menu__item" href="<?php echo e(route('admin.supplier')); ?>" id="supplier"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Supplier</span></a></li>
        <?php endif; ?>

        <?php if(Auth::user()->is_type == 'admin' || in_array('3', json_decode(Auth::user()->staff->role->permissions))): ?>
        <li><a class="app-menu__item" href="<?php echo e(route('admin.sale')); ?>" id="sale"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Sales</span></a></li>
        <?php endif; ?>

        <?php if(Auth::user()->is_type == 'admin' || in_array('3', json_decode(Auth::user()->staff->role->permissions))): ?>
        <li><a class="app-menu__item" href="<?php echo e(route('admin.transaction')); ?>" id="transaction"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Transaction</span></a></li>
        <?php endif; ?>
        

        <li class="treeview" id="allreport"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Report</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?php echo e(route('admin.salesreport')); ?>" id="salesreport"><i class="icon fa fa-circle-o"></i>Sales</a></li>
            <li><a class="treeview-item" href="<?php echo e(route('admin.transactionreport')); ?>" id="tranreport"><i class="icon fa fa-circle-o"></i> Transaction</a></li>
          </ul>
        </li>

        
        <?php if(Auth::user()->is_type == 'admin' || in_array('3', json_decode(Auth::user()->staff->role->permissions))): ?>
        
        <?php endif; ?>
        
        
        
      </ul>
    </aside>
    <?php echo $__env->yieldContent('content'); ?>
     <!-- Essential javascripts for application to work-->
     <script src="<?php echo e(asset('js/jquery-3.3.1.min.js')); ?>"></script>
     <script src="<?php echo e(asset('js/popper.min.js')); ?>"></script>
     <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
     <script src="<?php echo e(asset('js/main.js')); ?>"></script>
     <!-- The javascript plugin to display page loading on top-->
     <script src="<?php echo e(asset('js/plugins/pace.min.js')); ?>"></script>
     <!-- Page specific javascripts-->
     <script type="text/javascript" src="<?php echo e(asset('js/plugins/chart.js')); ?>"></script>
     <script>
      // page schroll top
      function pagetop() {
          window.scrollTo({
              top: 130,
              behavior: 'smooth',
          });
      }


      function success(msg){
             $.notify({
                     // title: "Update Complete : ",
                     message: msg,
                     // icon: 'fa fa-check'
                 },{
                     type: "info"
                 });

         }
     function dlt(){
       swal({
         title: "Are you sure?",
         text: "You will not be able to recover this imaginary file!",
         type: "warning",
         showCancelButton: true,
         confirmButtonText: "Yes, delete it!",
         cancelButtonText: "No, cancel plx!",
         closeOnConfirm: false,
         closeOnCancel: false
     }, function(isConfirm) {
         if (isConfirm) {
             swal("Deleted!", "Your imaginary file has been deleted.", "success");
         } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");

         }
 });


     }

  </script>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script> 



<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap4.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script> 
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script> 




<script type="text/javascript" src="<?php echo e(asset('js/plugins/bootstrap-notify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('js/plugins/sweetalert.min.js')); ?>"></script>
     <?php echo $__env->yieldContent('script'); ?>
    </body>
    </html>
<?php /**PATH D:\xampp\htdocs\work\golden_point\resources\views/admin/layouts/admin.blade.php ENDPATH**/ ?>
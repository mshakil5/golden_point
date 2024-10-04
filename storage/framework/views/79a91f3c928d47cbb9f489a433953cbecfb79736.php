
<?php $__env->startSection('content'); ?>
<style>
    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
    }
    th, td {
        text-align: left;
        padding: 8px;
    }
    tr:nth-child(even){background-color: #f2f2f2}
</style>
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class="fa fa-dashboard"></i> Supplier</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            </ul>
        </div>
        <div id="addThisTransactionForm">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>New Transaction</h3>
                        </div>
                        <div class="ermsg"></div>
                        <div class="card-body">
                            <div class="row">
                                <div class="container">
                                    <?php echo Form::open(['url' => 'admin/master/create','id'=>'createThisTranForm']); ?>

                                    <?php echo csrf_field(); ?>
                                    <div>
                                        <label for="date">Date</label>
                                        <input type="date" id="date" name="date" value="<?php echo e(date('Y-m-d')); ?>" class="form-control">
                                        <input type="hidden" id="supplierid" name="supplierid" class="form-control">
                                    </div>
                                    <div>
                                        <label for="type">Transaction Type</label>
                                        <select class="form-control" id="type" name="type">
                                            <option value="">Select</option>
                                            <option value="1">Deposit</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="account_id">Accounts Name</label>

                                        
                                        <select id="account_id" name="account_id" class="form-control">
                                            <option value="">Select</option>
                                            <?php $__currentLoopData = \App\Models\Account::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($account->id); ?>"><?php echo e($account->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                    </div>
                                    <div>
                                        <label for="description">Description</label>
                                        <input type="text" id="description" name="description" class="form-control">
                                    </div>
                                    <div>
                                        <label for="amount">Amount</label>
                                        <input type="number" id="amount" name="amount" class="form-control">
                                    </div>
                                    <hr>
                                    <input type="button" id="addtranBtn" value="Create" class="btn btn-primary">
                                    <input type="button" id="tranFormCloseBtn" value="Close" class="btn btn-warning">
                                    <?php echo Form::close(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                </div>
            </div>
        </div>
        <div id="addThisFormContainer">
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>New Supplier</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="ermsg">
                                </div>
                                <div class="container">
                                    <?php echo Form::open(['url' => 'admin/master/create','id'=>'createThisForm']); ?>

                                    <?php echo Form::hidden('codeid','', ['id' => 'codeid']); ?>

                                    <?php echo csrf_field(); ?>
                                    <div>
                                        <label for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control">
                                    </div>
                                    <div class="d-none">
                                        <label for="image">Image</label>
                                        <input class="form-control" id="image" name="image" type="file">
                                    </div>
                                    <div>
                                        <label for="phone">Phone</label>
                                        <input type="text" id="phone" name="phone" class="form-control">
                                    </div>
                                    <div>
                                        <label for="address">Address</label>
                                        <input type="text" id="address" name="address" class="form-control">
                                    </div>
                                    
                                    <div>
                                        <label for="balance">Balance</label>
                                        <input type="number" id="balance" name="balance" class="form-control" value="0">
                                    </div>
                                    <hr>
                                    <input type="button" id="addBtn" value="Create" class="btn btn-primary">
                                    <input type="button" id="FormCloseBtn" value="Close" class="btn btn-warning">
                                    <?php echo Form::close(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                </div>
            </div>
        </div>
        <button id="newBtn" type="button" class="btn btn-info">Add New</button>
        <hr>
        <div id="contentContainer">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3> All Supplier</h3>
                        </div>
                        <div class="card-body">
                            
                            <div class="container"  style="overflow-x:auto;">
                                <table class="table table-bordered table-hover" id="example">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center">ID</th>
                                        <th style="text-align: center">Name</th>
                                        <th style="text-align: center">Phone</th>
                                        <th style="text-align: center">Address</th>
                                        <th style="text-align: center">Balance</th>
                                        <th style="text-align: center">Sales Report</th>
                                        <th style="text-align: center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td style="text-align: center"><?php echo e($key + 1); ?></td>
                                            <td style="text-align: center"><?php echo e($data->name); ?></td>
                                            <td style="text-align: center"><?php echo e($data->phone); ?></td>
                                            <td style="text-align: center"><?php echo e($data->address); ?></td>
                                            <td style="text-align: center"><?php echo e($data->balance); ?></td>
                                            <td style="text-align: center"> 
                                            
                                            </td>
                                            
                                            <td style="text-align: center">
                                                <a href="<?php echo e(route('supplier.tran',$data->id)); ?>"><i class="fa fa-eye" style="color: #191987;font-size:16px;"></i></a>
                                            <a id="DepBtn" rid="<?php echo e($data->id); ?>" uid="<?php echo e($data->id); ?>"><i class="fa fa-plus" style="color: #59cf78;font-size:16px;"></i></a>
                                            <a id="EditBtn" rid="<?php echo e($data->id); ?>"><i class="fa fa-edit" style="color: #2196f3;font-size:16px;"></i></a>
                                            
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            $("#addThisFormContainer").hide();
            $("#addThisTransactionForm").hide();
            $("#newBtn").click(function(){
                clearform();
                $("#newBtn").hide(100);
                $("#addThisFormContainer").show(300);

            });
            

            $("#FormCloseBtn").click(function(){
                $("#addThisFormContainer").hide(200);
                $("#newBtn").show(100);
                clearform();
            });
            $("#tranFormCloseBtn").click(function(){
                $("#addThisTransactionForm").hide(200);
                $("#newBtn").show(100);
                clearform();
            });
            //header for csrf-token is must in laravel
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            //
            var url = "<?php echo e(URL::to('/admin/supplier')); ?>";
            // console.log(url);
            $("#addBtn").click(function(){
            //   alert("#addBtn");
                if($(this).val() == 'Create') {
                    var file_data = $('#image').prop('files')[0];
                    if(typeof file_data === 'undefined'){
                        file_data = 'null';
                    }
                    var form_data = new FormData();
                    form_data.append('image', file_data);
                    form_data.append("name", $("#name").val());
                    form_data.append("phone", $("#phone").val());
                    form_data.append("address", $("#address").val());
                    form_data.append("balance", $("#balance").val());
                    $.ajax({
                      url: url,
                      method: "POST",
                      contentType: false,
                      processData: false,
                      data:form_data,
                      success: function (d) {
                          if (d.status == 303) {
                              $(".ermsg").html(d.message);
                          }else if(d.status == 300){
                            success("Data Insert Successfully!!");
                                window.setTimeout(function(){location.reload()},2000)
                          }
                      },
                      error: function (d) {
                          console.log(d);
                      }
                  });
                }
                //create  end
                //Update
                if($(this).val() == 'Update'){
                    var file_data = $('#image').prop('files')[0];
                    if(typeof file_data === 'undefined'){
                        file_data = 'null';
                    }
                    var form_data = new FormData();
                    form_data.append('image', file_data);
                    form_data.append("name", $("#name").val());
                    form_data.append("phone", $("#phone").val());
                    form_data.append("address", $("#address").val());
                    form_data.append("balance", $("#balance").val());
                    form_data.append('_method', 'put');
                    $.ajax({
                        url:url+'/'+$("#codeid").val(),
                        type: "POST",
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        data:form_data,
                        success: function(d){
                            console.log(d);
                            if (d.status == 303) {
                                $(".ermsg").html(d.message);
                                pagetop();
                            }else if(d.status == 300){
                                success("Data Update Successfully!!");
                                window.setTimeout(function(){location.reload()},2000)
                            }
                        },
                        error:function(d){
                            console.log(d);
                        }
                    });
                }
                //Update
            });
            //Edit
            $("#contentContainer").on('click','#EditBtn', function(){
                //alert("btn work");
                codeid = $(this).attr('rid');
                //console.log($codeid);
                info_url = url + '/'+codeid+'/edit';
                //console.log($info_url);
                $.get(info_url,{},function(d){
                    populateForm(d);
                    pagetop();
                });
            });
            //Edit  end
            //Delete 
            $("#contentContainer").on('click','#deleteBtn', function(){
                var dataid = $(this).attr('rid');
                var info_url = url + '/'+dataid;
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
                        $.ajax({
                            url:info_url,
                            method: "GET",
                            type: "DELETE",
                            data:{
                            },
                            success: function(d){
                                if(d.success) {
                                    swal("Deleted!", "Your imaginary file has been deleted.", "success");     
                                    location.reload();
                                }
                            },
                            error:function(d){
                                console.log(d);
                            }
                        });
                    } else {
                        swal("Cancelled", "Your imaginary file is safe :)", "error");
                    }
                });
            });
            //Delete  
            function populateForm(data){
                $("#name").val(data.name);
                $("#phone").val(data.phone);
                $("#address").val(data.address);
                $("#balance").val(data.balance);
                $("#codeid").val(data.id);
                $("#addBtn").val('Update');
                $("#addThisFormContainer").show(300);
                $("#newBtn").hide(100);
            }
            function clearform(){
                $('#createThisForm')[0].reset();
                $('#createThisTranForm')[0].reset();
                $("#addBtn").val('Create');
            }

            // Add 
            $("#contentContainer").on('click','#DepBtn', function(){
                
                uid = $(this).attr('uid');
                
                $("#supplierid").val(uid);
                $("#addThisTransactionForm").show(300);
                $("#newBtn").hide(300);
                    pagetop();
            });
            // Add end

            var depositurl = "<?php echo e(URL::to('/admin/supplier-deposit')); ?>";
            // console.log(url);
            $("#addtranBtn").click(function(){
            //   alert("#addBtn");
                    var form_data = new FormData();
                    form_data.append("supplierid", $("#supplierid").val());
                    form_data.append("date", $("#date").val());
                    form_data.append("description", $("#description").val());
                    form_data.append("type", $("#type").val());
                    form_data.append("account_id", $("#account_id").val());
                    form_data.append("amount", $("#amount").val());
                    $.ajax({
                      url: depositurl,
                      method: "POST",
                      contentType: false,
                      processData: false,
                      data:form_data,
                      success: function (d) {
                          if (d.status == 303) {
                              $(".ermsg").html(d.message);
                          }else if(d.status == 300){
                            success("Transaction Create Successfully!!");
                                window.setTimeout(function(){location.reload()},2000)
                          }
                      },
                      error: function (d) {
                          console.log(d);
                      }
                  });
                //create  end
            });

        });

        $(document).ready(function () {
            $('#example').DataTable();
        });

        

        

    </script>

    <script>
        function copyToClipboard(id) {
            document.getElementById(id).select();
            document.execCommand('copy');
            swal("Copied!");
        }
    </script>

    
    <script type="text/javascript">
        $(document).ready(function() {
            $("#supplier").addClass('active');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\work\golden_point\resources\views/admin/supplier/index.blade.php ENDPATH**/ ?>
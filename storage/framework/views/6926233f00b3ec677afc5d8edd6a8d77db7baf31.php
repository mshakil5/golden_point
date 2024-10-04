

<?php $__env->startSection('content'); ?>
<main class="app-content">
    <div class="app-title">
      <div>
        <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
      </div>
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      </ul>
    </div>
    <div class="row">

      <div class="col-md-6 col-lg-3">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-money fa-3x"></i>
          <div class="info">
            <h4>Total Balance</h4>
            <p><b><?php echo e(\App\Models\Account::sum('amount')); ?></b></p>
          </div>
        </div>
      </div>

      <?php $__currentLoopData = \App\Models\Account::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon"><i class="icon fa fa-money fa-3x"></i>
          <div class="info">
            <h4><?php echo e($acc->name); ?> Amount</h4>
            <p><b><?php echo e($acc->amount); ?></b></p>
          </div>
        </div>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="tile">
          <h3 class="tile-title">Daily Sales</h3>
          
          <div class="container"  style="overflow-x:auto;">
            <table class="table table-bordered table-hover" id="example">
                <thead>
                <tr>
                    <th style="text-align: center">Sl</th>
                    <th style="text-align: center">Date</th>
                    <th style="text-align: center">Invoice No</th>
                    <th style="text-align: center">Customer</th>
                    <th style="text-align: center">Product</th>
                    <th style="text-align: center">Company</th>
                    <th style="text-align: center">Quantity</th>
                    <th style="text-align: center">PPU</th>
                    <th style="text-align: center">Amount</th>
                    <th style="text-align: center">Due</th>
                </tr>
                </thead>
                <tbody>
                        <?php $__currentLoopData = \App\Models\Sale::where('date', date('Y-m-d'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="text-align: center"><?php echo e($key + 1); ?></td>
                        <td style="text-align: center"><?php echo e($data->date); ?></td>
                        <td style="text-align: center"><?php echo e($data->invoiceno); ?></td>
                        <td style="text-align: center"><?php echo e(\App\Models\Customer::where('id',$data->customer_id)->first()->name); ?>  (<?php echo e(\App\Models\Customer::where('id',$data->customer_id)->first()->balance); ?>)</td>
                        <td style="text-align: center">
                            <?php if($data->product_id == 1): ?>
                             Octen 
                            <?php elseif($data->product_id == 2): ?>
                             Diesel 
                            <?php elseif($data->product_id == 3): ?> 
                            Petrol 
                            <?php elseif($data->product_id == 4): ?> 
                            Kerosene
                            <?php elseif($data->product_id == 5): ?> 
                            Mobil
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center">
                            <?php if($data->company == 1): ?> Padma <?php elseif($data->company == 2): ?> Meghna <?php elseif($data->company == 3): ?> Jomuna <?php endif; ?>
                        </td>
                        <td style="text-align: center"><?php echo e($data->quantity); ?></td>
                        <td style="text-align: center"><?php echo e($data->price_per_unit); ?></td>
                        <td style="text-align: center"><?php echo e($data->amount); ?></td>
                        <td style="text-align: center"><?php echo e($data->due); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
            </table>
        </div>
        
        </div>
      </div>
      <div class="col-md-6">
        <div class="tile">
          <h3 class="tile-title">Monthly Sales</h3>

          <div class="container"  style="overflow-x:auto;">
            <table class="table table-bordered table-hover" id="example">
                <thead>
                <tr>
                    <th style="text-align: center">Sl</th>
                    <th style="text-align: center">Date</th>
                    <th style="text-align: center">Invoice No</th>
                    <th style="text-align: center">Customer</th>
                    <th style="text-align: center">Product</th>
                    <th style="text-align: center">Company</th>
                    <th style="text-align: center">Quantity</th>
                    <th style="text-align: center">PPU</th>
                    <th style="text-align: center">Amount</th>
                    <th style="text-align: center">Due</th>
                </tr>
                </thead>
                <tbody>
                        <?php $__currentLoopData = \App\Models\Sale::whereMonth('date', Carbon::now()->month)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="text-align: center"><?php echo e($key + 1); ?></td>
                        <td style="text-align: center"><?php echo e($data->date); ?></td>
                        <td style="text-align: center"><?php echo e($data->invoiceno); ?></td>
                        <td style="text-align: center"><?php echo e(\App\Models\Customer::where('id',$data->customer_id)->first()->name); ?>  (<?php echo e(\App\Models\Customer::where('id',$data->customer_id)->first()->balance); ?>)</td>
                        <td style="text-align: center">
                            <?php if($data->product_id == 1): ?>
                             Octen 
                            <?php elseif($data->product_id == 2): ?>
                             Diesel 
                            <?php elseif($data->product_id == 3): ?> 
                            Petrol 
                            <?php elseif($data->product_id == 4): ?> 
                            Kerosene
                            <?php elseif($data->product_id == 5): ?> 
                            Mobil
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center">
                            <?php if($data->company == 1): ?> Padma <?php elseif($data->company == 2): ?> Meghna <?php elseif($data->company == 3): ?> Jomuna <?php endif; ?>
                        </td>
                        <td style="text-align: center"><?php echo e($data->quantity); ?></td>
                        <td style="text-align: center"><?php echo e($data->price_per_unit); ?></td>
                        <td style="text-align: center"><?php echo e($data->amount); ?></td>
                        <td style="text-align: center"><?php echo e($data->due); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
            </table>
        </div>
          
        </div>
      </div>

      <div class="col-md-6">
        <div class="tile">
          <h3 class="tile-title">Daily Transaction</h3>
          <div class="container"  style="overflow-x:auto;">
            <table class="table table-bordered table-hover" id="example">
                <thead>
                <tr>
                    <th style="text-align: center">ID</th>
                    <th style="text-align: center">Date</th>
                    <th style="text-align: center">Description</th>
                    <th style="text-align: center">Transaction Type</th>
                    <th style="text-align: center">Transfer From</th>
                    <th style="text-align: center">Account Name</th>
                    <th style="text-align: center">Amount</th>
                </tr>
                </thead>
                <tbody>
                        <?php $__currentLoopData = \App\Models\Transaction::where('date', date('Y-m-d'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="text-align: center"><?php echo e($key + 1); ?></td>
                        <td style="text-align: center"><?php echo e($data->date); ?></td>
                        <td style="text-align: center"><?php echo e($data->description); ?></td>
                        <td style="text-align: center">
                            <?php if($data->type == 1): ?>
                                Deposit
                            <?php elseif($data->type == 2): ?>
                                Pay Order
                            <?php elseif($data->type == 3): ?>
                                Expense
                            <?php elseif($data->type == 4): ?>
                                Transfer
                            <?php else: ?>
                                <?php echo e($data->type); ?>-
                                <?php if(isset(\App\Models\Sale::where('id',$data->sale_id)->first()->invoiceno)): ?><?php echo e(\App\Models\Sale::where('id',$data->sale_id)->first()->invoiceno); ?>

                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center">
                            <?php if(isset($data->transfer_from)): ?><?php echo e(\App\Models\Account::where('id',$data->transfer_from)->first()->name); ?>

                            <?php endif; ?>
                        </td>
                        <td style="text-align: center">
                            <?php echo e($data->account->name); ?>

                        </td>
                        <td style="text-align: center"><?php echo e($data->amount); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
            </table>
        </div>
          
        
        </div>
      </div>

      <div class="col-md-6">
        <div class="tile">
          <h3 class="tile-title">Monthly Transaction</h3>
          <div class="container"  style="overflow-x:auto;">
            <table class="table table-bordered table-hover" id="example">
                <thead>
                <tr>
                    <th style="text-align: center">ID</th>
                    <th style="text-align: center">Date</th>
                    <th style="text-align: center">Description</th>
                    <th style="text-align: center">Transaction Type</th>
                    <th style="text-align: center">Transfer From</th>
                    <th style="text-align: center">Account Name</th>
                    <th style="text-align: center">Amount</th>
                </tr>
                </thead>
                <tbody>
                        <?php $__currentLoopData = \App\Models\Transaction::whereMonth('date', Carbon::now()->month)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="text-align: center"><?php echo e($key + 1); ?></td>
                        <td style="text-align: center"><?php echo e($data->date); ?></td>
                        <td style="text-align: center"><?php echo e($data->description); ?></td>
                        <td style="text-align: center">
                            <?php if($data->type == 1): ?>
                                Deposit
                            <?php elseif($data->type == 2): ?>
                                Pay Order
                            <?php elseif($data->type == 3): ?>
                                Expense
                            <?php elseif($data->type == 4): ?>
                                Transfer
                            <?php else: ?>
                                <?php echo e($data->type); ?>-
                                <?php if(isset(\App\Models\Sale::where('id',$data->sale_id)->first()->invoiceno)): ?><?php echo e(\App\Models\Sale::where('id',$data->sale_id)->first()->invoiceno); ?>

                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center">
                            <?php if(isset($data->transfer_from)): ?><?php echo e(\App\Models\Account::where('id',$data->transfer_from)->first()->name); ?>

                            <?php endif; ?>
                        </td>
                        <td style="text-align: center">
                            <?php echo e($data->account->name); ?>

                        </td>
                        <td style="text-align: center"><?php echo e($data->amount); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
            </table>
        </div>
          
        
        </div>
      </div>


    </div>
  </main>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="text/javascript">
  $(document).ready(function() {
      $("#dashboard").addClass('active');
  });
</script>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\work\golden_point\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>
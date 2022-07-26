
     <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
      <h1 class="display-4 fw-normal">Subscription</h1>
    </div>

    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
    <div class="col-2"></div>
    <?php foreach($plans as $plan){ ?>
        <div class="col">
          <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
              <h4 class="my-0 fw-normal"><?= $plan['name']?></h4>
            </div>
            <div class="card-body">
              <h1 class="card-title pricing-card-title">$<?= $plan['actual_price']?><small class="text-muted fw-light">/mo</small></h1>
              <?= $plan['description']?>
            </div>
            <div class="card-footer">
               <a type="button" class="w-100 btn btn-lg btn-outline-primary" href="<?= base_url();?>dashboard/checkout?planid=<?= $plan['id']?>&price=<?= $plan['default_price']?>&amount=<?= $plan['actual_price']?>">Pay Now</a> 
            </div>
          </div>
        </div>
    <?php } ?>
<div class="col-2"></div>
    </div>

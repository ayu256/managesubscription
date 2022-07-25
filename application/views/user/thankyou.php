<section class="showcase">
   <div class="container">
    <div class="text-center">
      <h1 class="display-3">Thank You!</h1>
      <?php if(!empty($amount)) { ?>
        <h3>Successfully charged $<?php print $amount;?>!</h3>
      <?php } ?>
     
      
      <p class="lead">
        <a class="btn btn-primary btn-sm" href="<?= base_url();?>dashboard" role="button">Continue to homepage</a>
      </p>
    </div>
    </div>
</section>

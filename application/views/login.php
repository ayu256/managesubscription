
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Manage Subscription</title>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url(); ?>assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/dist/css/style.css" rel="stylesheet">


  </head>
  <body>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Login Form -->
    <form action="<?php echo base_url();?>Auth/login" method="post">
      <input type="text" id="login" class="fadeIn second" name="email" placeholder="Email">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
     
      <div class="row ">
          <div class="col-12">
             <?php if ($error = $this->session->flashdata('msg')){
                                ?>
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="alert alert-dismissible alert-danger">
                                      <?= $error; ?>
                                  </div>  
                                  </div>
                                </div>
              <?php } ?>
          </div>
        </div>

      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

  </div>
</div>
</body>
</html>
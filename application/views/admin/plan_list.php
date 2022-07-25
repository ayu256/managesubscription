
<div class="col-md-12 text-center"><h3>Plan List</h3></div>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>SN</th>
                <th>Plan Name</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=0; foreach($plans as $plan){  $i++;?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $plan['name'];?></td>
                <td><?= $plan['actual_price'].$plan['currency'];?></td>
                <td><?= ($plan['active'] == "1") ?  "Active" : "Inactive"?></td>
            </tr>
            <?php } ?>
        </tbody>
</table>
            
<script>
    $(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false
    } );
 
} );
</script>
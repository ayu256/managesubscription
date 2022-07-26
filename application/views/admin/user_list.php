
<div class="col-md-12 text-center"><h3>Plan List</h3></div>
<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>SN</th>
                <th>User Name</th>
                <th>Plan Name</th>
                <th>Plan Start Date </th>
                <th>Plan End Date</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=0; foreach($list as $listitem){  $i++;?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $listitem['first_name'].' '.$listitem['last_name'];?></td>
                <td><?= $listitem['plan_name']?></td>
                <td><?= $listitem['plan_period_start']?></td>
                <td><?= $listitem['plan_period_end']?></td>
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
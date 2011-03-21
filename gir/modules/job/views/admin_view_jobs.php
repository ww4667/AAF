<? 

$items = $j->adminViewJobs();

    // 
    // protected $_OBJECT_PROPERTIES = array(    array("type"=>"text","label"=>"Job Title","field"=>"job_title"),
    //                                           array("type"=>"text","label"=>"Company","field"=>"company"),
    //                                           array("type"=>"text","label"=>"Description","field"=>"description"),
    //                                           array("type"=>"date","label"=>"Post Job Until","field"=>"post_job_until"),
    //                                           array("type"=>"text","label"=>"Your Name","field"=>"name"),
    //                                           array("type"=>"text","label"=>"Your Email","field"=>"email"),
    //                                           array("type"=>"text","label"=>"Your Phone Number","field"=>"phone_number"),
    //                                           array("type"=>"number","label"=>"approved","field"=>"approved")

?>
<div id="jobApplications">
<table id="data_table_1">
<thead>
<td>Job Title</td>
<td>Company</td>
<td></td>
<td>Action</td>
</thead>
<tbody>
<?

foreach($items as $j){ ?>
    <tr>
    <td><?= $j->job_title ?> </td>        
    <td><?= $j->company ?></td>
    <td>
        <a href="/gir/index.php?controller=job&method=admin-view-job-details&job=<?= $j->id ?>">view details</a>
    </td>
    <td>
        <a href="/gir/index.php?controller=job&method=approve-job&job_id=<?= $j->id ?>">approve</a> / <a href="/gir/index.php?controller=job&method=approve-job&job=true&job_id=<?= $j->id ?>">deny</a>
    </td>
    </tr>
<? } ?>
</tbody>
</table>
</div>

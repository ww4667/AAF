<? 

$items = $m->viewApplications();

?>
<div id="memberApplications">
<table id="data_table_1">
<thead>
<td>Name</td>
<td>Email Address</td>
<td>Action</td>


</thead>
<tbody>

<?

foreach($items as $m){ ?>
    <tr>
    <td><?= $m->first_name ?> <?= $m->last_name ?> </td>        
    <td><?= $m->email ?></td>
    <td>
        <a href="/gir/index.php?controller=member_application&method=approve-app&app_id=<?= $m->id ?>">approve</a> / <a href="/gir/index.php?controller=member_application&method=approve-app&deny_app=true&app_id=<?= $m->id ?>">deny</a>
    </td>
    </tr>
<? } ?>
</tbody>
</table>
</div>

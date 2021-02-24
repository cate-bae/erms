
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header p-t-10 p-b-10">
                <div class="row">
                    <div class="col-xs-12">
                        <a href="./create" class="btn btn-success waves-effect pull-right">
                            <i class="material-icons">add</i>
                            <span>ADD ACCOUNT</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ( ! empty($list)) { ?>
                            <?php foreach ($list as $value) { ?>

                            <tr id="account-<?=$value->id?>">
                                <td><?=$value->id?></td>
                                <td><?=$value->first_name . ' ' . $value->last_name?></td>
                                <td><?=$value->username?></td>
                                <td><?=$types[$value->type]?></td>
                                <td>
                                    <a href="<?=base_url()?>account/view/<?=$value->id?>"
                                        type="button" 
                                        class="btn btn-info btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="View profile">
                                        <i class="material-icons">account_circle</i>
                                    </a>
                                    <a href="<?=base_url()?>account/edit/<?=$value->id?>" 
                                        type="button" 
                                        class="btn btn-warning btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Edit">
                                        <i class="material-icons">edit</i>
                                    </a>
                                    <button 
                                        onclick="deleteAccount(<?=$value->id?>)"
                                        type="button" 
                                        class="btn btn-danger btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Delete">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
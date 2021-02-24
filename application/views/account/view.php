
<div class="row clearfix">
    <div class="col-md-4 col-xs-12">
        <div class="card">
            <div class="body text-center">
                <img src="<?=$user->avatar?>" 
                    class="thumb-lg img-circle profile-picture profile-picture-view" 
                    alt="img" style="width: 128px; height: 128px">

                <h4><?=$user->first_name . ' ' . $user->last_name?></h4>
                <h5><?=$user->email?></h5>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-xs-12">
        <div class="card">
            <?php if ($user->type != -1 && in_array(get_user_type(), [-1, 0])) {?>
            <div class="header p-t-10 p-b-10">
                <div class="row">
                    <div class="col-xs-12">   
                        <a href="<?=base_url()?>Account/edit/<?=$user->id?>" class="btn btn-warning text-uppercase waves-effect pull-right">
                        <i class="material-icons">edit</i>
                            <span>Edit</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="body">
                <form class="form-horizontal">
                    <div class="row">
                        <div class="col-md-6 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">First Name</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <p><?=$user->first_name?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">Last Name</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <p><?=$user->last_name?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($user->type == 1) { // seller?>
                    <div class="form-group">
                        <label class="col-md-12">Shop Name</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <p><?=$user->shop_name?></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if ($user->type == 1 || $user->type == 2) { // seller/customer?>
                    <div class="form-group">
                        <label class="col-md-12"><?=$user->type == 1 ? 'Caterer Address' : 'Address'?></label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <p><?=$user->address?></p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <label class="col-md-12">Contact Number</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <p><?=$user->contact_number?></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Email</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <p><?=$user->email?></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Username</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <p><?=$user->username?></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
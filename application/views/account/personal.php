
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

        <?php if (get_user_type() == -1) { ?>

        <!-- <div class="card">
            <div class="body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-12">Bank Account</label>
                    </div>
                    <div class="form-group form-float m-b-15 m-l-0">
                        <div class="form-line">
                            <input name="bank_account" type="text" value="<?=$bank_account->account?>" class="form-control" required autocomplete="off">
                            <label class="form-label">Account number</label>
                        </div>
                    </div>
                    <div class="form-group form-float m-b-15 m-l-0">
                        <div class="form-line">
                            <input name="bank_name" type="text" value="<?=$bank_account->bank?>" class="form-control" required autocomplete="off">
                            <label class="form-label">Bank name</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success text-uppercase pull-right" onclick="saveAccount()">
                            <i class="material-icons">save</i>
                            <span>SAVE</span>
                        </button>
                    </div>
                </div>
            </div>
        </div> -->
        <?php } ?>

    </div>
		
    <div class="col-md-8 col-xs-12">
        <div class="card">
            <div id="btn-update" class="header p-t-10 p-b-10">
                <div class="row">
                    <div class="col-xs-12">
                        <button id="update_profile" class="btn btn-primary text-uppercase waves-effect pull-right">
                            <i class="material-icons">edit</i>
                            <span>Update</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="header p-t-10 p-b-10 hide-view hide">
                <div class="row">
                    <div class="col-xs-12">
                        <button id="btn-cancel" class="btn btn-default text-uppercase waves-effect pull-right">
                            <i class="material-icons">close</i>
                            <span>Cancel</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="body">
                <form class="form-horizontal">
                    <input name="id" type="hidden" class="hide" value="<?=$user->id?>">
                    <div class="row">
                        <div class="col-md-6 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">First Name</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input disabled name="first_name" type="text" value="<?=$user->first_name?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">Last Name</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input disabled name="last_name" type="text" value="<?=$user->last_name?>" class="form-control">
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
                                <input disabled name="shop_name" type="text" value="<?=$user->shop_name?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if ($user->type == 1 || $user->type == 2) { // seller/customer?>
                    <div class="form-group">
                        <label class="col-md-12"><?=$user->type == 1 ? 'Caterer Address' : 'Address'?></label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input disabled name="address" type="text" value="<?=$user->address?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="form-group hide-view hide">
                        <label class="col-md-12">Profile Picture</label>
                        <div class="col-md-12">
                            <div class="form-line" id="input-file-upload">
                                <input type="file" name="file" class="form-control" accept="image/*" onchange="showImage(this)">
                                <div class="preloader pl-size-xs hide" style="position: absolute;top: 0;right: 0;">
                                    <div class="spinner-layer pl-red-grey">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span class="col-red">*Leave this empty if you do not want to change your profile picture.</span>
                        </div>
                        <div class="col-md-12 picture-preview hide">
                            <div id="profile-picture" class="list-unstyled row clearfix"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Contact Number</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input disabled name="contact_number" type="text" value="<?=$user->contact_number?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Email</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input disabled name="email" type="email" value="<?=$user->email?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Username</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input disabled name="username" type="text" value="<?=$user->username?>" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group hide-view hide">
                        <label class="col-md-12">
                            <span class="col-red">*Leave the following fields empty if you do not want to change your password.</span>
                        </label>
                    </div>
                    <div class="form-group hide-view hide">
                        <label class="col-md-12">New Password</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="password" type="password" value="" class="form-control"> 
                            </div>
                        </div>
                    </div>
                    <div class="form-group hide-view hide">
                        <label class="col-md-12">Retype password</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="confirm" type="password" value="" class="form-control"> 
                            </div>
                        </div>
                    </div>
                    <div class="form-group hide-view hide" id="btn-save">
                        <div class="col-sm-12">
                            <button class="btn btn-success text-uppercase pull-right">
                                <i class="material-icons">save</i>
                                <span>UPDATE</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
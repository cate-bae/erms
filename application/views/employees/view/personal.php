
<div class="card">
    <form id="form-personal">
    <div class="header">
        <h2>
            <?php if (in_array(get_user_type(), [-1, 0])) { 
                echo $page_title;      
            } ?>

            <button id="edit-button" type="button" class="btn btn-warning waves-effect pull-right" onclick="enableFields('form-personal')">
                <i class="material-icons">edit</i>
                <span>Edit</span>
            </button>
            <button id="cancel-button" type="button" class="btn btn-default waves-effect pull-right" onclick="location.reload()" style="display: none">
                <i class="material-icons">close</i>
                <span>Cancel</span>
            </button>
        </h2>
    </div>
    <div class="body">
        <input type="hidden" name="user_id" value="<?=$user_id?>">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Date of Birth</th>
                    <td>
                        <div class="form-line demo-masked-input">
                            <input name="birth_day" type="text" value="<?=empty($info['personal']->birth_day) ? '' : date('m/d/Y', strtotime($info['personal']->birth_day))?>" class="form-control date" placeholder="mm/dd/yyyy" disabled>
                        </div>
                    </td>
                    <th>Place of Birth</th>
                    <td>
                        <input name="birth_place" type="text" value="<?=issetor($info['personal']->birth_place)?>" class="form-control" disabled>
                    </td>
                </tr>
                <tr>
                    <th>Sex</th>
                    <td>
                        <div class="demo-radio-button">
                            <input name="sex" type="radio" id="radio_sex_male" class="with-gap" value="Male" <?=issetor($info['personal']->sex) == 'Male' ? 'checked' : ''?> disabled>
                            <label for="radio_sex_male">Male</label>
                            <input name="sex" type="radio" id="radio_sex_female" class="with-gap" value="Female" <?=issetor($info['personal']->sex) == 'Female' ? 'checked' : ''?> disabled>
                            <label for="radio_sex_female">Female</label>
                        </div>
                    </div></td>
                    <th>Civil Status</th>
                    <td>
                        <select name="civil_status" class="form-control show-tick" disabled>
                            <option value="Single" <?=issetor($info['personal']->civil_status) == 'Single' ? 'selected' : ''?>>Single</option>
                            <option value="Married" <?=issetor($info['personal']->civil_status) == 'Married' ? 'selected' : ''?>>Married</option>
                            <option value="Widowed" <?=issetor($info['personal']->civil_status) == 'Widowed' ? 'selected' : ''?>>Widowed</option>
                            <option value="Separated" <?=issetor($info['personal']->civil_status) == 'Separated' ? 'selected' : ''?>>Separated</option>
                            <option value="Other/s" <?=issetor($info['personal']->civil_status) == 'Other/s' ? 'selected' : ''?>>Other/s</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Citizenship</th>
                    <td colspan="3">                                
                        <div class="demo-radio-button">
                            <input name="citizenship" type="radio" id="radio_citizenship_1" class="with-gap" value="Filipino" <?=issetor($info['personal']->citizenship) == 'Filipino' ? 'checked' : ''?> disabled>
                            <label for="radio_citizenship_1">Filipino</label>
                            
                            <input name="citizenship" type="radio" id="radio_citizenship_2" class="with-gap" value="Dual Citizenship" <?=issetor($info['personal']->citizenship) == 'Dual Citizenship' ? 'checked' : ''?> disabled>
                            <label for="radio_citizenship_2" style="min-width: auto;">Dual Citizenship</label>
                        </div>
                    </td>
                </tr>
                <tr id="dual_citizenship" <?=issetor($info['personal']->citizenship) != 'Dual Citizenship' ? 'style="display: none"' : ''?>>
                    <th>Dual Citizenship</th>
                    <td>    
                        <div class="demo-radio-button">
                            <input name="dual_citizenship" type="radio" id="dual_citizenship_1" class="with-gap" value="by birth" <?=issetor($info['personal']->dual_citizenship) == 'by birth' ? 'checked' : ''?> disabled>
                            <label for="dual_citizenship_1" style="min-width: 100px;">by birth</label>

                            <input name="dual_citizenship" type="radio" id="dual_citizenship_2" class="with-gap" value="by naturalization" <?=issetor($info['personal']->dual_citizenship) == 'by naturalization' ? 'checked' : ''?> disabled>
                            <label for="dual_citizenship_2">by naturalization</label>
                        </div>
                    </td>
                    <th style="vertical-align: top">Country</th>
                    <td>
                        <select name="country" class="form-control show-tick" data-live-search="true" disabled>
                            <?php foreach(get_countries() as $country_key => $country) {?>

                                <option value="<?=$country_key?>" <?=issetor($info['personal']->country) == $country_key ? 'selected' : ''?>><?=$country?></option>
                            <?php } ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Height(m)</th>
                    <td>
                        <input name="height" type="text" value="<?=issetor($info['personal']->height)?>" class="form-control" disabled>
                    </td>
                    <th>Weight(kg)</th>
                    <td>
                        <input name="weight" type="text" value="<?=issetor($info['personal']->weight)?>" class="form-control" disabled>
                    </td>
                </tr>
                <tr>
                    <th>Blood Type</th>
                    <td colspan="3">
                        <input name="blood_type" type="text" value="<?=issetor($info['personal']->blood_type)?>" class="form-control" disabled>
                    </td>
                </tr>
                <tr>
                    <th>GSIS ID No.</th>
                    <td>
                        <input name="gsis" type="text" value="<?=issetor($info['personal']->gsis)?>" class="form-control" disabled>
                    </td>
                    <th>PAG-IBIG ID No.</th>
                    <td>
                        <input name="pagibig" type="text" value="<?=issetor($info['personal']->pagibig)?>" class="form-control" disabled>
                    </td>
                </tr>
                <tr>
                    <th>PHILHEALTH No.</th>
                    <td>
                        <input name="philhealth" type="text" value="<?=issetor($info['personal']->philhealth)?>" class="form-control" disabled>
                    </td>
                    <th>SSS No.</th>
                    <td>
                        <input name="sss" type="text" value="<?=issetor($info['personal']->sss)?>" class="form-control" disabled>
                    </td>
                </tr>
                <tr>
                    <th>TIN No.</th>
                    <td>
                        <input name="tin" type="text" value="<?=issetor($info['personal']->tin)?>" class="form-control" disabled>
                    </td>
                    <th>Agency Employee No.</th>
                    <td>
                        <input name="agency_employee_no" type="text" value="<?=issetor($info['personal']->agency_employee_no)?>" class="form-control" disabled>
                    </td>
                </tr>
                <tr>
                    <th>Telephone No.</th>
                    <td>
                        <input name="telephone" type="text" value="<?=issetor($info['personal']->telephone)?>" class="form-control" disabled>
                    </td>
                    <th>Mobile No.</th>
                    <td>
                        <input name="mobile" type="text" value="<?=issetor($info['personal']->mobile)?>" class="form-control" disabled>
                    </td>
                </tr>
                <tr>
                    <th>Email Address</th>
                    <td colspan="3">
                        <input name="email" type="text" value="<?=issetor($info['personal']->email)?>" class="form-control" disabled>
                    </td>
                </tr>
                
            </tbody>
        </table>
        
        <h2 class="card-inside-title">
            RESIDENTIAL ADDRESS
        </h2>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>House/Block/Lot No.</th>
                    <td>
                        <input name="house_no[0]" type="text" value="<?=issetor($info['address'][0]->house_no)?>" class="form-control" disabled>
                    </td>
                    <th>Street</th>
                    <td>
                        <input name="street[0]" type="text" value="<?=issetor($info['address'][0]->street)?>" class="form-control" disabled>
                    </td>
                </tr>
                <tr>
                    <th>Subdivision/Village</th>
                    <td>
                        <input name="subdivision[0]" type="text" value="<?=issetor($info['address'][0]->subdivision)?>" class="form-control" disabled>
                    </td>
                    <th>Barangay</th>
                    <td>
                        <input name="barangay[0]" type="text" value="<?=issetor($info['address'][0]->barangay)?>" class="form-control" disabled>
                    </td>
                </tr>
                <tr>
                    <th>City/Municipality</th>
                    <td>
                        <input name="municipality[0]" type="text" value="<?=issetor($info['address'][0]->municipality)?>" class="form-control" disabled>
                    </td>
                    <th>Province</th>
                    <td>
                        <input name="province[0]" type="text" value="<?=issetor($info['address'][0]->province)?>" class="form-control" disabled>
                    </td>
                </tr>
                <tr>
                    <th>Zip Code</th>
                    <td colspan="3">
                        <input name="zip[0]" type="text" value="<?=issetor($info['address'][0]->zip)?>" class="form-control" disabled>
                    </td>
                </tr>
            </tbody>
        </table>

        <h2 class="card-inside-title">
            PERMANENT ADDRESS
        </h2>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>House/Block/Lot No.</th>
                    <td>
                        <input name="house_no[1]" type="text" value="<?=issetor($info['address'][1]->house_no)?>" class="form-control" disabled>
                    </td>
                    <th>Street</th>
                    <td>
                        <input name="street[1]" type="text" value="<?=issetor($info['address'][1]->street)?>" class="form-control" disabled>
                    </td>
                </tr>
                <tr>
                    <th>Subdivision/Village</th>
                    <td>
                        <input name="subdivision[1]" type="text" value="<?=issetor($info['address'][1]->subdivision)?>" class="form-control" disabled>
                    </td>
                    <th>Barangay</th>
                    <td>
                        <input name="barangay[1]" type="text" value="<?=issetor($info['address'][1]->barangay)?>" class="form-control" disabled>
                    </td>
                </tr>
                <tr>
                    <th>City/Municipality</th>
                    <td>
                        <input name="municipality[1]" type="text" value="<?=issetor($info['address'][1]->municipality)?>" class="form-control" disabled>
                    </td>
                    <th>Province</th>
                    <td>
                        <input name="province[1]" type="text" value="<?=issetor($info['address'][1]->province)?>" class="form-control" disabled>
                    </td>
                </tr>
                <tr>
                    <th>Zip Code</th>
                    <td colspan="3">
                        <input name="zip[1]" type="text" value="<?=issetor($info['address'][1]->zip)?>" class="form-control" disabled>
                    </td>
                </tr>
            </tbody>
        </table>

        
        <div class="row clearfix" id="save-button" style="display: none">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success text-uppercase pull-right">
                    <i class="material-icons">save</i>
                    <span>Save</span>
                </button>
            </div>
        </div>
    </div>
    </form>
</div>

<style>
.table th, .table td {
    vertical-align: middle !important;
}
.demo-checkbox label, .demo-radio-button label {
    min-width: 75px;
}

.card .header h2 {
    position: relative;
    min-height: 18px;
    text-transform: uppercase;
}
.card .header button {
    right: 0;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
}
</style>
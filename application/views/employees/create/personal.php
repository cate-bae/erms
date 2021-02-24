<div class="row">
    <div class="col-sm-12">
        <p style="font-size: 18px; text-transform: uppercase"><?=get_page_title('personal');?></p>
        <hr style="margin: 0 -15px">
    </div>
</div>
<div class="form-horizontal">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Date of Birth*</label>
                <div class="col-md-12">
                    <div class="form-line demo-masked-input">
                        <input name="birth_day" type="text" class="form-control date" placeholder="mm/dd/yyyy">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Place of Birth*</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="birth_place" type="text" value="" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Sex*</label>
                <div class="col-md-12">
                    <div class="demo-radio-button">
                        <input name="sex" type="radio" id="radio_sex_male" class="with-gap" value="Male" checked>
                        <label for="radio_sex_male">Male</label>
                        <input name="sex" type="radio" id="radio_sex_female" class="with-gap" value="Female">
                        <label for="radio_sex_female">Female</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Blood Type*</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="blood_type" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-12">Civil Status*</label>
        <div class="col-md-12">
            <div class="demo-radio-button">
                <input name="civil_status" type="radio" id="radio_civil_single" class="with-gap" value="Single" checked>
                <label for="radio_civil_single">Single</label>

                <input name="civil_status" type="radio" id="radio_civil_married" class="with-gap" value="Married">
                <label for="radio_civil_married">Married</label>

                <input name="civil_status" type="radio" id="radio_civil_widowed" class="with-gap" value="Widowed">
                <label for="radio_civil_widowed">Widowed</label>

                <input name="civil_status" type="radio" id="radio_civil_separated" class="with-gap" value="Separated">
                <label for="radio_civil_separated">Separated</label>

                <div class="input-group">
                    <span class="input-group-addon">
                        <input name="civil_status" type="radio" id="radio_civil_others" class="with-gap" value="Other/s">
                        <label for="radio_civil_others" style="min-width: auto;">Other/s:</label>
                    </span>
                    <div class="form-line">
                        <input name="civil_others" type="text" class="form-control">
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-12">Citizenship*</label>
        <div class="col-md-12">
            <div class="demo-radio-button">
                <input name="citizenship" type="radio" id="radio_citizenship_1" class="with-gap" value="Filipino" checked>
                <label for="radio_citizenship_1">Filipino</label>
                
                <input name="citizenship" type="radio" id="radio_citizenship_2" class="with-gap" value="Dual Citizenship">
                <label for="radio_citizenship_2" style="min-width: auto;">Dual Citizenship</label>
            </div>
        </div>
    </div>

    <div class="row" id="dual_citizenship" style="display: none">
        <div class="col-sm-12 m-b-0">
            <div class="form-group">
                <label class="col-md-12">Dual Citizenship*</label>
                <div class="col-md-12">
                    <div class="demo-radio-button">
                        <input name="dual_citizenship" type="radio" id="dual_citizenship_1" class="with-gap" value="by birth" checked>
                        <label for="dual_citizenship_1" style="min-width: 100px;">by birth</label>

                        <input name="dual_citizenship" type="radio" id="dual_citizenship_2" class="with-gap" value="by naturalization">
                        <label for="dual_citizenship_2">by naturalization</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="col-md-12">Country*</label>
                <div class="col-md-6">
                    <div class="form-line">
                        <select name="country" class="form-control show-tick" data-live-search="true">
                            <!-- <option selected disabled>-- Select Country --</option> -->

                            <?php foreach(get_countries() as $country_key => $country) {?>

                                <option value="<?=$country_key?>"><?=$country?></option>
                            <?php } ?>

                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Height*</label>
                <div class="col-md-12">
                    <div class="input-group">
                        <div class="form-line">
                            <input name="height" type="text" class="form-control" placeholder="">
                        </div>
                        <span class="input-group-addon">meters</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Weight*</label>
                <div class="col-md-12">
                    <div class="input-group">
                        <div class="form-line">
                            <input name="weight" type="text" class="form-control" placeholder="">
                        </div>
                        <span class="input-group-addon">kg</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">GSIS ID No.</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="gsis" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">PAG-IBIG ID No.</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="pagibig" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">PHILHEALTH No.</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="philhealth" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">SSS No.</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="sss" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">TIN No.</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="tin" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">AGENCY EMPLOYEE No.</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="agency_employee_no" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Telephone No.</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="telephone" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Mobile No.</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="mobile" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Email Address</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="email" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h2 class="card-inside-title">
        Residential Address
    </h2>
    
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">House/Block/Lot No</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="house_no[0]" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Street</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="street[0]" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Subdivision/Village</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="subdivision[0]" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Barangay</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="barangay[0]" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">City/Municipality</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="municipality[0]" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Province</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="province[0]" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Zip Code</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="zip[0]" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <h2 class="card-inside-title">
        Permanent Address
    </h2>
    
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">House/Block/Lot No</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="house_no[1]" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Street</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="street[1]" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Subdivision/Village</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="subdivision[1]" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Barangay</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="barangay[1]" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">City/Municipality</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="municipality[1]" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Province</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="province[1]" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="col-md-12">Zip Code</label>
                <div class="col-md-12">
                    <div class="form-line">
                        <input name="zip[1]" type="text" class="form-control" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade  employeeModal" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <form id="Employee-form">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-title"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i aria-hidden="true" class="ki ki-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <x-form.input id="emp_id" name="emp_id" type="hidden" />

                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <x-form.label label='First Name' />
                                            <x-form.input id="first_name" name="first_name" />
                                            <x-form.span id="first_name_error" />

                                        </div>
                                        <div class="form-group col-md-3">
                                            <x-form.label label='Last Name' />
                                            <x-form.input id="last_name" name="last_name" />
                                            <x-form.span id="last_name_error" />

                                        </div>
                                        <div class=" col-md-3">
                                            <div class="form-group">

                                                <x-form.label label='Gender' />
                                                <x-form.select name="gender" :options="$gender"  />
                                                <x-form.span id="gender_error" />
                                            </div>
                                        </div>
                                       
                                        <div class="form-group col-md-3">
                                            <x-form.label label='Mobile' />
                                            <x-form.input id="phone" type="number" name="phone" />
                                            <x-form.span id="phone_error" />

                                        </div>
                                        

                                    </div>
                                    <div class="row">
                                        
                                        
                                        <div class="form-group col-md-3">
                                            <x-form.label label='Email' />
                                            <x-form.input id="email" type="email" name="email" />
                                            <x-form.span id="email_error" />

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <x-form.label label='Password' class="text-right " />
                                            <x-form.input id="password" type="password" name="password" />
                                            <x-form.span id="password_error" />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <x-form.label label='Password confirmation' class="text-right " />
                                            <x-form.input id="password_confirmation" type="password" name="password_confirmation" />
                                            <x-form.span id="password_confirmation_error" />

                                        </div>
                                        <div class="form-group col-md-3">
                                            <x-form.label label='D.O.B' class="text-right " />
                                            <x-form.input id="date_of_birth" type="date" name="date_of_birth" />
                                            <x-form.span id="date_of_birth_error" />

                                        </div>

                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <x-form.label label='Address' />
                                            <x-form.input id="address"  name="address" />
                                            <x-form.span id="address_error" />

                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="d-flex " style="gap:160px;">

                                                <div class="image-input image-input-empty image-input-outline" id="kt_image_5" style="background-image: url({{ asset('assets/media/users/blank.png')}})">
                                                    <div class="image-input-wrapper"></div>
                            
                                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg"/>
                                                        <input type="hidden" name="avatar_remove"/>
                                                    </label>
                            
                                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                    </span>
                            
                                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary font-weight-bold"
                                        data-dismiss="modal">Close</button>
                                    <button type="button"
                                        id="save-btn"class="btn btn-primary font-weight-bold"></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
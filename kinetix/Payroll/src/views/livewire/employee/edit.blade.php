<div>
{{--    @if ($errors->any())--}}
{{--        <div class="alert alert-danger">--}}
{{--            <ul>--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}
    <form wire:submit.prevent="update" class="forms-sample text-dark">

        <div class="d-flex justify-content-between mb-4" >
            <div class="card col-md mr-3">
                <div class="card-body">
                    <h2 class="card-title font-weight-bolder">Personal Details</h2>
                    <div class="form-group">
                        <label for="fname" class="">First Name <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="text" wire:model.lazy="fname"
                                class="form-control @error('fname') is-invalid @enderror" id="fname"
                                placeholder="First Name">
                            @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lname" class="">Last Name <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="text" wire:model.lazy="lname"
                                class="form-control @error('lname') is-invalid @enderror" id="lname"
                                placeholder="Last Name">
                            @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="dob" class="">Date of Birth <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="date" wire:model.lazy="dob"
                                class="form-control @error('dob') is-invalid @enderror" id="dob">
                            @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group" >
                        <label for="gender">Gender <span class="text-danger">*</span></label>
                        <select class="form-control @error('gender') is-invalid @enderror" id="gender"
                            wire:model.lazy="gender">
                            <option value="" selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Maritial Status <span class="text-danger">*</span></label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status"
                            wire:model.lazy="status">
                            <option>Select Status</option>
                            <option>Single</option>
                            <option>Married</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="father" class="">Father's Name <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="text" wire:model.lazy="father"
                                class="form-control @error('father') is-invalid @enderror" id="father"
                                placeholder="Father's Name">
                            @error('father')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nation" class="">Nationality <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="text" wire:model.lazy="nation"
                                class="form-control @error('nation') is-invalid @enderror" id="nation"
                                placeholder="Nationality">
                            @error('nation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="nid" class="">NID <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="text" wire:model.lazy="nid"
                                class="form-control @error('nid') is-invalid @enderror" id="nid"
                                placeholder="NID No">
                            @error('nid')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo" class="">Photo <span class="text-danger">*</span></label>
                        <div class="">
                            @if ($updatePhoto)
                                <img width="60px" height="60px" src="{{ $updatePhoto->temporaryUrl() }}">
                            @else
                                <img width="60px" height="60px" src="/storage/{{ $photo }}">
                            @endif
                            <input type="file" wire:model.lazy="updatePhoto"
                                class="form-control @error('updatePhoto') is-invalid @enderror" id="updatePhoto"
                                placeholder="updatePhoto">
                            @error('updatePhoto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card col-md">
                <div class="card-body">
                    <h2 class="card-title font-weight-bolder">Contact Details</h2>
                    <div class="form-group">
                        <label for="address" class="">Present Address <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="text" wire:model.lazy="address"
                                class="form-control @error('address') is-invalid @enderror" id="address"
                                placeholder="Present Address">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="">City <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="text" wire:model.lazy="city"
                                class="form-control @error('city') is-invalid @enderror" id="city"
                                placeholder="City">
                            @error('city')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="country" class="">Country <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="text" wire:model.lazy="country"
                                class="form-control @error('country') is-invalid @enderror" id="country"
                                placeholder="Country">
                            @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="">Mobile <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="text" wire:model.lazy="mobile"
                                class="form-control @error('mobile') is-invalid @enderror" id="mobile"
                                placeholder="Mobile">
                            @error('mobile')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="">Phone</label>
                        <div class="">
                            <input type="text" wire:model.lazy="phone"
                                class="form-control @error('phone') is-invalid @enderror" id="phone"
                                placeholder="Phone">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="">Email <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="email" wire:model.lazy="email"
                                class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder="Email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mb-4">
            <div class="card col-md mr-3">
                <div class="card-body">
                    <h2 class="card-title  font-weight-bolder">Bank Information</h2>
                    <div class="form-group">
                        <label for="bank" class="">Bank Name</label>
                        <div class="">
                            <input type="text" wire:model.lazy="bank"
                                class="form-control @error('bank') is-invalid @enderror" id="bank">
                            @error('bank')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="branch" class="">Branch Name</label>
                        <div class="">
                            <input type="text" wire:model.lazy="branch"
                                class="form-control @error('branch') is-invalid @enderror" id="branch"
                                placeholder="">
                            @error('branch')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="acc_name" class="">Account Name</label>
                        <div class="">
                            <input type="text" wire:model.lazy="acc_name"
                                class="form-control @error('acc_name') is-invalid @enderror" id="acc_name"
                                placeholder="">
                            @error('acc_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="acc_number" class="">Account Number</label>
                        <div class="">
                            <input type="text" wire:model.lazy="acc_number"
                                class="form-control @error('acc_number') is-invalid @enderror" id="acc_number"
                                placeholder="">
                            @error('acc_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
            <div class="card col-md">
                <div class="card-body">
                    <h2 class="card-title font-weight-bolder">Official Status</h2>
                    <div class="form-group">
                        <label for="emp_id" class="">Employee ID <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="text" wire:model.lazy="emp_id"
                                class="form-control @error('emp_id') is-invalid @enderror" id="emp_id"
                                placeholder="">
                            @error('emp_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="department">Maritial department <span class="text-danger">*</span></label>
                        <select class="form-control @error('department_id') is-invalid @enderror" id="department"
                            wire:model="department_id">
                            <option>Select Department</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->department }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="designation">Designation <span class="text-danger">*</span></label>
                        <select class="form-control @error('designation_id') is-invalid @enderror" id="designation"
                            wire:model.lazy="designation_id">
                            <option value="">Select Designation</option>
                            @foreach($designations as $desig)
                                <option value="{{ $desig->id }}">{{ $desig->name }}</option>
                            @endforeach
                        </select>
                        @error('designation_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="join_date" class="">Joining Date <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="date" wire:model.lazy="join_date"
                                class="form-control @error('join_date') is-invalid @enderror" id="join_date"
                                placeholder="">
                            @error('join_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mb-4">
            <div class="card col-md mr-3">
                <div class="card-body">
                    <h2 class="card-title  font-weight-bolder">Employee Documents</h2>
                    <div class="">
                        <div class="form-group">
                            <label for="updateResume" class="">Resume</label>
                            <div class="">
                                <input type="file" wire:model.lazy="updateResume"
                                    class="form-control @error('updateResume') is-invalid @enderror" id="updateResume">
                                @error('updateResume')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateOffer_let" class="">Offer Letter</label>
                            <div class="">
                                <input type="file" wire:model.lazy="updateOffer_let"
                                    class="form-control @error('updateOffer_let') is-invalid @enderror" id="updateOffer_let"
                                    placeholder="">
                                @error('updateOffer_let')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateJoin_let" class="">Joining Letter</label>
                            <div class="">
                                <input type="file" wire:model.lazy="updateJoin_let"
                                    class="form-control @error('updateJoin_let') is-invalid @enderror" id="updateJoin_let"
                                    placeholder="">
                                @error('updateJoin_let')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateContact_paper" class="">Contract Paper</label>
                            <div class="">
                                <input type="file" wire:model.lazy="updateContact_paper"
                                    class="form-control @error('updateContact_paper') is-invalid @enderror"
                                    id="updateContact_paper" placeholder="">
                                @error('updateContact_paper')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateId_proff" class="">ID Proff</label>
                            <div class="">
                                <input type="file" wire:model.lazy="updateId_proff"
                                    class="form-control @error('updateId_proff') is-invalid @enderror" id="updateId_proff"
                                    placeholder="">
                                @error('updateId_proff')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="updateOther" class="">Other Document</label>
                            <div class="">
                                <input type="file" wire:model.lazy="updateOther"
                                    class="form-control @error('updateOther') is-invalid @enderror" id="updateOther"
                                    placeholder="">
                                @error('updateOther')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm-8 offset-sm-2 mb-5">
            <button type="submit" class="btn btn-info btn-block">UPDATE</button>
        </div>
    </form>

    </div>


<div>
    @section('title', 'Add Loan')

    <div class="grid-margin stretch-card">
        <div class="card text-dark">
            <div class="card-body">
                <form wire:submit.prevent="store" class="forms-sample offset-2">
 
                    <div class="form-group row">
                        <label for="start" class="col-sm-3 font-weight-bold col-form-label">Employee Name <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <select class="form-control @error('employee_id') is-invalid @enderror" id="SelectEmployee" style="width: 100%" wire:model.lazy="employee_id" >
                                <option></option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->fname }} {{ $employee->lname }}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="approve_date" class="col-sm-3 font-weight-bold col-form-label">Approve Date <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="date" wire:model.debounce.1000ms="approve_date"
                                class="form-control @error('approve_date') is-invalid @enderror" id="approve_date">
                            @error('approve_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="repay_from" class="col-sm-3 font-weight-bold col-form-label">Repayment From <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="date" wire:model.debounce.1000ms="repay_from"
                                class="form-control @error('repay_from') is-invalid @enderror" id="repay_from">
                            @error('repay_from')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 font-weight-bold col-form-label">Amount <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="number" wire:model.debounce.1000ms="amount"
                                 class="form-control @error('amount') is-invalid @enderror" id="amount">
                            @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="install_period" class="col-sm-3 font-weight-bold col-form-label">Installment Period <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="number" wire:model.debounce.1000ms="install_period"
                                    class="form-control @error('install_period') is-invalid @enderror" id="install_period" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text font-weight-bold" id="basic-addon2">Months</span>
                                </div>
                            </div>
                            @error('install_period')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="repay_total" class="col-sm-3 font-weight-bold col-form-label">Repayment Total <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="number" wire:model.debounce.1000ms="repay_total"
                                class="form-control @error('repay_total') is-invalid @enderror" id="repay_total" disabled>
                            @error('repay_total')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="installment" class="col-sm-3 font-weight-bold col-form-label">Installment <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="number" wire:model.debounce.1000ms="installment"
                                class="form-control @error('installment') is-invalid @enderror" id="installment" disabled>
                            @error('installment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="note" class="col-sm-3 font-weight-bold col-form-label">Notes <span class="text-danger">*</span></label>
                        <div class="col-sm-6">
                            <input type="text" wire:model.debounce.1000ms="note"
                                class="form-control @error('note') is-invalid @enderror" id="note">
                            @error('note')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6 offset-sm-3">
                        <button type="submit" class="btn btn-success btn-block">SAVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>


<script>
    window.addEventListener("livewire:load", function (event) {
        
        $('#SelectEmployee').select2({
            placeholder: 'Select Employee',
        });

        $(document).on('change', '#SelectEmployee', function (e) {
            @this.set('employee_id', e.target.value);
        });
    });

</script>
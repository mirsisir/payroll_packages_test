<div>
    <div class="grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form wire:submit.prevent="store" class="forms-sample">

                    <div class="form-group row">
                        <label for="start" class="col-sm-2 col-form-label">Employee</label>
                        <div class="col-sm-8">
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
                        <label for="end" class="col-sm-2 col-form-label">Leave Category</label>
                        <div class="col-sm-8">
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                                wire:model="category_id">
                                <option value="">Select Leave Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="start" class="col-sm-2 col-form-label">Start Date</label>
                        <div class="col-sm-8">
                            <input type="date" wire:model="start"
                                class="form-control @error('start') is-invalid @enderror" id="start">
                            @error('start')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="end" class="col-sm-2 col-form-label">End Date</label>
                        <div class="col-sm-8">
                            <input type="date" wire:model="end"
                                class="form-control @error('end') is-invalid @enderror" id="end">
                            @error('end')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="reason" class="col-sm-2 col-form-label">Reason</label>
                        <div class="col-sm-8">
                            <textarea type="text" wire:model="reason"
                                class="form-control @error('reason') is-invalid @enderror" id="reason"
                                placeholder="Leave Reason"></textarea>
                            @error('reason')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-8 offset-sm-2">
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



<div class="card col-md mr-3">
    <div class="card-body">
        <h4 class="card-title">Add Department</h4>
        <form class="forms-sample" wire:submit.prevent>
            <div class="form-group row">
                <label for="department" class="col-sm-3 col-form-label">Department</label>
                <div class="col-sm-7">
                    <input type="text" wire:model="department" class="form-control @error('department') is-invalid @enderror" id="department" placeholder="Department Name">
                    @error('department')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            @foreach ($designations as $index => $designation)
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Designation</label>
                    <div class="col-sm-7">
                        <input type="text"
                            wire:model="designations.{{ $index }}"
                            name="designations[{{ $index }}]"
                            class="form-control @error('designations.'.$index) is-invalid @enderror"
                            placeholder="Designation"
                        >
                    </div>

{{--                    <div class="col-sm-2">--}}
{{--                        <button wire:click.prevent="removeDesignation({{ $index }})" class="btn btn-danger btn-sm">-</button>--}}
{{--                    </div>--}}

                </div>
            @endforeach

            <div class="">
                <button wire:click.prevent="addDesignation" class="btn btn-success btn-sm">+</button>
            </div>

            <div class="col-sm-7 offset-sm-3">
                <button wire:click.prevent="store" type="submit" class="btn btn-success btn-block">Save</button>
            </div>
        </form>
    </div>
</div>

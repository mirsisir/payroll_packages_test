<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Add Leave Category</h2>
            <form class="forms-sample">
                <div class="form-group row">
                    <label for="category_name" class="col-sm-2 col-form-label">Leave Category</label>
                    <div class="col-sm-8">
                        <input type="text" wire:model="category_name" value="{{ old('category_name') }}"
                            class="form-control @error('category_name') is-invalid @enderror" id="Category Name"
                            placeholder="Enter Leave Category">
                        @error('category_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-sm-8 offset-sm-2">
                    <button wire:click.prevent="store" type="submit" class="btn btn-success btn-block">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
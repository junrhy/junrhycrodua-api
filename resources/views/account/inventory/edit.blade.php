@push('scripts')
<script type="text/javascript">
setTimeout(function(){ document.getElementById("unit").value = "{{ $inventory->unit }}" }, 1);
</script>
@endpush
<x-account-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="h1">Edit Item</div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <form action="{{ route('inventory.update', $inventory->id) }}" method="POST">
                    <div class="form-group">
                        <label for="item_name" class="label">Name</label>
                        <input type="text" class="form-control @error('item_name') is-invalid @enderror" id="item_name" name="item_name" value="{{ ucwords($inventory->name) }}">
                        @error('item_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="price" class="label">Price</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $inventory->price }}">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="currency" class="label">Currency</label>
                        <select class="form-control @error('currency') is-invalid @enderror" id="currency" name="currency">
                            <option value="php">PHP</option>
                        </select>
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="qty" class="label">Quantity</label>
                        <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty" value="{{ $inventory->qty }}">
                        @error('qty')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="unit" class="label">Unit</label>
                        <select class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit">
                            <option value="piece">Piece</option>
                            <option value="kilo">Kilo</option>
                            <option value="sack">Sack</option>
                        </select>
                        @error('unit')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</x-account-layout>
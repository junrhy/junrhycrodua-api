<x-account-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="h1">New Item</div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <form action="{{ route('inventory.store') }}" method="POST">
                    <div class="form-group">
                        <label for="item_name" class="label">Name</label>
                        <input type="text" class="form-control @error('item_name') is-invalid @enderror" id="item_name" name="item_name">
                        @error('item_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="price" class="label">Price</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="currency" class="label">Currency</label>
                        <input type="text" class="form-control @error('currency') is-invalid @enderror" id="currency" name="currency">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="qty" class="label">Quantity</label>
                        <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty">
                        @error('qty')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="unit" class="label">Unit</label>
                        <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit">
                        @error('unit')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-primary mt-3">Add</button>
                </form>
            </div>
        </div>
    </div>
</x-account-layout>
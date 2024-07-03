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
                        <label for="item_code" class="label">Item Code</label>
                        <input type="text" class="form-control @error('item_code') is-invalid @enderror" id="item_code" name="item_code">
                        @error('item_code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="purchase_price" class="label">Purchase Price</label>
                        <input type="text" class="form-control @error('purchase_price') is-invalid @enderror" id="purchase_price" name="purchase_price">
                        @error('purchase_price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="selling_price" class="label">Selling Price</label>
                        <input type="text" class="form-control @error('selling_price') is-invalid @enderror" id="selling_price" name="selling_price">
                        @error('selling_price')
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
                        <input type="number" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty">
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

                    <div class="form-group mt-3">
                        <label for="status" class="label">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="IN">IN - Add To Inventory</option>
                            <option value="OUT">OUT - Remove From Inventory</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="note" class="label">Note</label>
                        <input type="text" class="form-control @error('note') is-invalid @enderror" id="note" name="note">
                        @error('note')
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
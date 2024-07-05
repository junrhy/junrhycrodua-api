<x-account-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="h1">New Order</div>
        </div>
        <div class="row">
            <div class="col-md-4">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('order.store') }}" method="POST">
                    <div class="form-group">
                        <label for="item_name" class="label">Name</label>
                        <input type="text" class="form-control @error('item_name') is-invalid @enderror" id="item_name" name="item_name">
                        @error('item_name')
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
                        <label for="price" class="label">Price</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="status" class="label">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="to_prepare">To Prepare</option>
                            <option value="prepared">Prepared</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="shipped">Shipped</option>
                            <option value="served">Served</option>
                            <option value="delivered">Delivered</option>
                            <option value="completed">Completed</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="type" class="label">Type</label>
                        <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                            <option value="pick-up">Pick Up</option>
                            <option value="deliver">Deliver</option>
                            <option value="dine-in">Dine In</option>
                            <option value="take-out">Take Out</option>
                        </select>
                        @error('type')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="source" class="label">Source</label>
                        <input type="text" class="form-control @error('source') is-invalid @enderror" id="source" name="source">
                        @error('source')
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
@push('scripts')
<script type="text/javascript">
setTimeout(function(){ 
    document.getElementById("payment_type").value = "{{ $sale->payment_type }}",
    document.getElementById("status").value = "{{ $sale->status }}"
}, 1);
</script>
@endpush
<x-account-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="h1">New Sale</div>
        </div>
        <div class="row">
            <div class="col-md-4">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('sale.update', $sale->id) }}" method="POST">
                    <div class="form-group">
                        <label for="source" class="label">Source</label>
                        <input type="text" class="form-control @error('source') is-invalid @enderror" id="source" name="source" value="{{ ucwords($sale->source) }}">
                        @error('source')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="items" class="label">Items</label>
                        <textarea class="form-control @error('items') is-invalid @enderror" id="items" name="items" rows=10>{{ $sale->items }}</textarea>
                        @error('items')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="amount" class="label">Amount</label>
                        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ $sale->amount }}">
                        @error('amount')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="discount" class="label">Discount</label>
                        <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{ $sale->discount }}">
                        @error('amount')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="fees" class="label">Fees</label>
                        <input type="number" class="form-control @error('fees') is-invalid @enderror" id="fees" name="fees" value="{{ $sale->fees }}">
                        @error('amount')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="tax" class="label">Tax</label>
                        <input type="number" class="form-control @error('tax') is-invalid @enderror" id="tax" name="tax" value="{{ $sale->tax }}">
                        @error('tax')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="payment_type" class="label">Payment Type</label>
                        <select class="form-control @error('payment_type') is-invalid @enderror" id="payment_type" name="payment_type">
                            <option value="cash">Cash</option>
                            <option value="credit_card">Credit Card</option>
                            <option value="debit_card">Debit Card</option>
                            <option value="cheque">Cheque</option>
                            <option value="gcash">GCash</option>
                            <option value="maya">Maya</option>
                        </select>
                        @error('payment_type')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="payment_tracking_code" class="label">Tracking #</label>
                        <input type="text" class="form-control @error('payment_tracking_code') is-invalid @enderror" id="payment_tracking_code" name="payment_tracking_code" value="{{ $sale->payment_tracking_code }}">
                        @error('payment_tracking_code')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="status" class="label">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="to_pay">To Pay</option>
                            <option value="Paid">Paid</option>
                        </select>
                        @error('status')
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
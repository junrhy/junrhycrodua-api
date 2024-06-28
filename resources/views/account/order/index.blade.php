@push('scripts')
<script>
$(document).ready(function(){
    $('#orderTable').DataTable({
        initComplete: function () {
            this.api()
                .columns([1, 2, 3])
                .every(function () {
                    var column = this;
                    var title = column.footer().textContent;
     
                    // Create input element and add event listener
                    $('<input type="text" placeholder="Search ' + title + '" />')
                        .appendTo($(column.footer()).empty())
                        .on('keyup change clear', function () {
                            if (column.search() !== this.value) {
                                column.search(this.value).draw();
                            }
                        });
                });
        }
    });
});
</script>
@endpush

<x-account-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="h1">Orders</div>
        </div>
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table id="orderTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Source</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>2024-12-01</td>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Pick Up, Deliver, Dine In, Take Out</td>
                            <td>Edinburgh</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Source</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-account-layout>
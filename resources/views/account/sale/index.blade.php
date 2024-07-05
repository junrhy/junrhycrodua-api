@push('scripts')
<script>
$(document).ready(function(){
    $('#orderTable').DataTable({
        layout: {
            topStart: {
                buttons: [
                    'pageLength', 
                    {
                        text: 'New',
                        action: function (e, dt, node, config) {
                            location.href = window.location.origin + "/account/sale/create";
                        }
                    },
                    {
                        text: 'Edit',
                        action: function (e, dt, node, config) {
                            let id = table.row('.selected').id();

                            if (id) {location.href = window.location.origin + "/account/sale/"+id+"/edit";}
                        }
                    },
                    {
                        text: 'Delete',
                        action: function (e, dt, node, config) {
                            let id = table.row('.selected').id();

                            $.ajax({
                                type: "DELETE",
                                url: "/account/sale/"+id,
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    'id' : id
                                },
                                success: function(result){
                                    table.row('.selected').remove().draw(false);
                                }
                            });
                        }
                    },
                    {
                        extend: 'collection',
                        text: 'Export',
                        buttons: [
                            'print',  'excelHtml5', 'csvHtml5', 'pdfHtml5'
                        ]
                    }
                ]
            }
        },
        responsive: {
            details: {
                display: DataTable.Responsive.display.modal({
                    header: function (row) {
                        var data = row.data();
                        return 'Details for ' + data[0] + ' ' + data[1];
                    }
                }),
                renderer: DataTable.Responsive.renderer.tableAll({
                    tableClass: 'table'
                })
            }
        },
        initComplete: function () {
            this.api()
                .columns([0, 7])
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
            <div class="h1">Sales</div>
        </div>
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table id="orderTable" class="table table-sm table-striped table-bordered nowrap" style="width:100%;border-bottom: 1px solid #ccc;">
                    <thead class="table-dark">
                        <tr>
                            <th>Source</th>
                            <th>Items</th>
                            <th>Amount</th>
                            <th>Discount</th>
                            <th>Fees</th>
                            <th>Tax</th>
                            <th>Payment Type</th>
                            <th>Payment Tracking #</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                        <tr id="{{ $sale->id }}">
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Source</th>
                            <th>Items</th>
                            <th>Amount</th>
                            <th>Discount</th>
                            <th>Fees</th>
                            <th>Tax</th>
                            <th>Payment Type</th>
                            <th>Tracking #</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-account-layout>
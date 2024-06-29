@push('scripts')
<script>
$(document).ready(function(){
    $('#inventoryTable').DataTable({
        layout: {
            topStart: {
                buttons: [
                    'pageLength', 'copyHtml5', 'print',  'excelHtml5', 'csvHtml5', 'pdfHtml5',
                    {
                        text: 'New',
                        action: function (e, dt, node, config) {
                            location.href = window.location + "/create";
                        }
                    },
                    {
                        text: 'Edit',
                        action: function (e, dt, node, config) {
                            location.href = window.location + "/edit/1";
                        }
                    },
                    {
                        text: 'Delete',
                        action: function (e, dt, node, config) {
                            alert('Delete button activated');
                        }
                    },
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
                .columns(1)
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
            <div class="h1">Inventory</div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="inventoryTable" class="table table-striped nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Unit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventories as $inventory)
                        <tr>
                            <td>{{ $inventory->create_at }}</td>
                            <td>{{ $inventory->item_id }}</td>
                            <td>{{ $inventory->qty }}</td>
                            <td>{{ $inventory->unit }}</td>
                            <td>
                                <i class="fa fa-solid fa-plus"></i> Increase | 
                                <i class="fa fa-solid fa-minus"></i> Decrease
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Unit</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-account-layout>
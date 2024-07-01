@push('scripts')
<script>
$(document).ready(function(){
    var table = $('#inventoryTable').DataTable({
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
                            let id = table.row('.selected').id();

                            if (id) {location.href = window.location + "/"+id+"/edit";}
                        }
                    },
                    {
                        text: 'Delete',
                        action: function (e, dt, node, config) {
                            let id = table.row('.selected').id();

                            $.ajax({
                                type: "DELETE",
                                url: "/account/inventory/"+id,
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
                .columns(0)
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

    $('#inventoryTable tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
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
                <table id="inventoryTable" class="table table-sm table-striped table-bordered nowrap" style="width:100%;border-bottom: 1px solid #ccc;">
                    <thead class="table-dark">
                        <tr>
                            <th>Item</th>
                            <th>Item Code</th>
                            <th>Total Value</th>
                            <th>Qty</th>
                            <th>Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventories as $inventory)
                        <tr id="{{ $inventory->id }}">
                            <td>{{ ucwords($inventory->name) }}</td>
                            <td>{{ $inventory->item_code }}</td>
                            <td>{{ $inventory->price }}</td>
                            <td>{{ $inventory->qty }}</td>
                            <td>{{ ucwords($inventory->unit) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Item</th>
                            <th>Item Code</th>
                            <th>Total Value</th>
                            <th>Qty</th>
                            <th>Unit</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-account-layout>
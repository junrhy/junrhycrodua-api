@push('scripts')
<script>
$(document).ready(function(){
    var table = $('#inventoryTable').DataTable({
        layout: {
            topStart: {
                buttons: [
                    'pageLength', 
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
                    {
                        extend: 'collection',
                        text: 'Export',
                        buttons: [
                            'print',  'excelHtml5', 'csvHtml5', 'pdfHtml5'
                        ]
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
        rowGroup: {
            startRender: null,
            endRender: function (rows, group) {
                var totalValueIn = 0;
                var totalValueOut = 0;
                var totalQtyIn = 0;
                var totalQtyOut = 0;

                rows.data().each(function(item, index, arr){
                    if (arr[index][5] == "IN") {
                        totalValueIn = +totalValueIn + +arr[index][2].replace(/\,/g,'');
                        totalQtyIn = +totalQtyIn + +arr[index][3].replace(/\,/g,'');
                    } else if (arr[index][5] == "OUT") {
                        totalValueOut = +totalValueOut + +arr[index][2].replace(/\,/g,'');
                        totalQtyOut = +totalQtyOut + +arr[index][3].replace(/\,/g,'');
                    }
                    
                });

                var totalAmount = totalValueIn - totalValueOut;
                var totalQty = totalQtyIn - totalQtyOut;

                const amountFormatter = new Intl.NumberFormat('en-US', {
                  style: 'currency',
                  currency: 'PHP'
                });

                return $('<tr/>').append('<td class="fw-bold bg-light" style="border-top: 1px solid #ccc;border-bottom: 1px dashed #ccc;background:white;">Total</td>')
                    .append('<td class="" style="border-top: 1px solid #ccc;border-bottom: 1px dashed #ccc;"></td>')
                    .append('<td class="fw-bold"  style="border-top: 1px solid #ccc;border-bottom: 1px dashed #ccc;" align="right">' + amountFormatter.format(totalAmount) + '</td>')
                    .append('<td class="fw-bold"  style="border-top: 1px solid #ccc;border-bottom: 1px dashed #ccc;" align="right">' + totalQty.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '</td>')
                    .append('<td class="" style="border-top: 1px solid #ccc;border-bottom: 1px dashed #ccc;"></td>')
                    .append('<td class="" style="border-top: 1px solid #ccc;border-bottom: 1px dashed #ccc;"></td>')
                    .append('<td class="" style="border-top: 1px solid #ccc;border-bottom: 1px dashed #ccc;"></td>');
            },
            dataSrc: 1
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
        if ($(this).hasClass('selected') || $(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
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
                <table id="inventoryTable" class="table table-sm table-bordered nowrap" style="width:100%;">
                    <thead class="table-dark">
                        <tr>
                            <th>Item</th>
                            <th>Item Code</th>
                            <th>Value</th>
                            <th>Qty</th>
                            <th>Unit</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventories as $inventory)
                        <tr id="{{ $inventory->id }}">
                            <td>{{ ucwords($inventory->name) }}</td>
                            <td>{{ strtoupper($inventory->item_code) }}</td>
                            <td>{{ number_format($inventory->price * $inventory->qty,2,".",",") }}</td>
                            <td>{{ number_format($inventory->qty) }}</td>
                            <td>{{ Illuminate\Support\Str::plural(ucwords($inventory->unit)) }}</td>
                            <td>{{ $inventory->status }}</td>
                            <td>{{ $inventory->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="border-bottom: 1px solid #ccc;">Item</th>
                            <th style="border-bottom: 1px solid #ccc;">Item Code</th>
                            <th style="border-bottom: 1px solid #ccc;">Value</th>
                            <th style="border-bottom: 1px solid #ccc;">Qty</th>
                            <th style="border-bottom: 1px solid #ccc;">Unit</th>
                            <th style="border-bottom: 1px solid #ccc;">Status</th>
                            <th style="border-bottom: 1px solid #ccc;">Date</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-account-layout>
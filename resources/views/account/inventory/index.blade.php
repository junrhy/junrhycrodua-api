@push('scripts')
<script>
$(document).ready(function(){
    const amountFormatter = new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'PHP'
    });

    var table = $('#inventoryTable').DataTable({
        layout: {
            topStart: {
                buttons: [
                    'pageLength', 
                    {
                        extend: 'collection',
                        text: 'Show columns',
                        buttons: [
                            {
                                text: 'Item Code',
                                action: function (e, dt, node, config) {
                                    var column = table.column(1);
                                    column.visible(!column.visible());
                                }
                            },
                            {
                                text: 'Inventory Value',
                                action: function (e, dt, node, config) {
                                    var column = table.column(5);
                                    column.visible(!column.visible());
                                }
                            },
                            {
                                text: 'Target Sales',
                                action: function (e, dt, node, config) {
                                    var column = table.column(6);
                                    column.visible(!column.visible());
                                }
                            },
                            {
                                text: 'Target Profit',
                                action: function (e, dt, node, config) {
                                    var column = table.column(7);
                                    column.visible(!column.visible());
                                }
                            },
                            {
                                text: 'TP %',
                                action: function (e, dt, node, config) {
                                    var column = table.column(8);
                                    column.visible(!column.visible());
                                }
                            },
                            {
                                text: 'Note',
                                action: function (e, dt, node, config) {
                                    var column = table.column(9);
                                    column.visible(!column.visible());
                                }
                            },
                        ]
                    },
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
                                    // table.row('.selected').remove().draw(false);
                                    location.reload();
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
            startRender: function (rows, group) {
                var totalQtyIn = 0;
                var totalQtyOut = 0;

                rows.data().each(function(item, index, arr){
                    if (arr[index][2] == "IN") {
                        totalQtyIn = +totalQtyIn + +arr[index][3].replace(/\,/g,'');
                    } else if (arr[index][2] == "OUT") {
                        totalQtyOut = +totalQtyOut + +arr[index][3].replace(/\,/g,'');
                    }
                    
                });

                var totalQty = totalQtyIn - totalQtyOut;

                return $('<tr/>').append('<td class="bg-secondary text-light fw-bold">\
                        <div class="row">\
                        <div class="col-md-2">' + rows.data().pluck(0)[0] + '</div>\
                        <div class="col-md-1">In Stock: ' + totalQty + '</div>\
                        </div>\
                    </td>');
            },
            endRender: function (rows, group) {
                var totalPurchaseValueIn = 0;
                var totalPurchaseValueOut = 0;
                var totalSellingValueIn = 0;
                var totalSellingValueOut = 0;
                var totalProfitMarginIn = 0;
                var totalProfitMarginOut = 0;
                var totalQtyIn = 0;
                var totalQtyOut = 0;

                rows.data().each(function(item, index, arr){
                    if (arr[index][2] == "IN") {
                        totalPurchaseValueIn = +totalPurchaseValueIn + +arr[index][5].replace(/\,/g,'');
                        totalSellingValueIn = +totalSellingValueIn + +arr[index][6].replace(/\,/g,'');
                        totalProfitMarginIn = +totalProfitMarginIn + +arr[index][7].replace(/\,/g,'');
                        totalQtyIn = +totalQtyIn + +arr[index][3].replace(/\,/g,'');
                    } else if (arr[index][2] == "OUT") {
                        totalPurchaseValueOut = +totalPurchaseValueOut + +arr[index][5].replace(/\,/g,'');
                        totalSellingValueOut = +totalSellingValueOut + +arr[index][6].replace(/\,/g,'');
                        totalProfitMarginOut = +totalProfitMarginOut + +arr[index][7].replace(/\,/g,'');
                        totalQtyOut = +totalQtyOut + +arr[index][3].replace(/\,/g,'');
                    }
                    
                });

                var totalPurchaseValue = totalPurchaseValueIn - totalPurchaseValueOut;
                var totalSellingValue = totalSellingValueIn - totalSellingValueOut;
                var totalProfitMargin = totalProfitMarginIn - totalProfitMarginOut;
                var totalQty = totalQtyIn - totalQtyOut;

                return $('<tr/>').append('<td class="bg-light" style="border-top: 1px solid #ccc;border-bottom: 1px dashed #ccc;text-align:right;">\
                        <strong>Total ' + rows.data().pluck(0)[0] + ' in stock: ' + totalQty.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '</strong><br>\
                        Total ' + rows.data().pluck(0)[0] + ' inventory value: ' + amountFormatter.format(totalPurchaseValue) + '<br>\
                        Total ' + rows.data().pluck(0)[0] + ' target sales: ' + amountFormatter.format(totalSellingValue) + '<br>\
                        Total ' + rows.data().pluck(0)[0] + ' target profit: ' + amountFormatter.format(totalProfitMargin) + '\
                    </td>');
            },
            dataSrc: 0
        },
        columnDefs: [
            {
                render: function (data, type, row) {
                    return amountFormatter.format(row[5]);
                },
                targets: [5]
            },
            {
                render: function (data, type, row) {
                    return amountFormatter.format(row[6]);
                },
                targets: [6]
            },
            {
                render: function (data, type, row) {
                    return amountFormatter.format(row[7]);
                },
                targets: [7]
            },
            {
                render: function (data, type, row) {
                    return row[8] + '%';
                },
                targets: [8]
            },
            {
                responsivePriority: 1,
                targets: [2,9,10]
            }
        ],
        initComplete: function () {
            this.api()
                .columns([0,1])
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
        if ($(this).hasClass('selected') || $(this).hasClass('dtrg-group')) {
            $(this).removeClass('selected');
        } else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $(function(){
        // hide columns on first load
        table.columns([1,5,6,7,8,9]).visible(false);
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
                <table id="inventoryTable" class="table table-sm table-striped table-bordered nowrap" style="width:100%;">
                    <thead class="table-dark">
                        <tr>
                            <th>Item</th>
                            <th>Item Code</th>
                            <th>Status</th>
                            <th>Qty</th>
                            <th>Unit</th>
                            <th>Inventory Value</th>
                            <th>Target Sales</th>
                            <th>Target Profit</th>
                            <th>TP %</th>
                            <th>Note</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventories as $inventory)
                        <tr id="{{ $inventory->id }}">
                            <td>{{ ucwords($inventory->name) }}</td>
                            <td><span style="font-size:10pt;">{{ strtoupper($inventory->item_code) }}</span></td>
                            <td>{{ $inventory->status }}</td>
                            <td>{{ number_format($inventory->qty) }}</td>
                            <td>{{ Illuminate\Support\Str::plural(ucwords($inventory->unit)) }}</td>
                            <td align="right">
                                {{ number_format($inventory->purchase_price * $inventory->qty,2,".",",") }}
                            </td>
                            <td align="right">
                                {{ number_format($inventory->selling_price * $inventory->qty,2,".",",") }}
                            </td>
                            <td align="right">
                                @if($inventory->selling_price != 0)
                                    {{ number_format(($inventory->selling_price * $inventory->qty) - ($inventory->purchase_price * $inventory->qty),2,".",",") }}
                                @else
                                0
                                @endif
                            </td>
                            <td>
                                <?php 
                                    $profitMargin = ($inventory->selling_price * $inventory->qty) - ($inventory->purchase_price * $inventory->qty);

                                    $profitMargin = $inventory->selling_price != 0 ? $profitMargin : 0;
                                    $inventoryValue = $inventory->purchase_price * $inventory->qty;
                                ?>
                                @if($inventory->selling_price != 0)
                                    {{ $inventoryValue / $profitMargin * 100 }}
                                @else
                                0
                                @endif
                            </td>
                            <td>{{ $inventory->note }}</td>
                            <td>{{ $inventory->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="border-bottom: 1px solid #ccc;">Item</th>
                            <th style="border-bottom: 1px solid #ccc;">Item Code</th>
                            <th style="border-bottom: 1px solid #ccc;">Status</th>
                            <th style="border-bottom: 1px solid #ccc;">Qty</th>
                            <th style="border-bottom: 1px solid #ccc;">Unit</th>
                            <th style="border-bottom: 1px solid #ccc;">Inventory Value</th>
                            <th style="border-bottom: 1px solid #ccc;">Target Sales</th>
                            <th style="border-bottom: 1px solid #ccc;">Target Profit</th>
                            <th style="border-bottom: 1px solid #ccc;">TP %</th>
                            <th style="border-bottom: 1px solid #ccc;">Note</th>
                            <th style="border-bottom: 1px solid #ccc;">Date</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-account-layout>
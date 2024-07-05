@push('scripts')
<script>
$(document).ready(function(){
    const amountFormatter = new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'PHP'
    });

    var table = $('#orderTable').DataTable({
        layout: {
            topStart: {
                buttons: [
                    'pageLength', 
                    {
                        text: 'New',
                        action: function (e, dt, node, config) {
                            location.href = window.location.origin + "/account/order/create";
                        }
                    },
                    {
                        text: 'Edit',
                        action: function (e, dt, node, config) {
                            let id = table.row('.selected').id();

                            if (id) {location.href = window.location.origin + "/account/order/"+id+"/edit";}
                        }
                    },
                    {
                        text: 'Delete',
                        action: function (e, dt, node, config) {
                            let id = table.row('.selected').id();

                            $.ajax({
                                type: "DELETE",
                                url: "/account/order/"+id,
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
                    {
                        extend: 'collection',
                        text: 'Options',
                        buttons: [
                            {
                                text: 'Show Completed',
                                attr: {id: 'showCompletedButton' },
                                action: function (e, dt, node, config) {
                                    $(".completed").toggleClass('d-none');

                                    if ($("#showCompletedButton").text() == "Hide Completed") {
                                        $("#showCompletedButton").text("Show Completed");
                                        return;
                                    }
                                    
                                    $("#showCompletedButton").text("Hide Completed");
                                }
                            },
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
        initComplete: function () {
            this.api()
                .columns([0])
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
        },
        rowCallback: function( row, data, index ) {
            if (data[4] == 'Completed') {
                $(row).addClass('completed d-none');
            }
        }
    });

    $('#orderTable tbody').on('click', 'tr', function () {
        if ($(this).hasClass('selected') || $(this).hasClass('dtrg-group')) {
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
            <div class="h1">Orders</div>
        </div>
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table id="orderTable" class="table table-sm table-striped table-bordered nowrap" style="width:100%;">
                    <thead class="table-dark">
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Source</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr id="{{ $order->id }}">
                            <td>{{ ucwords($order->name) }}</td>
                            <td>{{ ucwords(json_decode($order->properties)->qty) }}</td>
                            <td>{{ ucwords(json_decode($order->properties)->unit) }}</td>
                            <td>{{ ucwords(json_decode($order->properties)->price) }}</td>
                            <td>{{ ucwords($order->status) }}</td>
                            <td>{{ ucwords($order->type) }}</td>
                            <td>{{ ucwords($order->source) }}</td>
                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="border-bottom: 1px solid #ccc;">Item</th>
                            <th style="border-bottom: 1px solid #ccc;">Qty</th>
                            <th style="border-bottom: 1px solid #ccc;">Unit</th>
                            <th style="border-bottom: 1px solid #ccc;">Price</th>
                            <th style="border-bottom: 1px solid #ccc;">Status</th>
                            <th style="border-bottom: 1px solid #ccc;">Type</th>
                            <th style="border-bottom: 1px solid #ccc;">Source</th>
                            <th style="border-bottom: 1px solid #ccc;">Date</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-account-layout>
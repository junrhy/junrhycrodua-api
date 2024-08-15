@push('scripts')
<script>
$(document).ready(function(){
    const amountFormatter = new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'PHP'
    });

    var table = $('#saleTable').DataTable({
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
            if (data[7] == 'Completed') {
                $(row).addClass('completed d-none');
            }
        }
    });

    $('#saleTable tbody').on('click', 'tr', function () {
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
            <div class="h1">Sales</div>
        </div>
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table id="saleTable" class="table table-sm table-striped table-bsaleed nowrap" style="width:100%;">
                    <thead class="table-dark">
                        <tr>
                            <th>Item</th>
                            <th>Amount</th>
                            <th>Discount</th>
                            <th>Fees</th>
                            <th>Taxes</th>
                            <th>Payment Type</th>
                            <th>Payment Code</th>
                            <th>Status</th>
                            <th>Source</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                        <tr id="{{ $sale->id }}">
                            <td>{{ ucwords($sale->name) }}</td>
                            <td>{{ ucwords($sale->amount) }}</td>
                            <td>{{ ucwords($sale->discount) }}</td>
                            <td>{{ ucwords($sale->fees) }}</td>
                            <td>{{ ucwords($sale->tax) }}</td>
                            <td>{{ ucwords($sale->payment_type) }}</td>
                            <td>{{ ucwords($sale->payment_tracking_code) }}</td>
                            <td>{{ ucwords($sale->status) }}</td>
                            <td>{{ ucwords($sale->source) }}</td>
                            <td>{{ $sale->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="bsale-bottom: 1px solid #ccc;">Item</th>
                            <th style="bsale-bottom: 1px solid #ccc;">Amount</th>
                            <th style="bsale-bottom: 1px solid #ccc;">Discount</th>
                            <th style="bsale-bottom: 1px solid #ccc;">Fees</th>
                            <th style="bsale-bottom: 1px solid #ccc;">Taxes</th>
                            <th style="bsale-bottom: 1px solid #ccc;">Payment Type</th>
                            <th style="bsale-bottom: 1px solid #ccc;">Payment Code</th>
                            <th style="bsale-bottom: 1px solid #ccc;">Status</th>
                            <th style="bsale-bottom: 1px solid #ccc;">Source</th>
                            <th style="bsale-bottom: 1px solid #ccc;">Date</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-account-layout>
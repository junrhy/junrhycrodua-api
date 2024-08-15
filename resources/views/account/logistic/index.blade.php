@push('scripts')
<script>
$(document).ready(function(){
    const amountFormatter = new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'PHP'
    });

    var table = $('#logisticTable').DataTable({
        layout: {
            topStart: {
                buttons: [
                    'pageLength', 
                    {
                        text: 'New',
                        action: function (e, dt, node, config) {
                            location.href = window.location.origin + "/account/logistic/create";
                        }
                    },
                    {
                        text: 'Edit',
                        action: function (e, dt, node, config) {
                            let id = table.row('.selected').id();

                            if (id) {location.href = window.location.origin + "/account/logistic/"+id+"/edit";}
                        }
                    },
                    {
                        text: 'Delete',
                        action: function (e, dt, node, config) {
                            let id = table.row('.selected').id();

                            $.ajax({
                                type: "DELETE",
                                url: "/account/logistic/"+id,
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

    $('#logisticTable tbody').on('click', 'tr', function () {
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
            <div class="h1">Logistics</div>
        </div>
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table id="logisticTable" class="table table-sm table-striped table-blogisticed nowrap" style="width:100%;">
                    <thead class="table-dark">
                        <tr>
                            <th>Trip</th>
                            <th>Contact Person</th>
                            <th>Truck</th>
                            <th>Driver</th>
                            <th>Trailer</th>
                            <th>Distance</th>
                            <th>Weight</th>
                            <th>Pieces</th>
                            <th>Amount</th>
                            <th>Origin</th>
                            <th>Loaded Date</th>
                            <th>Pickup Date</th>
                            <th>Destination</th>
                            <th>Drop Date</th>
                            <th>Arrived Date</th>
                            <th>Unloaded Date</th>
                            <th>Journey</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logistics as $logistic)
                        <tr id="{{ $logistic->id }}">
                            <td>{{ ucwords($logistic->trip) }}</td>
                            <td>{{ ucwords($logistic->contact_person) }}</td>
                            <td>{{ ucwords($logistic->truck) }}</td>
                            <td>{{ ucwords($logistic->driver) }}</td>
                            <td>{{ ucwords($logistic->trailer) }}</td>
                            <td>{{ ucwords($logistic->distance) }}</td>
                            <td>{{ ucwords($logistic->weight) }}</td>
                            <td>{{ ucwords($logistic->pieces) }}</td>
                            <td>{{ ucwords($logistic->amount) }}</td>
                            <td>{{ ucwords($logistic->origin) }}</td>
                            <td>{{ ucwords($logistic->loaded_at) }}</td>
                            <td>{{ ucwords($logistic->pickup_at) }}</td>
                            <td>{{ ucwords($logistic->destination) }}</td>
                            <td>{{ ucwords($logistic->drop_at) }}</td>
                            <td>{{ ucwords($logistic->arrived_at) }}</td>
                            <td>{{ ucwords($logistic->unloaded_at) }}</td>
                            <td>{{ ucwords($logistic->journey) }}</td>
                            <td>{{ ucwords($logistic->status) }}</td>
                            <td>{{ $logistic->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="blogistic-bottom: 1px solid #ccc;">Trip</th>
                            <th style="blogistic-bottom: 1px solid #ccc;">Contact Person</th>
                            <th style="blogistic-bottom: 1px solid #ccc;">Truck</th>
                            <th style="blogistic-bottom: 1px solid #ccc;">Driver</th>
                            <th style="blogistic-bottom: 1px solid #ccc;">Trailer</th>
                            <th style="blogistic-bottom: 1px solid #ccc;">Distance</th>
                            <th style="blogistic-bottom: 1px solid #ccc;">Weight</th>
                            <th style="blogistic-bottom: 1px solid #ccc;">Pieces</th>
                            <th style="blogistic-bottom: 1px solid #ccc;">Amount</th>
                            <th style="blogistic-bottom: 1px solid #ccc;">Origin</th>
                            <th style="blogistic-bottom: 1px solid #ccc;">Loaded Date</th>
                            <th style="blogistic-bottom: 1px solid #ccc;">Pickup Date</th>
                            <th style="blogistic-bottom: 1px solid #ccc;">Destination</th>
                            <th style="blogistic-bottom: 1px solid #ccc;">Drop Date</th>
                            <th style="blogistic-bottom: 1px solid #ccc;">Arrived Date</th>
                            <th style="blogistic-bottom: 1px solid #ccc;">Unloaded Date</th>
                            <th style="blogistic-bottom: 1px solid #ccc;">Journey</th>
                            <th style="blogistic-bottom: 1px solid #ccc;">Status</th>
                            <th style="blogistic-bottom: 1px solid #ccc;">Date</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-account-layout>
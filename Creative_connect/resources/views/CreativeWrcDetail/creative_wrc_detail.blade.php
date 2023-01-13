
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<div class="wrc-cc-content table-responsive" >
    <table class="table table-head-fixed edt-table text-nowrap m-0" id="">
        {{-- <thead>
            <tr>
                <th class="align-middle">Sr</th>
                <th class="align-middle">Company</th>
                <th class="align-middle">Brand Name</th>
                <th class="align-middle">Sample Inward Date</th>
                <th class="align-middle">Sample Inward Month</th>
                <th class="align-middle">Ageing</th>
                <th class="align-middle">LOT No</th>
                <th class="align-middle">LOT Inward Quantity</th>
                <th class="align-middle">WRC No</th>
                <th class="align-middle">WRC Count</th>
                <th class="align-middle">WRC Inward Quantity</th>
                <th class="align-middle">WRC Pending At</th>
                <th class="align-middle">Client ID</th>
                <th class="align-middle">Location</th>
                <th class="align-middle">Vertical Type</th>
                <th class="align-middle">Client Bucket</th>
                <th class="align-middle">Shoot Hand Over Date</th>
                <th class="align-middle">Gender</th>
                <th class="align-middle">Spoc Email</th>
                <th class="align-middle">Type Of Shoot</th>
                <th class="align-middle">Type Of Clothing</th>
                <th class="align-middle">Shoot Guideline</th>
                <th class="align-middle">Adaptation 1</th>
                <th class="align-middle">Adaptation 2</th>
                <th class="align-middle">Adaptation 3</th>
                <th class="align-middle">Adaptation 4</th>
                <th class="align-middle">PPT Approval Date</th>
                <th class="align-middle">Model Approval Date</th>
                <th class="align-middle">Inward Sheet Date</th>
                <th class="align-middle">Special Approval Date</th>
                <th class="align-middle">Model Available Date</th>
                <th class="align-middle">Lot size</th>
                <th class="align-middle">TAT Start Date</th>
                <th class="align-middle">TAT Ageing</th>
                <th class="align-middle">TAT End Date</th>
                <th class="align-middle">TAT Status</th>
                <th class="align-middle">Internal FTA</th>
                <th class="align-middle">External FTA</th>
                <th class="align-middle">Planning Date</th>
                <th class="align-middle">Shoot Month</th>
                <th class="align-middle">Shoot Date</th>
                <th class="align-middle">Internal Rejections</th>
                <th class="align-middle">Editing/QC Rejections</th>
                <th class="align-middle">Client Rejection</th>
                <th class="align-middle">SKU shoot pending</th>
                <th class="align-middle">SKU shoot done</th>
                <th class="align-middle">Wrc Status</th>
                <th class="align-middle">Submission Date</th>
                <th class="align-middle">Submission Qty</th>
                <th class="align-middle">Shift</th>
                <th class="align-middle">Studio</th>
                <th class="align-middle">Model</th>
                <th class="align-middle">Agency</th>
                <th class="align-middle">Photographer</th>
                <th class="align-middle">Makeup</th>
                <th class="align-middle">Stylist</th>
                <th class="align-middle">Assistant</th>
                <th class="align-middle">Invoice Number</th>
                <th class="align-middle">Photographer Commercial</th>
                <th class="align-middle">Model Commercial</th>
                <th class="align-middle">Extra Model Charges</th>
                <th class="align-middle">Makeup Commercial</th>
                <th class="align-middle">Stylist Commercial</th>
                <th class="align-middle">Assistant Commercial</th>
                <th class="align-middle">Per SKU Commercial</th>
                <th class="align-middle">Expected Commercial</th>
                <th class="align-middle">Actual Commercial</th>
            </tr>
        </thead> --}}
        <thead>
            <tr>
                <th>WRC For Timesheet</th>
                <th>Lot No</th>
                <th>WRC	Client ID</th>
                <th>Company</th>
                <th>Client Bucket</th>
                <th>SPOC</th>
                <th>Project Name</th>
                <th>Kind of Work</th>
                <th>Work Initiate Date</th>
                <th>Committed Date</th>
                <th>Committed Date</th>
                <th>Task Type</th>
                <th>Order QTY</th>
                <th>Number Delivered</th>
                <th>Submission Date</th>
                <th>Invoice Number</th>
                <th>Payment received on</th>
                <th>Per Qty Rate</th>
                <th>Total Value</th>
                <th>Month</th>
                <th>FTA</th>
                <th>TAT Status</th>
                <th>Ageing</th>
                <th>Lot Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($getCreativeWrcDetails as $data)
                <tr>
                    <td class="align-middle td-data index-tddata">{{$data['id']}}</td>
                    <td class="align-middle td-data">{{$data['lot_number']}}</td>
                    <td class="align-middle td-data">{{$data['user_id']}}</td>
                    <td class="align-middle td-data">{{$data['Company_name']}}</td>
                    <td class="align-middle td-data">{{$data['client_bucket']}}</td>
                    <td class="align-middle td-data">-----</td>
                    <td class="align-middle td-data">ODN12012023-SKDDES3799</td>
                    <td class="align-middle td-data">33</td>
                    <td class="align-middle td-data">SKDDES3799-B</td>
                    <td class="align-middle td-data">2</td>
                    <td class="align-middle td-data">6</td>
                    <td class="align-middle td-data">Planning Pending</td>
                    <td class="align-middle td-data">Not Yet Generat</td>
                    <td class="align-middle td-data">Delhi</td>
                    <td class="align-middle td-data">New Shoot</td>
                    <td class="align-middle td-data">Existing</td>
                    <td class="align-middle td-data"></td>
                    <td class="align-middle td-data">Female</td>
                    <td class="align-middle td-data">anshuman.g@odndigital.com </td>
                    <td class="align-middle td-data">Not Planned</td>
                    <td class="align-middle td-data">Not Planned</td>
                    <td class="align-middle td-data">No Information</td>
                    <td class="align-middle td-data">No Information</td>
                    <td class="align-middle td-data">No Information</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

 <script src="https://code.jquery.com/jquery-3.5.1.js" type="application/javascript" ></script>
 <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" type="application/javascript" ></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js" type="application/javascript" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript" ></script>
      <script  src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js" type="text/javascript"></script>
<script type="text/javascript">
   $(document).ready(function() {
    $('#masterData').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );

</script>

@extends('layouts.admin')

@section('title')

Creative Qc Panel

@endsection
@section('content')

<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

<div class="container-fluid mt-5 plan-shoot">
    <div class="row">
        <div class="col-12">
            <div class="card card-transparent">
                <div class="card-header">
                    <h3 class="card-title" style="font-size: 2rem;">QC Approval - Creative</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="max-height: 700px; height: 100%;">
                    <table id="qaTableCrt" class="table table-head-fixed text-nowrap data-table">
                        <thead>
                            <tr>
                                <th class="align-middle">WRC Number</th>
                                <th class="align-middle">Brand Name</th>
                                <th class="align-middle">Order Qty</th>
                                <th class="align-middle">Creative</th>
                                <th class="align-middle">Copy</th>
                                <th class="align-middle">Status</th>
                                <th class="align-middle">Commented</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($QcList as $qc)
                            <tr>
                                <td>{{$qc['wrc_id']}}</td>
                                <td>Titan</td>
                                <td>4</td>
                                <td>
                                    <a href="javascript:;" class="cpy-textVal" id="creativetextVal">
                                        www.benetton.com
                                        <span><i class="fas fa-copy"></i></span>
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:;" class="cpy-textVal" id="copytextVal">
                                        www.mns.com
                                        <span><i class="fas fa-copy"></i></span>
                                    </a>
                                </td>
                                <td>
                                    <div class="d-inline-block">
                                        <input data-id="{{$sku['sku_id']}}" type="checkbox" checked data-toggle="toggle" data-on="Submitted" data-off="Pending" data-onstyle="success" data-offstyle="warning" data-size="sm" data-width="100" class="toggle-class"   {{ $sku['qc'] ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-inline-block mt-1">
                                        <a href="javascript:;" class="btn btn-default py-1 mt-1" data-toggle="modal" data-target="#creativeCommnentModal"><i class="fas fa-comment mr-1"></i>Comment</a>
                                    </div>
                                </td>
                            </tr>  
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="creativeCommnentModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h4 class="modal-title">Comments</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="comment-form">
                        <div class="form-group">
                            <label class="control-label required">Category</label>
                            <div class="group-inner">
                                <div class="radio-col">
                                    <span class="checkVal">
                                        Creative
                                    </span>
                                    <input type="radio" name="crCheck" id="check1" class="radio-check">
                                </div>
                                <div class="radio-col">
                                    <span class="checkVal">
                                        Copy
                                    </span>
                                    <input type="radio" name="crCheck" id="check2" class="radio-check">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Add a comment</label>
                            <textarea class="form-control" rows="4" name="commentsec" id="commentsec" placeholder="Enter your comment..."></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-warning">Comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

<script>
    $(document).on('click', '.cpy-textVal', function () {
        var ValC = $(this).text().trim();

        var nwArray = [[`${ValC}`]];

        navigator.clipboard.writeText(nwArray).then(() => {
            $('.copy-msg').fadeIn(250);
            setTimeout(function () {
                $('.copy-msg').fadeOut(250);
            }, 1000);
        })
        .catch((err) => {
            alert("Error in copying text: ", err);
        });
    });

    $('#qaTableCrt').DataTable({
        dom: 'lBfrtip',
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        "buttons": ["copy", "csv", "excel", "pdf"]
    }).buttons().container().insertAfter('#masterData_wrapper .dataTables_length');

</script>
@endsection

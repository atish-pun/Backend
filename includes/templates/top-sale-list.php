<div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
        <!-- Title And Navigation -->
        <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Top Sale List</h3>
        </div>
        <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="?page=top-sale-list">Top Sale List</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="table" class="stripe" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Product Category</th>
                                    <th>Product Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--CSS & SCRIPT-->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        const table = $('#table').DataTable({
            ajax: { "url": "post/top-sale-list.php", "type": "POST" }, lengthMenu: [ [25, 50, 100, -1], [25, 50, 100, "All"] ],
            columns: [ { data: 'sn' }, { data: 'pc_name' }, { data:'pname' }, { data: 'topsalestat' }, { data:'action' } ],
            loading: true
        });

        $("#table").on('click', '.activate', function(){
            swal({ title: "Warning", text: "Are you sure want to activate this item top sale?", icon: "info", buttons: true})
            .then((ok) => {
                if (ok) {
                    var id = $(this).data('id');
                    var loading = $("#table").loading({message: "processing.."});
                    $.ajax({
                        url:"post/top-sale-activate.php", method:"POST", data: {id:id},
                        success:function(data){
                            if(data.status == 200){ table.ajax.reload(); swal("Info", data.content, "success"); }
                            else{ swal("Error", data.content, "error"); }
                            loading.loading("stop");
                        },
                        error:function(data){
                            loading.loading("stop");
                        }
                    });
                }
            });
        });

        $("#table").on('click', '.deactivate', function(){
            swal({ title: "Warning", text: "Are you sure want to deactivate this item top sale?", icon: "warning", buttons: true})
            .then((ok) => {
                if (ok) {
                    var id = $(this).data('id');
                    var loading = $("#table").loading({message: "processing.."});
                    $.ajax({
                        url:"post/top-sale-deactivate.php", method:"POST", data: {id:id},
                        success:function(data){
                            if(data.status == 200){ table.ajax.reload(); swal("Info", data.content, "success"); }
                            else{ swal("Error", data.content, "error"); }
                            loading.loading("stop");
                        },
                        error:function(data){
                            loading.loading("stop");
                        }
                    });
                }
            });
        });
    });
</script>
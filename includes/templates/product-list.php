<div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
        <!-- Title And Navigation -->
        <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Product List</h3>
        </div>
        <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="?page=product-list">Product List</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <div class="row">
            <div class="col-12">
                <a href="?page=product-add" class="btn btn-primary btn-min-width mr-1 mb-1"><i class="la la-plus-circle"></i> Add New Product</a>
                <div class="card">
                    <div class="card-body">
                        <table id="table" class="stripe" style="width:100%">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Product Category</th>
                                    <th>Product Name</th>
                                    <th>Image</th>
                                    <th>Price (Rs.)</th>
                                    <th>Unit</th>
                                    <th>Created At</th>
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
            ajax: { "url": "post/product-list.php", "type": "POST" }, lengthMenu: [ [25, 50, 100, -1], [25, 50, 100, "All"] ],
            columns: [ { data: 'sn' }, { data: 'pc_name' }, {data:'pname'}, { data: 'p_ipath' }, { data: 'price' }, { data: 'unit' },  {data:'p_cat'}, {data:'action'} ],
            columnDefs: [ { width: 80, targets: 0 },{ width: 250, targets: 1 },{ width: 250, targets: 2 },{ width: 250, targets: 3 },{ width: 150, targets: 4 } ,{ width: 150, targets: 5 },{ width: 150, targets: 6 } ,{ width: 150, targets: 7 } ],
            loading: true, scrollX:true
        });

        $("#table").on('click', '.remove', function(){
            swal({ title: "Warning", text: "Are you sure want to remove this item from list?", icon: "warning", buttons: true, dangerMode: true })
            .then((willDelete) => {
                if (willDelete) {
                    var id = $(this).data('id');
                    var loading = $("#table").loading({message: "removing.."});
                    $.ajax({
                        url:"post/product-remove.php", method:"POST", data: {id:id},
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
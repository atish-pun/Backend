<div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
        <!-- Title And Navigation -->
        <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Product Order List</h3>
        </div>
        <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="#">Product Order List</a></li>
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
                        <table id="table" class="stripe">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Order ID</th>
                                    <th>Order Token</th>
                                    <th>Order By</th>
                                    
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Rate</th>
                                    <th>Total</th>
                                    
                                    <th>Payment Method</th>
                                    <th>Paid Status</th>
                                    
                                    <th>Order Status</th>
                                    <th>Ordered Date</th>
                                    <th>Approved Date</th>
                                    <th>Shipping Date</th>
                                    <th>Delivered Date</th>

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
            ajax: { "url": "post/product-order-list.php", "type": "POST" }, lengthMenu: [ [25, 50, 100, -1], [25, 50, 100, "All"] ],
            columns: [ 
                { data: 'sn' }, { data: 'id' }, { data: 'token' }, { data: 'fullname' }, 
                { data: 'pname' }, { data: 'qty' }, { data: 'rate' }, { data: 'total' },
                { data: 'payment_method' }, { data: 'paid' }, 
                { data: 'order_status' }, { data: 'order_date' }, { data: 'approved_date' }, { data: 'shipping_date' }, { data: 'delivered_date' }, 
                { data: 'action' }, 
            ],
            columnDefs: [ 
                { width: 80, targets: 0 }, { width: 80, targets: 1 }, { width: 250, targets: 2 }, { width: 250, targets: 3 }, 
                { width: 180, targets: 4 }, { width: 80, targets: 5 }, { width: 80, targets: 6 },  { width: 80, targets: 7 }, 
                { width: 180, targets: 8 }, { width: 180, targets: 9 }, 
                { width: 180, targets: 10 }, { width: 180, targets: 11 }, { width: 180, targets: 12 }, { width: 180, targets: 13 }, { width: 180, targets: 14 }, 
                { width: 900, targets: 15 }, 
            ],
            loading: true, scrollX:true
        });

        $("#table").on("click", ".approved", function(){
            swal({ title: "Warning", text: "Are you sure want to marked this order as approved?", icon: "info", buttons: true })
            .then((yes) => {
                if (yes) {
                    var id = $(this).data('id');
                    console.log(id);
                    var loading = $("#table").loading({message: "updating.."});
                    $.ajax({
                        url:"post/product-order-transaction-approved.php", method:"POST", data: {id:id},
                        success:function(data){
                            if(data.status == 200){ table.ajax.reload(); swal("Info", data.content, "success"); }
                            else{ swal("Error", data.content, "error"); }
                            loading.loading("stop");
                        },
                        error:function(data){ loading.loading("stop"); }
                    });
                }
            });
        });

        $("#table").on("click", ".shipped", function(){
            swal({ title: "Warning", text: "Are you sure want to marked this order as shipped?", icon: "info", buttons: true })
            .then((yes) => {
                if (yes) {
                    var id = $(this).data('id');
                    console.log(id);
                    var loading = $("#table").loading({message: "updating.."});
                    $.ajax({
                        url:"post/product-order-transaction-shipped.php", method:"POST", data: {id:id},
                        success:function(data){
                            if(data.status == 200){ table.ajax.reload(); swal("Info", data.content, "success"); }
                            else{ swal("Error", data.content, "error"); }
                            loading.loading("stop");
                        },
                        error:function(data){ loading.loading("stop"); }
                    });
                }
            });
        });

        $("#table").on("click", ".delivered", function(){
            swal({ title: "Warning", text: "Are you sure want to marked this order as delivered?", icon: "info", buttons: true })
            .then((yes) => {
                if (yes) {
                    var id = $(this).data('id');
                    console.log(id);
                    var loading = $("#table").loading({message: "updating.."});
                    $.ajax({
                        url:"post/product-order-transaction-delivered.php", method:"POST", data: {id:id},
                        success:function(data){
                            if(data.status == 200){ table.ajax.reload(); swal("Info", data.content, "success"); }
                            else{ swal("Error", data.content, "error"); }
                            loading.loading("stop");
                        },
                        error:function(data){ loading.loading("stop"); }
                    });
                }
            });
        });

        $("#table").on("click", ".cancel", function(){
            swal({ title: "Warning", text: "Are you sure want to cancel this order?", icon: "warning", buttons: true, dangerMode: true })
            .then((yes) => {
                if (yes) {
                    var id = $(this).data('id');
                    console.log(id);
                    var loading = $("#table").loading({message: "updating.."});
                    $.ajax({
                        url:"post/product-order-transaction-cancel.php", method:"POST", data: {id:id},
                        success:function(data){
                            if(data.status == 200){ table.ajax.reload(); swal("Info", data.content, "success"); }
                            else{ swal("Error", data.content, "error"); }
                            loading.loading("stop");
                        },
                        error:function(data){ loading.loading("stop"); }
                    });
                }
            });
        });

        $("#table").on("click", ".closetransaction", function(){
            swal({ title: "Warning", text: "Are you sure want to close this transaction from order list?", icon: "warning", buttons: true, dangerMode: true })
            .then((yes) => {
                if (yes) {
                    var id = $(this).data('id');
                    console.log(id);
                    var loading = $("#table").loading({message: "updating.."});
                    $.ajax({
                        url:"post/product-order-transaction-closetransaction.php", method:"POST", data: {id:id},
                        success:function(data){
                            if(data.status == 200){ table.ajax.reload(); swal("Info", data.content, "success"); }
                            else{ swal("Error", data.content, "error"); }
                            loading.loading("stop");
                        },
                        error:function(data){ loading.loading("stop"); }
                    });
                }
            });
        });

        $("#table").on("click", ".paid", function(){
            swal({ title: "Warning", text: "Are you sure want to make transaction to paid?", icon: "info", buttons: true })
            .then((yes) => {
                if (yes) {
                    var id = $(this).data('id');
                    console.log(id);
                    var loading = $("#table").loading({message: "updating.."});
                    $.ajax({
                        url:"post/product-order-transaction-paid.php", method:"POST", data: {id:id},
                        success:function(data){
                            if(data.status == 200){ table.ajax.reload(); swal("Info", data.content, "success"); }
                            else{ swal("Error", data.content, "error"); }
                            loading.loading("stop");
                        },
                        error:function(data){ loading.loading("stop"); }
                    });
                }
            });
        });
    });
</script>
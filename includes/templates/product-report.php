<div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
        <!-- Title And Navigation -->
        <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title">Product Report</h3>
        </div>
        <div class="content-header-right col-md-8 col-12">
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="#">Product Report</a></li>
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
                                    <th>Order By</th>
                                    <th>Product Name</th>
                                    <th>Order Status</th>
                                    <th>Payment Method</th>
                                    <th>Rate</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfooter>
                                <tr>
                                    <td colspan="8" align="right">Total: <span style="font-weight:800;" id="gtotal">Rs. 0.00/-</span></td>
                                </tr>
                            </tfooter>
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
            ajax: { "url": "post/product-report.php", "type": "POST" }, lengthMenu: [ [25, 50, 100, -1], [25, 50, 100, "All"] ],
            columns: [ { data: 'sn' }, { data: 'fullname' }, { data: 'pname' },  { data: 'ostatus' }, { data: 'payment_method' }, { data: 'rate' } ,{ data: 'qty' }, { data: 'total' } ],
            loading: true
        });

        table.on("xhr", function(e, settings, json, xhr){ 
            console.log(json.gtotal);
            $("#gtotal").html(json.gtotal);
            table.off("xhr");
        });
    });
</script>
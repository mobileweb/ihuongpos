<?php include('includes/head.php'); ?>
<?php include('includes/header.php'); ?>

<div class="container-fluid">
    <div class="row">
        <?php include('includes/leftNavigation.php'); ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Price Check</h1>

            <div class="row placeholders">
                <form id="searchForm" name="searchForm">
                    <input autofocus name ="searchText" type="text" id="searchText" placeholder="Enter PRODUCT NAME or BARCODE for search..." class="form-control">
                </form>
            </div>

            <h2 class="sub-header">Products</h2>
            <div class="table-responsive">
                <table id="productTable" class="table table-striped">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php include('includes/footer.php'); ?>

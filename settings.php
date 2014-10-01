<?php include('includes/head.php'); ?>
<?php include('includes/header.php'); ?>
<?php

    $title = "Settings";
    $APIKey = "7798XS4HWRIEG9FHI0ZBR6RBC3G6IPFQ";
?>
<div class="container-fluid">
    <div class="row">
        <?php include('includes/leftNavigation.php'); ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header"><?php echo $title ?></h1>

            <div class="row placeholders">
                <form id="settingForm" name="settingForm" role="form">
                    <input value="<?php echo $APIKey?>" id="APIKey" name="APIKey" type="text" class="form-control" placeholder="API Key" required autofocus><br/>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
                </form>
            </div>
        </div>

    </div>
</div>

<?php include('includes/footer.php'); ?>

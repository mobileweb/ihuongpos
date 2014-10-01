<?php include('includes/head.php'); ?>
<?php include('includes/header.php'); ?>
<?php

    $title = "Settings";

    $config = simplexml_load_file("xml/config.xml");

    if (isset($_POST['APIKey'])) {
        try {
            $newAPIKey = $_POST['APIKey'];
            $config->key = $newAPIKey;
            $config->asXML("xml/config.xml");
            $_SESSION['setting_ok']='Settings have been saved successfully.';
        } catch (Exception $ex) {
            $_SESSION['setting_error']='Save error.';
        }
    }

    $APIKey = $config->key;
?>
<div class="container-fluid">
    <div class="row">
        <?php include('includes/leftNavigation.php'); ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header"><?php echo $title ?></h1>

            <div class="row">
                <?php echo (isset($_SESSION['setting_ok'])?'<span style="color:green">'.$_SESSION['setting_ok'].'</span>':null);?>
                <?php echo (isset($_SESSION['setting_error'])?'<span style="color:red">'.$_SESSION['setting_error'].'</span>':null);?>
                <form id="settingForm" name="settingForm" role="form" method="post">
                    <h4>API Key</h4>
                    <input value="<?php echo $APIKey?>" id="APIKey" name="APIKey" type="text" class="form-control" placeholder="API Key" required autofocus><br/>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
                </form>
            </div>
        </div>

    </div>
</div>

<?php include('includes/footer.php'); ?>
<?php
    unset($_SESSION['setting_error']);
    unset($_SESSION['setting_ok']);
?>

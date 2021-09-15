<?php

$config = new \Config\KeysConfig();
include('header/nav.php');
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
        height: 700px;
        width: 100%;
    }

    .checked {
        color: orange;
    }
</style>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div id="map"></div>
            </div>
        </div>
    </div>
    <?php include('footer/footer.php'); ?>>


    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $config->tempKey ?>">
    </script>
    <script>
        let site_url = '<?php echo base_url()?>';

        $(document).ready(function () {
            mapInitialize();
        });
    </script>
    <script src="<?php echo base_url('assets/js/map.js') ?>"></script>
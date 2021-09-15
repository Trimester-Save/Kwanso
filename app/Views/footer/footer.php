<footer class="footer">
    <div class="container-fluid clearfix">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyrights © <?php echo date("Y"); ?>. All rights reserved Kwanso.</span>

    </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!--<div class="modal"></div>-->
<script>
    /*    $('.pageloader')
        .ajaxStart(function(){
            $body.addClass("loading");
        })
        .ajaxStop(function(){
            $body.removeClass("loading");
        });
      */
</script>
<!-- plugins:js -->

<script src="<?php echo base_url('assets/node/popper.js/dist/umd/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/node/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/node/bootstrap/dist/js/locationpicker.jquery.js'); ?>"></script>


<!-- endinject -->
<!-- Plugin js for this page-->
<script src="<?php echo base_url('assets/node/chart.js/dist/Chart.min.js'); ?>"></script>

<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="<?php echo base_url('assets/js/off-canvas.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/misc.js'); ?>"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="<?php echo base_url('assets/js/dashboard.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/jquery-ui.js') ?>"></script>


<script type="text/javascript">
    $(document).ready(function () {

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                //      var location = "Your current position is (" + "Latitude: " + position.coords.latitude + ", " + "Longitude: " + position.coords.longitude + ")";
                $('#us2').locationpicker({
                    location: {latitude: latitude, longitude: longitude},
                    radius: 300,
                    inputBinding: {
                        latitudeInput: $('#us2-lat'),
                        longitudeInput: $('#us2-lon'),
                        radiusInput: $('#us2-radius'),
                        locationNameInput: $('#us2-address'),
                    }
                });
            });
        }
    });
</script>
</body>

</html>
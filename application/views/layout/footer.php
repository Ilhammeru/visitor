<script>
    function addZero(data) {

        if (data.toString().length == 1) {

            var newData = '0' + data;

        } else {

            var newData = data;

        }

        return newData;

    }
</script>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="<?= base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url(); ?>assets/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/jquery-ui/jquery-ui.js"></script>
<script src="<?= base_url(); ?>/assets/datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?= base_url(); ?>/assets/daterangepicker/moment.min.js"></script>
<script src="<?= base_url(); ?>/assets/daterangepicker/daterangepicker.js"></script>
<script src="<?= base_url(); ?>/assets/select2/dist/js/select2.min.js"></script>


<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>
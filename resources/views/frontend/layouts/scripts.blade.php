<script>
    /**
     * --------------------------------------------------------------------------
     *Third party plugin initialization
     * --------------------------------------------------------------------------
     */
    // Create an instance of Notyf
    var notyf = new Notyf();


    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });

    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

    /**
     * --------------------------------------------------------------------------
     *Third party plugin initialization
     * --------------------------------------------------------------------------
     */

    function showLoader() {
        $('.preloader_demo').removeClass('d-none');
    }

    function hideLoader() {
        $('.preloader_demo').addClass('d-none');
    }
</script>

<script>
    /**
     * --------------------------------------------------------------------------
     *Third party plugin initialization
     * --------------------------------------------------------------------------
     */
    // Create an instance of Notyf
    var notyf = new Notyf();


    $(document).ready(function() {

        // Datepicker
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });

        // Year picker
        $('.yearpicker').datepicker({
            format: 'yyyy',
            viewMode: "years",
            minViewMode: "years",
            autoclose: true,
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

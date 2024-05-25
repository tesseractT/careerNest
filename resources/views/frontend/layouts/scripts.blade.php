<script>
    /**
     * --------------------------------------------------------------------------
     *Third party plugin initialization
     * --------------------------------------------------------------------------
     */
    // Create an instance of Notyf
    var notyf = new Notyf({
        duration: 4000,
        position: {
            x: 'right',
            y: 'top',
        }
    });


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


    // Delete Experience
    $('body').on('click', '.delete-item', function(event) {
        event.preventDefault();
        let url = $(this).attr('href');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'DELETE',
                    url: url,
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr);
                        notyf.error(xhr.responseJSON.message);
                        hideLoader();
                    }
                })
            }
        });
    })
</script>

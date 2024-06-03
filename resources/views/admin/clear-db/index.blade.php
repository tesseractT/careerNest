@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Clear Database</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Clear Database</h4>


                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning alert-has-icon">
                            <div class="alert-icon">
                                <i class="far fa-question-circle"></i>
                            </div>
                            <div class="alert-body">
                                <div class="alert-title">Warning</div>
                                <p>
                                    This action will delete all the data from the database. Are you sure you want to
                                    proceed?
                                </p>
                            </div>
                            <form action="" class="mt-2 clear_db" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger submit_button">Clear Database</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.clear_db').on('submit', function(e) {
                e.preventDefault();

                swal({
                    title: 'Are you sure?',
                    text: 'Remember, this action will delete all the data from the database!',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            method: 'POST',
                            url: "{{ route('admin.clear-database.clear') }}",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            beforeSend: function() {
                                swal('Clearing Database... Please do not refresh page', {
                                    icon: 'info',
                                    buttons: false,
                                    closeOnClickOutside: false,
                                });
                                $('.submit_button').attr('disabled', true);
                                $('.submit_button').html('Clearing Database...');
                            },
                            success: function(response) {
                                swal(response.message, {
                                    icon: 'success',
                                    
                                });

                                window.location.reload();
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr);
                                swal(xhr.responseJSON.message, {
                                    icon: 'success',
                                });
                            }

                        });

                    } else {
                        swal('Your data is safe!');
                    }
                });
            })
        })
    </script>
@endpush

@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Management Events'])

<meta name="csrf_token" content="{{ csrf_token() }}">

<div class="container-fluid py-3">
    <div class="row">
        <div class="col-md-12">
            @if(session('success'))
            <div id="success-alert" class="alert alert-success alert-dismissible fade show text-white" role="alert">
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <span class="alert-text"><strong>{{ session('success') }}</strong></span>
                <button type="button" class="btn-close pt-3" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <script>
            // Membuat fungsi untuk menyembunyikan alert setelah 2 detik
            setTimeout(function() {
                document.getElementById('success-alert').style.display = 'none';
            }, 2000);
            </script>
            @endif
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                    <div id="modal-action" class="modal" tabindex="-1"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
    integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.7/index.global.min.js'></script>

<!-- Tambahkan sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
const modal = $('#modal-action')
const csrfToken = $('meta[name=csrf_token]').attr('content')
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: `{{ route('events.list') }}`,
        editable: true,
        dateClick: function(info) {
            $.ajax({
                url: `{{ route('events.create') }}`,
                data: {
                    start_date: info.dateStr,
                    end_date: info.dateStr
                },
                success: function(res) {
                    modal.html(res).modal('show')
                    $('.datepicker').datepicker({
                        todayHighlight: true,
                        format: 'yyyy-mm-dd'
                    });

                    $('#form-action').on('submit', function(e) {
                        e.preventDefault()
                        const form = this
                        const formData = new FormData(form)
                        $.ajax({
                            url: form.action,
                            method: form.method,
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(res) {
                                modal.modal('hide')
                                calendar.refetchEvents()
                            },
                            error: function(res) {

                            }
                        })
                    })
                }
            })
        },
        eventClick: function({
            event
        }) {
            $.ajax({
                url: `{{ url('events') }}/${event.id}/edit`,
                success: function(res) {
                    modal.html(res).modal('show')

                    $('#form-action').on('submit', function(e) {
                        e.preventDefault()
                        const form = this
                        const formData = new FormData(form)
                        $.ajax({
                            url: form.action,
                            method: form.method,
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(res) {
                                modal.modal('hide')
                                calendar.refetchEvents()
                            }
                        })
                    })
                }
            })
        },
        eventDrop: function(info) {
            const event = info.event
            $.ajax({
                url: `{{ url('events') }}/${event.id}`,
                method: 'put',
                data: {
                    id: event.id,
                    start_date: event.startStr,
                    end_date: event.end.toISOString().substring(0, 10),
                    title: event.title,
                    category: event.extendedProps.category
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    accept: 'application/json'
                },
                success: function(res) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Data berhasil diperbarui!',
                        position: 'topRight'
                    });
                },
                error: function(res) {
                    const message = res.responseJSON.message
                    info.revert()
                    iziToast.error({
                        title: 'Error',
                        message: message ?? 'Something wrong',
                        position: 'topRight'
                    });
                }
            })
        },
        eventResize: function(info) {
            const {
                event
            } = info
            $.ajax({
                url: `{{ url('events') }}/${event.id}`,
                method: 'put',
                data: {
                    id: event.id,
                    start_date: event.startStr,
                    end_date: event.end.toISOString().substring(0, 10),
                    title: event.title,
                    category: event.extendedProps.category
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    accept: 'application/json'
                },
                success: function(res) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Data berhasil diperbarui!',
                        position: 'topRight'
                    });
                },
                error: function(res) {
                    const message = res.responseJSON.message
                    info.revert()
                    iziToast.error({
                        title: 'Error',
                        message: message ?? 'Something wrong',
                        position: 'topRight'
                    });
                }
            })
        }
    });
    calendar.render();
});
</script>

@endsection

@extends('layouts.main')

@section('title', 'Welcome')

@section('content')
    <div class="container">
        
        @include('components.info')

        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">To</th>
                <th scope="col">Subject</th>
                <th scope="col">% Spam</th>
                <th scope="col">Sent in</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        @include('components.modals.create')
        @include('components.modals.show')

    </div>
@endsection

@section('scripts')
<script src="//cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
<script>
    const http = axios.create({
        baseURL: "{{ url('/') }}",
    });
    
    $(document).ready( function () {

        var table = $('.table').DataTable({
            dom: ""+ 
                "<'row'<'toolbar col-sm-12 col-md-6'><'col-sm-12 col-md-3 text-right'l><'col-sm-12 col-md-3'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            ajax: "{{ route('mail.index') }}",
            columns: [
                { data: "id" },
                { data: "to" },
                { data: "subject" },
                { 
                    data: "por_spam",
                    render: ( data, type, row, meta ) => {
                        return `${data}%`;
                    }
                },
                { 
                    data: "created_at",
                    render: ( data, type, row, meta ) => {
                        return moment(data).toNow(true);
                    }
                },
            ],
            columnDefs: [
                {
                    targets: 5,
                    data: null,
                    orderable: false,
                    render: ( data, type, row ) => {
                        let renderBtn = `
                            <button 
                                type="button" 
                                class="btn btn-primary btn-show" 
                                data-id="${data.hid}"
                            >
                                Ver!
                            </button>
                        `
                        return renderBtn;
                    }
                }
            ]
        });
    });
</script>
@endsection
<!-- Modal Create -->
<div class="modal fade" id="createMail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

                <form>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" placeholder="To:">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" placeholder="Subject:">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control textarea" id="body" rows="3"></textarea>
                    </div>
                </form>
    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success">Enviar</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(document).ready( function () {
        $("div.toolbar").html(`
            <button 
                type="button" 
                class="btn btn-outline-primary"
                data-toggle="modal" 
                data-target="#createMail"
            >
                Redactar
            </button>
        `);
    });
</script>
@endsection
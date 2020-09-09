<!-- Modal Create -->
<div class="modal fade" id="createMail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

                <form>
                    <div class="form-group">
                        <input name="to" type="email" class="form-control" id="email" placeholder="To:">
                    </div>
                    <div class="form-group">
                        <input name="from_name" type="text" class="form-control" id="email" placeholder="From Name:">
                    </div>
                    <div class="form-group">
                        <input name="from_email"type="email" class="form-control" id="email" placeholder="From Email:">
                    </div>
                    <div class="form-group">
                        <select name="subject_id" class="form-control">
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">
                                    {{ $subject->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="body" class="form-control textarea" id="body" rows="3"></textarea>
                    </div>
                </form>
    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button id="submit"" type="button" class="btn btn-success">Enviar</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    async function sendForm(form) {
        try {
            const { data } = await http.post('/mail/send', form);
            return data
        } catch (e) {
            console.error(e);
        }
    }

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

        $('#submit').click(function() {
            sendForm($('form').serializeArray())
            .then((data) => {
                $('form').trigger("reset")

                $(this).removeClass('disabled')
                $('#createMail').modal('hide')  

                if(!alert(data.message)){window.location.reload()}
            })
        })
    });
</script>
@endsection
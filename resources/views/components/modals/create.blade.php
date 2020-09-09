<!-- Modal Create -->
<div class="modal fade" id="createMail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">

                <form id="form">
                    <div class="form-group">
                        <input name="to" type="email" class="form-control" id="to" placeholder="To:" required>
                    </div>
                    <div class="form-group">
                        <input name="from_name" type="text" class="form-control" id="from_name" placeholder="From Name:" required>
                    </div>
                    <div class="form-group">
                        <input name="from_email"type="email" class="form-control" id="from_email" placeholder="From Email:" required>
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
                        <textarea name="body" class="form-control textarea" id="body" rows="3" required></textarea>
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

<a href="http://" bac></a>

@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
    async function sendForm(form) {
        try {
            const { data } = await http.post('/mail/send', form);
            return data
        } catch (e) {
            console.error(e);
            return e.response
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
            <a 
                href="{{ route('mail.export', 'excel') }}"
                class="btn btn-success"
                target="_blank"
            >
                Excel
            </a>
            <a 
                href="{{ route('mail.export', 'pdf') }}"
                class="btn btn-danger"
                target="_blank"
            >
                PDF
            </a>
        `);

        $("#form-create").validate({
            errorElement: "div",
            rules: {
                toemail: {
                    required: true,
                    email: true
                },
                from_name: {
                    required: true,
                },
                from_name: {
                    required: true,
                    email: true
                },
                body: {
                    required: true
                }
            },
            highlight: function(e) {
                $(e).closest(".form-control").addClass("is-invalid")
            },
            unhighlight: function(e) {
                $(e).closest(".form-control").removeClass("is-invalid")
            }
        });

        $('#submit').click(function() {

            if ($("#form").valid())
                sendForm($('form').serializeArray())
                .then((data) => {
                    $('form').trigger("reset")

                    $(this).removeClass('disabled')
                    $('#createMail').modal('hide')  

                    if(!alert(data.message)){window.location.reload()}
                }).catch((error) => {
                    console.log(error)
                })
        })

    });
</script>
@endsection

@section('styles')
@parent
<style>
    .form-control.error {
        border-color: #dc3545;
        padding-right: calc(.75em + 2.3125rem);
        background: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%23343a40' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") no-repeat right .75rem center/8px 10px,url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e") #fff no-repeat center right 1.75rem/calc(.75em + .375rem) calc(.75em + .375rem);
    }

    label.error {
        width: 100%;
        margin-top: .25rem;
        font-size: 80%;
        color: #dc3545;
    }
</style>
@endsection
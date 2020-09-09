<!-- Modal Show -->
<div class="modal fade" id="showMail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    to: <b><span id="to"></span></b><br>
                    subject: <b><span id="subject"></b></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="body" class="modal-body">
                <div>
                    Hola <i class="text-muted">mundo</i> 
                </div>
            </div>
            <div class="modal-footer">
                <h4 id="por_spam" class="btn btn-danger disabled">
                    0%
                </h4>
                <h4 id="num_work" class="btn btn-warning disabled">
                    <span>0</span>
                    <small>/ 0 </small>
                </h4>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    async function showMail(id) {
        try {
            const { data } = await http.get(`/mail/${id}/show`);
            return data
        } catch (e) {
            console.error(e);
        }
    }

    $(document).ready( function () {
        $('.table tbody').on('click', 'button', function () {
            $('.table tbody button').addClass('disabled')
            showMail($(this).data('id'))
            .then( (data) => {
                $('#showMail').modal('show');
                $('.table tbody button').removeClass('disabled')

                $('span#to').text(data.to)
                $('span#subject').text(data.subject)

                $('#body div').remove();
                $('#body.modal-body').append(`<div>${data.format_body}</div>`)

                $('#por_spam').text(`${data.por_spam}%`)
                $('#num_work small').text(`/ ${data.num_words}`)
                $('#num_work span').text(`${data.num_spam_words}`)
            })
        });
    });
</script>
@endsection

@section('styles')
@parent
<style>
    #body.modal-body .text-muted{
        background-color: rgba(255, 193, 7, .6);
        padding: 0 3px;
    }

    #body div {
        background-color: rgba(0,0,0, .07);
        padding: 10px 5px;
    }
</style>
@endsection
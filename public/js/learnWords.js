/**
 * Created by Karl on 12/02/2016.
 */

function learnWord(id)
{
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        method: "POST",
        url: "/learnedWords",
        data: {
            _token: CSRF_TOKEN,
            id : id
        },
        beforeSend: function(data){
            $('#btn-unlearn-'+id).prop('disabled', true);
            $('#btn-learn-'+id).prop('disabled', true);
        },
        success: function(data) {
            $('#unlearn-btn-'+id).show();
            $('#learn-btn-'+id).hide();
            $('#btn-unlearn-'+id).prop('disabled', false);
            $('#btn-learn-'+id).prop('disabled', false);
        }
    })
}

function unLearnWord(id)
{
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
        url: "/learnedWords/"+id,
        data: {
            _method: 'delete',
            _token: CSRF_TOKEN

        },
        beforeSend: function(data){
            $('#btn-unlearn-'+id).prop('disabled', true);
            $('#btn-learn-'+id).prop('disabled', true);
        },
        success: function(data) {
            $('#unlearn-btn-'+id).hide();
            $('#learn-btn-'+id).show();
            $('#btn-unlearn-'+id).prop('disabled', false);
            $('#btn-learn-'+id).prop('disabled', false);
        }
    })
}
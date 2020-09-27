
function like_img() {
    $('#like-img').removeClass('far fa-heart fa-2x').addClass('fas fa-heart fa-2x').css('color', 'red').attr('id', 'dislike-img');
    var nrLikes = parseInt($('#nrLikes').text().split('Me')[0]) + 1;
    $('#nrLikes').text(nrLikes + ' Me gusta');
}

function dislike_img() {
    $('#dislike-img').removeClass('fas fa-heart fa-2x').addClass('far fa-heart fa-2x').css('color', '').attr('id', 'like-img');
    var nrLikes = parseInt($('#nrLikes').text().split('Me')[0]);
    if (nrLikes > 0) {
        nrLikes = nrLikes - 1;
        $('#nrLikes').text(nrLikes + ' Me gusta');
    }
}

function like_comment(comment_id) {
    $('div[value="' + comment_id + '"]').children().removeClass('far fa-heart fa-lg').addClass('fas fa-heart fa-lg').css('color', 'red');
    $('div[value="' + comment_id + '"]').attr('name', 'dislike-comment');
}

function dislike_comment(comment_id) {
    $('div[name="dislike-comment"]').children().removeClass('fas fa-heart fa-lg').addClass('far fa-heart fa-lg').css('color', '');
    $('div[value="' + comment_id + '"]').attr('name', 'like-comment');
}

function send_comment() {
    $("textarea[name='comment']").parent().append($("<input name='comment' value='res.data.comment-user' style='border:0px;'>"));
    $('#send-comment-btn').val('');
}

function axios_post(route, params, callback) {
    axios.post(route, params)
        .then(function(res){
            if (callback) {
                callback(res);
            }
        })
        .catch(function(error) {
            console.log(error);
        });
};


function post_ajax(url, data) {
    //data['_token'] = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        header: {
          'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr("content")
        },
        url: url,
        data: data,
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            console.log('funciona correctamente');
            console.log(response);
        },
        error: function(response) {
            window.open(JSON.stringify(response))
            console.log('no funciona');
        }
    });
}


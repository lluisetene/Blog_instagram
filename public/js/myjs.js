function prueba(name) {
    console.log('probando función global ' + name);
};

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


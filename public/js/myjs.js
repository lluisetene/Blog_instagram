console.log('hola')
jQuery.ajax({
    url: '/recommended-users/',
    dataType: 'json',
    success: function(data) {
        $('#aa').text('hola');
    }
})

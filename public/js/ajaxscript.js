
//the source code for this was taken here:
//http://www.expertphp.in/article/laravel-5-ajax-crud-example-to-build-web-application-without-page-refresh
var url = "/indexReminder";
//display modal form for product editing
$(document).on('click','.open_modal',function(){
    var product_id = $(this).val();

    $.get(url + '/' + product_id, function (data) {
        //success data
        console.log(data);
        $('#product_id').val(data.id);
        $('#user_reminder').val(data.user_reminder);
        $('#btn-save').val("update");
        $('#myModal').modal('show');
    })
});
//display modal form for creating new product
$('#btn_add').click(function(){
    $('#btn-save').val("add");
    $('#frmProducts').trigger("reset");
    $('#myModal').modal('show');
});

//create new product / update existing product
$("#btn-save").click(function (e) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    })
    e.preventDefault();
    var formData = {
        user_reminder:$('#user_reminder').val()
    }
    //used to determine the http verb to use [add=POST], [update=PUT]
    var state = $('#btn-save').val();
    var type = "POST"; //for creating new resource
    var product_id = $('#product_id').val();
    var my_url = url;
    if (state == "update"){
        type = "PUT"; //for updating existing resource
        my_url += '/' + product_id;
    }
    console.log(formData);
    $.ajax({
        type: type,
        url: my_url,
        data: formData,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            var product = '<tr id="product' + data.id + '"></tr> <td>' + data.user_reminder + '</td>';
            product += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.id + '">Edit</button>';

            if (state == "add"){ //if user added a new record
                $('#products-list').append(product);
            }else{ //if user updated an existing record
                $("#product" + product_id).replaceWith( product );
            }
            $('#frmProducts').trigger("reset");
            $('#myModal').modal('hide')
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});
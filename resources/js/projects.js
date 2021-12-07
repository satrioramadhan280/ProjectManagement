console.log('Hello Projects');
$('#createProjectbtn').on('click', function (e) {
    e.preventDefault();
    const href = $(this).attr('data-href');
    $.ajax({
        type: "GET",
        url: href,
        dataType: 'html',
        success: function (response) {
            $('#createProjectModal .modal-body').html(response);
            $('#createProjectModal').modal('show');
        }
    });
});
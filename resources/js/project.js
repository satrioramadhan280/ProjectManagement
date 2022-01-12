$('#addProjectbtn').on('click', function (e) {
    e.preventDefault();
    const URL = $(this).attr('data-href');
    const METHOD = 'GET';
    $.ajax({
        type: METHOD,
        url: URL,
        dataType: "html",
        success: function (response) {
            const MODAL_TITLE = 'Create Project';
            
            $('#addProjectModal .modal-title').text(MODAL_TITLE);
            $('#addProjectModal .modal-body').html(response);
            $('#addProjectModal').modal('show');
        }
    });
});

$('#fileUploadButton').on('click', function () {
    $('#addFile').toggle();
});

// $('#addFile').on('submit', function (e) {
//     e.preventDefault();
//     const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
//     const DATA = new FormData(this);
//     const METHOD = $(this).attr('method');
//     const URL = $(this).attr('data-action');
//     $.ajax({
//         headers:{
//             'X-CSRF-TOKEN': CSRF_TOKEN
//         },
//         type: METHOD,
//         url: URL,
//         data: DATA,
//         contentType: false,
//         processData: false,
//         dataType: 'json',
//         success: function(response){
//             console.log(response);
//         },
//         statusCode: {
//             200: function (response){
//                 window.location.replace("http://localhost:8000/projects/index");
//             },
//             422: function(response){
//                 const errors = response.responseJSON.errors;

//                 $('#addProjectForm .alert-danger').html('');
//                 $.each(errors, function(key, value){

//                     $('#addProjectForm .alert-danger').append('<li>'+value+'</li>');
//                     $('#addProjectForm .alert-danger').show();

//                 });

//             }
//         }
//     });
// });
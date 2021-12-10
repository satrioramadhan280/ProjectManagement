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
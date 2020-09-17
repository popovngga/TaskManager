@extends('layout')
<div class="row row-executor">
</div>
<script>
    window.history.pushState({}, document.title, "/");
    $(document).on("click", "#executor", function(e) {

        $.ajax({
            type: "GET",
            beforeSend: function (request) {
                request.setRequestHeader("Authorization", localStorage.getItem('token'));
            },
            url: "/api/tasks/executor",
            success: function (res) {
                $('.row-executor').empty();
                $.each(res, function (index, value) {
                    $('.row-executor').append("<div class=\"col-md-4\">\n" +
                        "        <div class=\"card mb-4 box-shadow\">\n" +
                        "          <div class=\"card-body status-color-"+index+"\">\n" +
                        "            <div class=\"info-block\">\n" +
                        "              <p class=\"p\">Header: "+value.header+"</p>\n" +
                        "              <p class=\"p\">Description: "+value.description+"</p>\n" +
                        "              <small class=\"p\">Deadline: "+value.deadline+"</small>\n" +
                        "              <br><small class=\"p\">Current status: "+value.status+"</small>\n" +
                        "            </div>\n" +
                        "            <div class=\"d-flex changer-"+index+" justify-content-between align-items-center\">\n" +
                        "              <div class=\"wrapper-style\">\n" +
                        "                   <button type=\"button\" class=\"hidden-element btn btn-sm btn-outline-secondary\">Decline</button>\n" +
                        "                <div class=\"not-active\" style=\"display: none\">\n" +
                        "                  <form class=\"form-style decline-executor\" method=\"PATCH\" action=\"api/task/change/"+value.id+"\">\n" +
                        "                    <input name=\"comment\" class=\"form-control form-control-sm input-fields\" type=\"text\" placeholder=\"Comment\">\n" +
                        "                    <input hidden name=\"status\" value=\"Declined from executor\" class=\"form-control form-control-sm input-fields\" type=\"text\" placeholder=\"Comment\">\n" +
                        "                    <button type=\"submit\" class=\"response btn btn-medium btn-outline-secondary button-custom\">\n" +
                        "                      Send decline message\n" +
                        "                    </button>\n" +
                        "                  </form>\n" +
                        "                </div>\n" +
                        "                  <form style=\"display: inline-flex\"class=\"complited-executor\" method=\"PATCH\" action=\"api/task/change/"+value.id+"\">\n" +
                        "                    <input name=\"status\" class=\"form-control form-control-sm input-fields\" type=\"text\" value=\"Complited\" placeholder=\"Comment\" hidden>\n" +
                        "                   <button type=\"submit\" class=\"complited btn btn-sm btn-outline-secondary\">Complite</button>\n" +
                        "                  </form>\n" +

                        "              </div>\n" +
                        "            </div>\n" +
                        "          </div>\n" +
                        "        </div>\n" +
                        "      </div>")
                    if(value.status === 'Accepted') {
                        $('.changer-'+index).remove();
                    }
                    if(value.status === 'Complited') {
                        $('.changer-'+index).remove();
                    }
                    if(value.status === 'Declined from executor') {
                        $('.changer-'+index).remove();
                    }
                });

            }
        });
    });
</script>

<script>
    $(document).on("submit", ".decline-executor", function(e) {
        e.preventDefault();
        let form = $(this);
        let serializedData = form.serialize();
        $.ajax({
            url: $(this).attr('action'),
            method: "PATCH",
            beforeSend: function(request) {
                request.setRequestHeader("Authorization", localStorage.getItem('token'));
            },
            data: serializedData,
            success: function() {
                $("#success-modal-change").modal("show");
            },
            error: function() {
                $("#error-modal").modal("show");
            }
        });
    });
    $(document).on("submit", ".complited-executor", function(e) {
        e.preventDefault();
        let form = $(this);
        let serializedData = form.serialize();
        $.ajax({
            url: $(this).attr('action'),
            method: "PATCH",
            beforeSend: function(request) {
                request.setRequestHeader("Authorization", localStorage.getItem('token'));
            },
            data: serializedData,
            success: function() {
                $("#success-modal-change").modal("show");
            },
            error: function() {
                $("#error-modal").modal("show");
            }
        });
    });
</script>

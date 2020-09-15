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
                        "          <div class=\"card-body\">\n" +
                        "            <div class=\"info-block\">\n" +
                        "              <p class=\"p\">Header: "+value.header+"</p>\n" +
                        "              <small class=\"p\">Description: "+value.description+"</small>\n" +
                        "            </div>\n" +
                        "            <div class=\"d-flex justify-content-between align-items-center\">\n" +
                        "              <div class=\"wrapper-style\">\n" +
                        "                   <button type=\"button\" class=\"hidden-element btn btn-sm btn-outline-secondary\">Declined</button>\n" +
                        "                <div class=\"not-active\" style=\"display: none\">\n" +
                        "                  <form class=\"form-style decline-executor\" method=\"PATCH\" action=\"api/task/change/"+value.id+"\">\n" +
                        "                    <input name=\"comment\" class=\"form-control form-control-sm input-fields\" type=\"text\" placeholder=\"Comment\" required>\n" +
                        "                    <button type=\"submit\" class=\"response btn btn-medium btn-outline-secondary button-custom\">\n" +
                        "                      Send decline message\n" +
                        "                    </button>\n" +
                        "                  </form>\n" +
                        "                </div>\n" +
                        "                  <form style=\"display: inline-flex\"class=\"complited-executor\" method=\"PATCH\" action=\"api/task/change/"+value.id+"\">\n" +
                        "                    <input name=\"status\" class=\"form-control form-control-sm input-fields\" type=\"text\" value=\"Complited\" placeholder=\"Deadline\" hidden>\n" +
                        "                   <button type=\"submit\" class=\"complited btn btn-sm btn-outline-secondary\">Complited</button>\n" +
                        "                  </form>\n" +

                        "              </div>\n" +
                        "            </div>\n" +
                        "          </div>\n" +
                        "        </div>\n" +
                        "      </div>")
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
                $("#success-modal").modal("show");
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
                $("#success-modal").modal("show");
            },
            error: function() {
                $("#error-modal").modal("show");
            }
        });
    });
</script>

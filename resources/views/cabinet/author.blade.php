@extends('layout')
<div class="row row-author">
</div>
<script>
    window.history.pushState({}, document.title, "/");
    $(document).on("click", "#author", function(e) {

        $.ajax({
            type: "GET",
            beforeSend: function (request) {
                request.setRequestHeader("Authorization", localStorage.getItem('token'));
            },
            url: "/api/tasks/author",
            success: function (res) {
                $('.row-author').empty();
                $.each(res, function (index, value) {
                    $('.row-author').append("<div class=\"col-md-4\">\n" +
                        "        <div class=\"card mb-4 box-shadow\">\n" +
                        "          <div class=\"card-body\">\n" +
                        "            <div class=\"info-block\">\n" +
                        "              <p class=\"p\">Header: "+value.header+"</p>\n" +
                        "              <small class=\"p\">Description: "+value.description+"</small>\n" +
                        "            </div>\n" +
                        "            <div class=\"d-flex justify-content-between align-items-center\">\n" +
                        "              <div class=\"wrapper-style\">\n" +
                        "                  <form style=\"display: inline-flex\"class=\"accept-author\" method=\"PATCH\" action=\"api/task/change/"+value.id+"\">\n" +
                        "                    <input name=\"status\" class=\"form-control form-control-sm input-fields\" type=\"text\" value=\"Accepted\" hidden>\n" +
                        "                   <button type=\"submit\" class=\"complited btn btn-sm btn-outline-secondary\">Accepted</button>\n" +
                        "                  </form>\n" +
                        "                  <form style=\"display: inline-flex\"class=\"decline-author\" method=\"PATCH\" action=\"api/task/change/"+value.id+"\">\n" +
                        "                    <input name=\"status\" class=\"form-control form-control-sm input-fields\" type=\"text\" value=\"Declined\"  hidden>\n" +
                        "                   <button type=\"submit\" class=\"complited btn btn-sm btn-outline-secondary\">Declined</button>\n" +
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
    $(document).on("submit", ".decline-author", function(e) {
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
    $(document).on("submit", ".accept-author", function(e) {
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

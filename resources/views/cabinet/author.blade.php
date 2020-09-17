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
                        "        <div class=\"card mb-4 box-shadow changer-color\">\n" +
                        "          <div class=\"card-body status-color-"+index+"\">\n" +
                        "            <div class=\"info-block\">\n" +
                        "              <p class=\"p\">Header: "+value.header+"</p>\n" +
                        "              <p class=\"p\">Description: "+value.description+"</p>\n" +
                        "              <small class=\"p\">Deadline: "+value.deadline+"</small>\n" +
                        "              <br><small class=\"p append-after-"+index+"\">Current status: "+value.status+"</small>\n" +

                        "            </div>\n" +
                        "            <div class=\"d-flex changer-"+index+" justify-content-between align-items-center\">\n" +
                        "              <div class=\"wrapper-style\">\n" +
                        "                  <form style=\"display: inline-flex\" class=\"accept-author\" method=\"PATCH\" action=\"api/task/change/"+value.id+"\">\n" +
                        "                    <input name=\"status\" class=\"form-control form-control-sm input-fields\" type=\"text\" value=\"Accepted\" hidden>\n" +
                        "                   <button type=\"submit\" class=\"complited btn btn-sm btn-outline-secondary\">Accept</button>\n" +
                        "                  </form>\n" +
                        "                  <form style=\"display: inline-flex\" class=\"decline-author\" method=\"PATCH\" action=\"api/task/change/"+value.id+"\">\n" +
                        "                    <input name=\"status\" class=\"form-control form-control-sm input-fields\" type=\"text\" value=\"Declined from author\"  hidden>\n" +
                        "                   <button type=\"submit\" class=\"complited btn btn-sm btn-outline-secondary\">Decline</button>\n" +
                        "                  </form>\n" +

                        "              </div>\n" +
                        "            </div>\n" +
                        "          </div>\n" +
                        "        </div>\n" +
                        "      </div>")
                    if(value.comment !== null) {
                        $('.append-after-'+index).after(
                        "<br><small class=\"p\">Comment: "+value.comment+"</small>\n"
                        );
                    }
                    if(value.status === 'Accepted') {
                        $('.changer-'+index).remove();
                    }
                    if(value.status === 'Declined from author') {
                        $('.changer-'+index).remove();
                    }
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
                $("#success-modal-change").modal("show");
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
                $("#success-modal-change").modal("show");
            },
            error: function() {
                $("#error-modal").modal("show");
            }
        });
    });
</script>

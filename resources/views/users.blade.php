@extends('layout')
<style>
  .p {
    padding: 0 0 0 0 !important;
    margin: 0 0 0 0 !important;
    line-height: 2;
    color: #6c757d !important;
  }

  .info-block {
    margin-bottom: 5px;
  }

  .form-style {
    flex: 1 !important;
    display: flex !important;
    flex-direction: column !important;
  }

  .wrapper-style {
    flex: 1 !important;
  }

  .input-fields {
    margin-top: 5px;
  }

  .button-custom {
    margin-top: 5px;
  }
</style>
<div class="album py-5 bg-light">
  <div class="container">
    <div class="row">
    </div>
  </div>
</div>

<div id="success-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog alert alert-success" role="alert">
    <h4 class="alert-heading">Successfully added task!</h4>
  </div>
</div>
<div id="error-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog alert alert-danger" role="alert">
    <h4 class="alert-heading">Something went wrong!</h4>
  </div>
</div>
<script>
  window.history.pushState({}, document.title, "/");
  $.ajax({
      type: "GET",
      beforeSend: function (request) {
        request.setRequestHeader("Authorization", localStorage.getItem('token'));
      },
      url: "http://example.com/api/users",
      success: function (res) {
        $.each(res, function (index, value) {
          console.log(value);
          $('.row').append("<div class=\"col-md-4\">\n" +
            "        <div class=\"card mb-4 box-shadow\">\n" +
            "          <div class=\"card-body\">\n" +
            "            <div class=\"info-block\">\n" +
            "              <p class=\"p\">Name: "+value.name+"</p>\n" +
            "              <small class=\"p\">Email: "+value.email+"</small>\n" +
            "            </div>\n" +
            "            <div class=\"d-flex justify-content-between align-items-center\">\n" +
            "              <div class=\"wrapper-style\">\n" +
            "                <button type=\"button\" class=\"hidden-element btn btn-sm btn-outline-secondary\">Set task</button>\n" +
            "                <div class=\"not-active\" style=\"display: none\">\n" +
            "                  <form class=\"form-style\" method=\"POST\" action=\"api/task/create\">\n" +
            "                    <input name=\"header\" class=\"form-control form-control-sm input-fields\" type=\"text\" placeholder=\"Header\" required>\n" +
            "                    <input name=\"description\" class=\"form-control form-control-sm input-fields\" type=\"text\" placeholder=\"Description\" required>\n" +
            "                    <input name=\"status\" class=\"form-control form-control-sm input-fields\" type=\"text\" placeholder=\"Status\" required>\n" +
            "                    <input name=\"deadline\" class=\"form-control form-control-sm input-fields\" type=\"date\" placeholder=\"Deadline\" required>\n" +
            "                    <input name=\"to_user_id\" class=\"form-control form-control-sm input-fields\" type=\"text\" value=\""+value.id+"\" placeholder=\"Deadline\" hidden>\n" +
            "                    <button type=\"submit\" class=\"response btn btn-medium btn-outline-secondary button-custom\">\n" +
            "                      Set\n" +
            "                    </button>\n" +
            "                  </form>\n" +
            "                </div>\n" +
            "              </div>\n" +
            "            </div>\n" +
            "          </div>\n" +
            "        </div>\n" +
            "      </div>")
        });
      }
    });
</script>
<script>
  $(document).on("click", ".hidden-element", function(e) {
    let x = $(e.target);
    x.next().toggle();
  });
  $(document).on("submit", ".form-style", function(e) {
    e.preventDefault();
    let form = $(this);
    let serializedData = form.serialize();
    console.log(serializedData)
    $.ajax({
      url: '/api/task/create',
      method: "POST",
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

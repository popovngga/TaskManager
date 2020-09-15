@extends('layout')
<div class="row row-users">
</div>
<script>
  window.history.pushState({}, document.title, "/");
  <?php if (isset($token)) { ?>
  localStorage.setItem('token', "{{'Bearer '.$token}}");
  <?php } ?>
          !localStorage.getItem('token') ? $(location).attr('href', '/') : false;
  $(document).on("click", "#users", function(e) {
  $.ajax({
    type: "GET",
    beforeSend: function (request) {
      request.setRequestHeader("Authorization", localStorage.getItem('token'));
    },
    url: "/api/users",
    success: function (res) {
      $('.row-users').empty();
      $.each(res, function (index, value) {
        $('.row-users').append("<div class=\"col-md-4\">\n" +
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
          "                  <form class=\"form-style user-response\" method=\"POST\" action=\"api/task/create\">\n" +
          "                    <input name=\"header\" class=\"form-control form-control-sm input-fields\" type=\"text\" placeholder=\"Header\" required>\n" +
          "                    <input name=\"description\" class=\"form-control form-control-sm input-fields\" type=\"text\" placeholder=\"Description\" required>\n" +
          "                    <input name=\"status\" class=\"form-control form-control-sm input-fields\" type=\"text\" placeholder=\"Status\" required>\n" +
          "                    <input name=\"deadline\" class=\"form-control form-control-sm input-fields\" type=\"date\" placeholder=\"Deadline\" required>\n" +
          "                    <input name=\"user_executor_id\" class=\"form-control form-control-sm input-fields\" type=\"text\" value=\""+value.id+"\" placeholder=\"Deadline\" hidden>\n" +
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
  });});
</script>
<script>
  $(document).on("click", ".hidden-element", function(e) {
    let x = $(e.target);
    x.next().toggle();
    $('.complited').toggle();
  });
  $(document).on("submit", ".user-response", function(e) {
    e.preventDefault();
    let form = $(this);
    let serializedData = form.serialize();
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

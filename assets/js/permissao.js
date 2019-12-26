$(document).ready(function () {
  $('#formPermissao').submit(function (e) {
      var dados = $(this).serialize();
      $.ajax({
          type: "POST",
          url: "permissao/add_action",
          data: dados,
          success: function (data) {
            swal(
                'dededd',
                'titulo',
                'warning'
            );
              $("#msg").html(data);
          }

      })
  })
});
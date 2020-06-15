$('#modal-reportePosicion').on('show.bs.modal', function (event) {
  var posicion = $(event.relatedTarget).text().trim();

  //$(this).find(".modal-body").text(myVal);
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this);

  modal.find('.modal-title').html('<b>Reportar posicion</b>')
  modal.find('#modal-numeroPosicion').text(posicion)
  modal.find('#posicionCambio').val(posicion);
  modal.find('#posicionCambioSupervisor').val(posicion);

})

$('#modal-reportePosicionSistemas').on('show.bs.modal', function (event) {
  var posicion = $(event.relatedTarget).text().trim();

  var datos = new FormData();
  datos.append("mostrarSolicitudes", true);
  datos.append("posicion", posicion);
  datos.append("estado", 'enviado');

  $.ajax({
  url:"ajax/solicitudes.ajax.php",
  method: "post",
  data: datos,
  cache: false,
  contentType: false,
  processData: false,
  success: function(respuesta){
      console.log(respuesta);
      $('#modal-reportePosicionSistemas').find('.modal-body').html(respuesta);
    }
  })
  //$(this).find(".modal-body").text(myVal);
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this);


  modal.find('#modal-numeroPosicion').text(posicion)
  modal.find('#posicionCambio').val(posicion);

})

let box = document.getElementById('modal-body2'),
    btn = document.querySelector('#mostrarOcultarBody2');

btn.addEventListener('click', function () {

  if (box.classList.contains('hidden')) {
    box.classList.remove('hidden');
    box.classList.add('visible');
    setTimeout(function () {
      box.classList.remove('visuallyhidden');
    }, 20);
  } else {
    box.classList.add('visuallyhidden');
    box.classList.remove('visible');
    box.addEventListener('transitionend', function(e) {
      box.classList.add('hidden');
    }, {
      capture: false,
      once: true,
      passive: false
    });
  }

}, false);

jQuery(function($) {
    $(window).on('scroll', function() {
		if ($(this).scrollTop() >= 200) {
			$('.navbar').addClass('fixed-top');
		} else if ($(this).scrollTop() == 0) {
			$('.navbar').removeClass('fixed-top');
		}
	});

	function adjustNav() {
		var winWidth = $(window).width(),
			dropdown = $('.dropdown'),
			dropdownMenu = $('.dropdown-menu');

		if (winWidth >= 768) {
			dropdown.on('mouseenter', function() {
				$(this).addClass('show')
					.children(dropdownMenu).addClass('show');
			});

			dropdown.on('mouseleave', function() {
				$(this).removeClass('show')
					.children(dropdownMenu).removeClass('show');
			});
		} else {
			dropdown.off('mouseenter mouseleave');
		}
	}

	$(window).on('resize', adjustNav);

	adjustNav();
});

$("#loginform").submit(function() {
  // passo i dati (via POST) al file PHP che effettua le verifiche
  $.post("login.php", { nick: $('#nick').val(), pw: $('#pw').val() }, function(risposta) {
    // se i dati sono corretti...
    if (risposta == 1) {
      // applico l'effetto allo span con id "messaggio"
      $("#msg").fadeTo(200, 0.1, function() {
        // per prima cosa mostro, con effetto fade, un messaggio di attesa
        $(this).removeClass().addClass('corretto').text('Login in corso...').fadeTo(900, 1, function() {
          // al termine effettuo il redirect alla pagina privata
          document.location = '../../php/index.php';
        });
      });
    // se, invece, i dati non sono corretti...
    }else{
      // stampo un messaggio di errore
      $("#msg").fadeTo(200, 0.1, function() {
        $(this).removeClass().addClass('errore').text('Dati di login non corretti!').fadeTo(900,1);
        $('#pw').removeClass().addClass('is-invalid');
        $('#nick').removeClass().addClass('is-invalid');
      });
    }
  });
  // evito il submit del form (che deve essere gestito solo dalla funzione Javascript)
  return false;
});

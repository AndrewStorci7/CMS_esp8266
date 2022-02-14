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

function showPw() {
  var input = document.getElementById('pw');
  if (input.type === "password") {
    input.type = "text";
  } else {
    input.type = "password";
  }
}

function hide(){
  const id = document.getElementById('succfinalmsg');
  id.classList.add('hide');
}


/*$(document).ready(function(){
  $('#submit').on('click', function(){
    var form = $(this).parents('form');
    var url = form.attr('action');
    console.log(url);
    if(form.attr('id') == 'register_form'){
      var nc = $('#nomecompleto').val();
      var nick = $('#nick').val();
      var email = $('#email').val();
      var pw = $('#pw').val();
      var data = 'nc=' + nc + '&nick=' + nick + '&email=' + email + '&pw=' + pw;
      console.log(data);
    } else if(form.attr('id') == 'login_form'){
      var nick = $('#nick').val();
      var pw = $('#pw').val();
      var data = 'nick=' + nick + '&pw=' + pw;
      console.log(data);
    }

    $.ajax({
        method: 'POST',
        dataType: 'JSON',
        url: url,
        data: data,
        success: function(response){
          form.find(':submit').attr('disabled', false);
          if (response.err_stat == 1) {
            form.find('small').text('');
            // If validation error exists
            for (var key in response) {
              var errorContainer = form.find(`#${key}error`);
              if (errorContainer.length !== 0) {
                errorContainer.html(response[key]);
              }
            }
          }
          if (response.stato == 1) {
            form.trigger('reset');
            form.find('small').text('');
            // handling success respone
            toastr.success(response.msg);
            setTimeout(function() {
              window.location.href = '../access/html/login_form.php'
            })
          } else if (response.stato == 0) {
            // Handling failure response
            toastr.error(response.msg);
          }
        },
        error: function(xhr, textStatus, errorThrown) {
          console.log(xhr.responseText);
        }
    });
  });
});*/

// LOGIN ASINCRONO
/*$(function() {
	$('#loginform').submit(function(event) {
		var $form = $(this);
		var url = $form.attr('action');
		var nick = $('#nick', $form).val();
		var pw = $('#pw', $form).val();
		var data = 'nick=' + nick + '&pw=' + pw;
		$.ajax({
			type: 'POST',
			dataType: 'text',
			url: url,
			data: data,
			success: function(html) {
				$('p.message', $form).remove();
				//$(html).prependTo($('form', $form));
        window.location = '../../php/index.php?link=userdata';
			},
      error: function(html){
        $('p.message', $form).add();
      }
		});

		//event.preventDefault();
	});
});*/

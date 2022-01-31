$('#grafico').click(function(){
  if(('#tabella').is(":visible")){
    $('#grafico').hide();
    $('#tabella').show();
  } else if (('#grafico').is(":visible")) {
    $('#grafico').show();
    $('#tabella').hide();
  }
})

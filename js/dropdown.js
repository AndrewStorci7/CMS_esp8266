$('#see_graph').click(function(){
  if(('#tabella').is(":visible")){
    $('#see_graph').hide();
    $('#tabella').show();
  } else if (('#see_graph').is(":visible")) {
    $('#see_graph').show();
    $('#tabella').hide();
  }
})

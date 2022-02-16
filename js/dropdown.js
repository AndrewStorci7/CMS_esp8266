const graph = document.getElementById('grafico');
const table = document.getElementById('tabella');
const home = document.getElementById('home_navbar');
const data = document.getElementById('data_navbar');
const alluserdata = document.getElementById('alluserdata_navbar');
const settings = document.getElementById('settings_navbar');
const profile = document.getElementById('profile_navbar');


function seegraph(){
  if(graph.classList.contains('.nascondi')){
    table.classList.add('.mostra');
    graph.classList.add('.nascondi');
  } else if (graph.classList.contains('.mostra')){
    table.classList.add('.nascondi');
    graph.classList.add('.mostra');
  }
}

function paginaSelector(id){
  let id_clicked = document.getElementById(id);
  if(id_clicked.classList.contains('active')){

  } else {

  }

}

function deleteDisp(id){
  if (id == 0) {
    alert("ID invalido");
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText==1){
          window.location.reload();
        }else{
          alert("Utente non eliminato");
        }
      }
    };
    var annulla = window.confirm("Sei sicuro ?");
    if(annulla){
      xmlhttp.open("GET", "settings_functions/delete.php?id_disp=" + id, true);
      xmlhttp.send();
    } else {
      xmlhttp.abort();
      window.alert("Utente non eliminato");
    }
  }
}

function seeAggiungi(){
  const aggiungi_form = document.getElementById('form_aggiungi');
  if(aggiungi_form.style.display == 'none'){
    aggiungi_form.style.display = 'block';
  } else {
    aggiungi_form.style.display = 'none';
  }
}

/*
function modifyDisp(id){
  if (id == 0) {
    alert("ID invalido");
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText==1){
          window.location.reload();
        }else{
          alert("Utente non eliminato");
        }
      }
    };
    var annulla = window.confirm("Sei sicuro ?");
    if(annulla){
      xmlhttp.open("GET", "settings_functions/delete.php?ID=" + id, true);
      xmlhttp.send();
    } else {
      xmlhttp.abort();
      window.alert("Utente non eliminato");
    }
  }
}*/

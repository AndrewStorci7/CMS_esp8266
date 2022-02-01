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

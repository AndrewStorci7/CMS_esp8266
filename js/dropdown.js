const graph = document.getElementById('grafico');
const table = document.getElementById('tabella');
function seegraph(){
  if(graph.matches('.nascondi')){
    table.ClassList.add('.mostra');
    graph.ClassList.add('.nascondi');
  } else if (graph.matches('.mostra')){
    table.ClassList.add('.nascondi');
    graph.ClassList.add('.mostra');
  }
}

function imprimirWindow(objeto) {
    var objetoSeleccionado = document.getElementById(objeto);
    var imprimirObjeto = window.open('', 'Impresion');
    imprimirObjeto.document.write(objetoSeleccionado.innerHTML);
    imprimirObjeto.document.close();
    imprimirObjeto.print();
    imprimirObjeto.close();
}
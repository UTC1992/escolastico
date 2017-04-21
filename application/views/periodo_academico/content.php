<div class="container well">	
    <center><h2>Lista de clientes</h2></center>
    <strong>Nuevo Cliente: </strong>
    <a href="nuevoCliente.php" class="btn btn-default">
        <span><img class="img-responsive" src="./img/nuevo.png" width="35" height="35"></span>
    </a>
    <br><br>
    <div class="table-responsive">
        
        <table  id="Jtabla" class="table table-bordered">
            <thead>
                <tr>
                    <th>Mes de inicio</th>
                    <th>Año de inicio</th>
                    <th>Mes de finalización</th>
                    <th>Año de finalización</th>
                </tr>
            </thead>

            <tbody>

                <?php 
                    foreach ($consulta->result() as $fila ) {
                        echo $fila->mesinicio_pera;
                        echo $fila->anioinicio_pera;
                        echo $fila->mesfin_pera;
                        echo $fila->aniofin_pera;
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
 
$(document).ready(function() {
 
    $('#Jtabla').dataTable( {
 
        "language": {
 
    "sProcessing":     "Procesando...",
 
    "sLengthMenu":     "Mostrar _MENU_ registros",
 
    "sZeroRecords":    "No se encontraron resultados",
 
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
 
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
 
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
 
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
 
    "sInfoPostFix":    "",
 
    "sSearch":         "Buscar:",
 
    "sUrl":            "",
 
    "sInfoThousands":  ",",
 
    "sLoadingRecords": "Cargando...",
 
    "oPaginate": {
 
        "sFirst":    "Primero",
 
        "sLast":     "Último",
 
        "sNext":     "Siguiente",
 
        "sPrevious": "Anterior"
 
    },
 
    "oAria": {
 
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
 
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
 
    }
 
}
 
    
 
    } );
 
} );
 
</script>
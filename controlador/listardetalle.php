<div class="container">
    <div class="row">
        <div class="col-md-6">
            <label for="min">Start Date:</label>
            <input type="" id="min" name="min" class="form-control datepicker">
        </div>
        <div class="col-md-6">
            <label for="max">End Date:</label>
            <input type="" id="max" name="max" class="form-control datepicker">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            <button id="filter" class="btn btn-primary">Buscar</button>
            <button id="generate-pdf" class="btn btn-outline-success btn-sm">Generate PDF</button>
        </div>
    </div>
    
</div>
<br><br>

<?php

require_once "../modelo/CRUDEntradas.php"; 

$listado = new Entradas; 
$registros = $listado->listardetalle(); 
$registrosTotales = $listado->listartotal(); 

$tabla = '<table class="table table-white" id="tabla" style="width:100%">
<thead>
    <tr>
        <th>Ticket</th>
        <th>Fecha</th>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Monto</th>
    </tr>
</thead>
<tbody>';

// Generar filas de datos
$datos = '';
foreach ($registros as $fila) {
    $datos .= '<tr>
            <td>' . $fila['ticket'] . '</td>
            <td>' . $fila['fecha'] . '</td>
            <td>' . $fila['producto'] . '</td>
            <td>' . $fila['cantidad'] . '</td>
            <td>' . $fila['monto'] . '</td>
        </tr>';
}

// Generar fila de totales
$tfoot = '<tfoot>
    <tr>
        <td colspan="4"><strong>Total:</strong></td>
        <td>';
foreach($registrosTotales as $fila2) {
    $tfoot .= $fila2['total']; 
}
$tfoot .= '</td>
    </tr>
</tfoot>';

// Imprimir tabla completa
echo $tabla . $datos . '</tbody>' . $tfoot . '</table>';
?>

<script>
        $(document).ready(function() {
            // Initialize datepickers
            $(".datepicker").datepicker({
                dateFormat: "yy-mm-dd"
            });

            // DataTable initialization
            var table = $('#tabla').DataTable({
                ordering: false,
                paging: false,
                searching: true,
                dom: 'ft',
                language: {
                    search: "Buscar:"
                }
            });

            // Custom filtering function
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var min = $('#min').val();
                    var max = $('#max').val();
                    var date = data[1]; // Assuming 'Fecha' is in the second column

                    if ((min === "" && max === "") ||
                        (min === "" && date <= max) ||
                        (min <= date && max === "") ||
                        (min <= date && date <= max)) {
                        return true;
                    }
                    return false;
                }
            );

            // Event listener for the filter button
            $('#filter').click(function() {
                table.draw();
            });

            // Event listener for the generate PDF button
            $('#generate-pdf').click(function() {
                var min = $('#min').val();
                var max = $('#max').val();
                window.location.href = './controlador/fechas.php?min=' + min + '&max=' + max;
            });

            // Custom message when no records are found
            table.on('draw', function() {
                if (table.rows({ filter: 'applied' }).data().length === 0) {
                    alert("No existe rango de fecha.");
                }
            });
        });
    </script>
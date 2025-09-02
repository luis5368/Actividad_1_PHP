<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <h1>Formulario Empleado</h1>
        <!-- Button trigger modal -->
    <input type="submit" name="btn_nuevo" id="btn_nuevo" class="btn btn-primary" data-bs-toggle="modal" onclick="limpiar()" data-bs-target="modal_empleados" value = "Nuevo Empleado">
    <div class="container">

    <!-- Modal -->
    <div class="modal fade" id="modal_empleados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Empleados</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        <div class="container">
            <form class="d-flex" action="crud_empleado.php" method="post"> 
                <div class="col">
                     <div class="mb-3">
                        <label for="lbl_id" class="form-label">ID</label>
                        <input
                            type="text"
                            name="txt_id"
                            id="txt_id"
                            class="form-control"
                            placeholder="Ejemplo: 0"
                            value="0"
                            readonly
                        />
                    </div>
                    <div class="mb-3">
                        <label for="lbl_codigo" class="form-label">Codigo</label>
                        <input
                            type="text"
                            name="txt_codigo"
                            id="txt_codigo"
                            class="form-control"
                            placeholder="Ejemplo: 001"
                            required="true"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="lbl_nombres" class="form-label">Nombres</label>
                        <input
                            type="text"
                            name="txt_nombres"
                            id="txt_nombres"
                            class="form-control"
                            placeholder="Ejemplo: Luis Fernando"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="lbl_apellidos" class="form-label">Apellidos</label>
                        <input
                            type="text"
                            name="txt_apellidos"
                            id="txt_apellidos"
                            class="form-control"
                            placeholder="Ejemplo: Ramirez de Leon"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="lbl_direccion" class="form-label">Direccion</label>
                        <input
                            type="text"
                            name="txt_direccion"
                            id="txt_direccion"
                            class="form-control"
                            placeholder="Ejemplo: 20 calle 11-53 zona 1 Guatemala"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="lbl_telefono" class="form-label">Telefono</label>
                        <input
                            type="text"
                            name="txt_telefono"
                            id="txt_telefono"
                            class="form-control"
                            placeholder="Ejemplo: 65656656"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="lbl_fn" class="form-label">Fecha Nacimiento</label>
                        <input
                            type="date"
                            name="txt_fn"
                            id="txt_fn"
                            class="form-control"
                            placeholder="Ejemplo: dd/mm/yyyy"
                        />
                    </div>
                    <div class="mb-3">
                        <label for="lbl-puesto" class="form-label">Puesto</label>
                        <select
                            class="form-select form-select-lg"
                            name="drop_puesto"
                            id="drop_puesto"
                        >
                            <option selected>Elija Puesto</option>
                            <?php

                            include("datos_conexion.php");
                            $db_conexion=mysqli_connect($db_host,$db_usuario,$db_contra,$db_nombre);
                            $db_conexion->real_query("SELECT id_puesto, puesto FROM puestos");
                            $resultado=$db_conexion->use_result();

                            while($fila=$resultado->fetch_assoc()){
                                echo"<option value=". $fila['id_puesto'] .">". $fila['puesto'] ."</option>";
                            }
                            $db_conexion->close();

                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value = "Agregar">
                <input type="submit" name="btn_modificar" id="btn_modificar" class="btn btn-success" value = "Modificar">
                <input type="submit" name="btn_eliminar" id="btn_eliminar" class="btn btn-danger" onclick="javascript:if(!confirm('¿Desea Eliminar?'))return false" value = "Eliminar">
                <input type="submit" name="btn_nuevo" id="btn_nuevo" class="btn btn-secondary" onclick="limpiar()" value = "Nuevo">
              </div> 
                </div>
            </form>
            </div>
            </div>
            </div>
            </div>
            </div>
            <div
                class="table-responsive"
            >
                <table
                    class="table table-striped table-hover table-borderless table-primary align-middle"
                >
                    <thead class="table-light">

                        <tr>
                            <th>Codigo</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th>Fecha Nacimiento</th>
                            <th>Puesto</th>
                        </tr>
                    </thead>
                    <tbody id="tbl_empleados" class="table-group-divider">

                        <?php

                            include("datos_conexion.php");
                            $db_conexion=mysqli_connect($db_host,$db_usuario,$db_contra,$db_nombre);
                            $db_conexion->real_query("SELECT e.id_empleado as id, e.codigo, e.nombres, e.apellidos, e.direccion, e.telefono, e.fecha_nacimiento, p.puesto, p.id_puesto FROM empleados as e inner join puestos as p on e.id_puesto=p.id_puesto");
                            $resultado=$db_conexion->use_result();

                            while($fila=$resultado->fetch_assoc()){
                                echo"<tr data-id=".$fila['id']." data-idp=".$fila['id_puesto'].">";
                                echo"<td>". $fila['codigo'] ."</td>";
                                echo"<td>". $fila['nombres'] ."</td>";
                                echo"<td>". $fila['apellidos'] ."</td>";
                                echo"<td>". $fila['direccion'] ."</td>";
                                echo"<td>". $fila['telefono'] ."</td>";
                                echo"<td>". $fila['fecha_nacimiento'] ."</td>";
                                echo"<td>". $fila['puesto'] ."</td>";
                                echo"</tr>";
                            }
                            $db_conexion->close();

                            ?>


                    </tbody>
                </table>
            </div>
            
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
        <script type="text/javascript">
        function limpiar(){
            $("#txt_id").val(0);
            $("#txt_codigo").val('');
            $("#txt_nombres").val('');
            $("#txt_apellidos").val('');
            $("#txt_direccion").val('');
            $("#txt_telefono").val('');
            $("#txt_fn").val('');
            $("#drop_puesto").val(1);
            $("#modal_empleados").modal('show');
            
        }
        $('#tbl_empleados').on('click','tr td',function(evt){
            var target,id,idp,codigo,nombres,apellidos,direccion,telefono,nacimiento;
            target = $(event.target);
            id = target.parent().data('id');
            idp = target.parent().data('idp');
            codigo = target.parent("tr").find("td").eq(0).html();
            nombres = target.parent("tr").find("td").eq(1).html();
            apellidos =  target.parent("tr").find("td").eq(2).html();
            direccion = target.parent("tr").find("td").eq(3).html();
            telefono = target.parent("tr").find("td").eq(4).html();
            nacimiento  = target.parent("tr").find("td").eq(5).html();
            $("#txt_id").val(id);
            $("#txt_codigo").val(codigo);
            $("#txt_nombres").val(nombres);
            $("#txt_apellidos").val(apellidos);
            $("#txt_direccion").val(direccion);
            $("#txt_telefono").val(telefono);
            $("#txt_fn").val(nacimiento);
            $("#drop_puesto").val(idp);
            $("#modal_empleados").modal('show');
            
            });
        </script>
    </body>
</html>

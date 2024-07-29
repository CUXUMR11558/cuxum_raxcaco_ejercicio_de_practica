<?php include_once '../../includes/header.php' ?>

<br><br><br><br><br>
<div class="container">
    <h1 class="text-center">REGISTROS DE CLIENTES</h1>
    <div class="row justify-content-center mb-3">
        <form class="col-lg-8 border bg-light p-3">
            <input type="hidden" name="cli_codigo" id="cli_codigo">

            <div class="row">
                <div class="col mb-3">
                    <div class="col">
                        <label for="cli_nombre">Nombre del Cliente</label>
                        <input type="text" name="cli_nombre" id="cli_nombre" class="form-control" required>
                    </div>
                </div>

                <div class="col form-group mb-3">
                    <label for="cli_sexo">Sexo del Cliente</label>
                    <select name="cli_sexo" id="cli_sexo" class="form-control" required>
                        <option value="">Seleccione</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col mb-3">
                    <div class="col">
                        <label for="cli_telefono">No. de Telefono del Cliente</label>
                        <input type="number" name="cli_telefono" id="cli_telefono" class="form-control" required>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="col">
                        <label for="cli_pais">Pais</label>
                        <input type="text" name="cli_pais" id="cli_pais" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mb-3">
                <div class="col">
                    <button type="submit" id="btnGuardar" class="btn btn-primary w-100">Guardar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnBuscar" class="btn btn-info w-100">Buscar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnModificar" class="btn btn-warning w-100">Modificar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnCancelar" class="btn btn-secondary w-100">Cancelar</button>
                </div>
                <div class="col">
                    <button type="reset" id="btnLimpiar" class="btn btn-secondary w-100">Limpiar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8 table-responsive">
            <h2 class="text-center">Listado de Clientes</h2>
            <table class="table table-bordered table-hover" id="tablacliente">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>nombres</th>
                        <th>Sexo</th>
                        <th>Numero de Telefono</th>
                        <th>Pais</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7">No hay puestos disponibles</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script defer src="../../src/js/funciones.js"></script>
<script defer src="../../src/js/cliente/index.js"></script>
<?php include_once '../../includes/footer.php' ?>
<?php include_once '../../includes/header.php' ;

require '../../models/cliente.php';
$cliente = new cliente($_GET);
$clientes = $cliente->buscar();

require '../../models/mascota.php';
$mascota = new mascota($_GET);
$mascotas = $mascota->buscar();
?>

<br><br><br><br><br>
<div class="container">
    <h1 class="text-center">REGISTRO DE CITAS</h1>
    <div class="row justify-content-center mb-3">
        <form class="col-lg-8 border bg-light p-3">
            <input type="hidden" name="cit_codigo" id="cit_codigo">

            <div class="row">
                <div class="col mb-3">
                    <div class="col">
                        <label for="cit_fecha">Fecha de la Cita</label>
                        <input type="datetime-local" name="cit_fecha" id="cit_fecha" class="form-control" required>
                    </div>
                </div>
                <div class="col mb-3">
                    <div class="col">
                        <label for="cit_pais">Cita Pais</label>
                        <input type="text" name="cit_pais" id="cit_pais" class="form-control" required>
                    </div>
                </div>

            </div>

            <div class="row">

            <div class="col form-group mb-3">
                    <label for="cit_cliente">Nombre del Cliente</label>
                    <select name="cit_cliente" id="cit_cliente" class="form-control" required>
                        <option value="">SELECCIONE...</option>
                        <?php foreach ($clientes as $cliente) : ?>
                            <option value="<?= $cliente['cli_codigo'] ?>"> <?= $cliente['cli_nombre'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="col form-group mb-3">
                    <label for="cit_mascota">Nombre de la Mascota</label>
                    <select name="cit_mascota" id="cit_mascota" class="form-control" required>
                        <option value="">SELECCIONE...</option>
                        <?php foreach ($mascotas as $mascota) : ?>
                            <option value="<?= $mascota['mas_codigo'] ?>"> <?= $mascota['mas_nombre'] ?></option>
                        <?php endforeach ?>
                    </select>
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
            <h2 class="text-center">Listado de Mascotas</h2>
            <table class="table table-bordered table-hover" id="tablacita">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Cliente</th>
                        <th>Mascota</th>
                        <th>Fecha</th>
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
<script defer src="../../src/js/cita/index.js"></script>
<?php include_once '../../includes/footer.php' ?>
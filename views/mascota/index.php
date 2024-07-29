<?php include_once '../../includes/header.php' ?>

<div class="container">
    <h1 class="text-center">INGRESAR MASCOTAS</h1>
    <div class="row justify-content-center mb-3">
        <form class="col-lg-8 border bg-light p-3">
            <input type="hidden" name="mas_codigo" id="mas_codigo">
            <div class="row mb-3">
                <div class="col">
                    <label for="mas_nombre">Nombre del la mascota</label>
                    <input type="text" name="mas_nombre" id="mas_nombre" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="mas_raza">Nombre de la Raza</label>
                    <input type="text" name="mas_raza" id="mas_raza" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="mas_fecha_nacimiento">Fecha de Nacimiento</label>
                    <input type="datetime-local" name="mas_fecha_nacimiento" id="mas_fecha_nacimiento" class="form-control" required>
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
            <h2 class="text-center">Listado de mascotas</h2>
            <table class="table table-bordered table-hover" id="tablamascota">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nombre</th>
                        <th>Raza</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">No hay productos disponibles</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script defer src="/cuxum_raxcaco_ejercicio_de_practica/src/js/funciones.js"></script>
<script defer src="/cuxum_raxcaco_ejercicio_de_practica/src/js/mascota/index.js"></script>
<?php include_once '../../includes/footer.php' ?>
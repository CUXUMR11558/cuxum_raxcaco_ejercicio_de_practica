<?php
require_once 'Conexion.php';

class cita extends Conexion
{
    public $cit_codigo;
    public $cit_fecha;
    public $cit_pais;
    public $cit_cliente;
    public $cit_mascota;
    public $cit_situacion;

    public function __construct($args = [])
    {
        $this->cit_codigo = $args['cit_codigo'] ?? null;
        $this->cit_fecha = $args['cit_fecha'] ?? '';
        $this->cit_pais = $args['cit_pais'] ?? '';
        $this->cit_cliente = $args['cit_cliente'] ?? '';
        $this->cit_mascota = $args['cit_mascota'] ?? '';
    }

    public function guardar()
    {
        $sql = "INSERT INTO citas (cit_fecha, cit_pais, cit_cliente, cit_mascota) 
        values('$this->cit_fecha','$this->cit_pais','$this->cit_cliente','$this->cit_mascota')";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function MostrarInfo()
    {

        $sql = "SELECT 
    clientes.cli_nombre AS cliente_nombre,
    mascotas.mas_nombre AS mascota_nombre,
    citas.cit_fecha,
    citas.cit_pais,
    citas.cit_situacion
FROM 
    citas
INNER JOIN 
    clientes ON citas.cit_cliente = clientes.cli_codigo
INNER JOIN 
    mascotas ON citas.cit_mascota = mascotas.mas_codigo;
";

        $resultado = self::servir($sql);
        return $resultado;
    }

    public function buscar()
    {
        $sql = "SELECT * from citas where cit_situacion = 1 ";

        if ($this->cit_fecha != '') {
            $sql .= " and cit_fecha like '%$this->cit_fecha%'";
        }

        if ($this->cit_pais != '') {
            $sql .= " and cit_pais like '%$this->cit_pais%'";
        }
        if ($this->cit_cliente != '') {
            $sql .= " and cit_cliente like '%$this->cit_cliente%' ";
        }

        if ($this->cit_mascota != '') {
            $sql .= " and cit_mascota like '%$this->cit_mascota%'";
        }


        if ($this->cit_codigo != null) {
            $sql .= " and cit_codigo = $this->cit_codigo ";
        }

        $resultado = self::servir($sql);
        return $resultado;
    }

    public function modificar()
    {
        $sql = "UPDATE citas SET cit_fecha = '$this->cit_fecha', cit_pais = '$this->cit_pais', cit_cliente = '$this->cit_cliente', cit_mascota = '$this->cit_mascota' WHERE cit_codigo = $this->cit_codigo";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function eliminar()
    {
        $sql = "UPDATE citas SET cit_situacion = 0 where cit_codigo = $this->cit_codigo";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }
}

<?php
require_once 'Conexion.php';

class cita extends Conexion
{
    public $cit_codigo;
    public $cit_fecha;
    public $cit_hora;
    public $cit_cliente;
    public $cit_mascota;
    public $cit_situacion;

    public function __construct($args = [])
    {
        $this->cit_codigo = $args['cit_codigo'] ?? null;
        $this->cit_fecha = $args['cit_fecha'] ?? '';
        $this->cit_hora = $args['cit_hora'] ?? '';
        $this->cit_cliente = $args['cit_cliente'] ?? '';
        $this->cit_mascota = $args['cit_mascota'] ?? '';

    }

    public function guardar()
    {
        $sql = "INSERT INTO citas (cit_fecha, cit_hora, cit_cliente, cit_mascota) 
        values('$this->cit_fecha','$this->cit_hora','$this->cit_cliente','$this->cit_mascota')";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function buscar()
    {
        $sql = "SELECT * from citas where cit_situacion = 1 ";

        if ($this->cit_fecha != '') {
            $sql .= " and cit_fecha like '%$this->cit_fecha%'";
        }

        if ($this->cit_hora != '') {
            $sql .= " and cit_hora like '%$this->cit_hora%'";
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
        $sql = "UPDATE citas SET cit_fecha = '$this->cit_fecha', cit_hora = '$this->cit_hora', cit_cliente = '$this->cit_cliente', cit_mascota = '$this->cit_mascota' WHERE cit_codigo = $this->cit_codigo";

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

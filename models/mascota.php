<?php
require_once 'Conexion.php';

class mascota extends Conexion
{
    public $mas_codigo;
    public $mas_nombre;
    public $mas_raza;
    public $mas_fecha_nacimiento;
    public $mas_situacion;


    public function __construct($args = [])
    {
        $this->mas_codigo = $args['mas_codigo'] ?? null;
        $this->mas_nombre = $args['mas_nombre'] ?? '';
        $this->mas_raza = $args['mas_raza'] ?? '';
        $this->mas_fecha_nacimiento = $args['mas_fecha_nacimiento'] ?? '';
        $this->mas_situacion = $args['mas_situacion'] ?? '';
    }

    public function guardar()
    {
        $sql = "INSERT INTO mascotas(mas_nombre, mas_raza, mas_fecha_nacimiento ) values('$this->mas_nombre','$this->mas_raza','$this->mas_fecha_nacimiento')";
        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function buscar()
    {
        $sql = "SELECT * from mascotas where mas_situacion = 1 ";

        if ($this->mas_nombre != '') {
            $sql .= " and mas_nombre like '%$this->mas_nombre%' ";
        }

        if ($this->mas_raza != '') {
            $sql .= " and mas_raza like '%$this->mas_raza%' ";
        }
        if ($this->mas_fecha_nacimiento != '') {
            $sql .= " and mas_fecha_nacimiento like '%$this->mas_fecha_nacimiento%'";
        }

        if ($this->mas_codigo != null) {
            $sql .= " and mas_codigo = $this->mas_codigo";
        }

        $resultado = self::servir($sql);
        return $resultado;
    }

    public function modificar()
    {
        $sql = "UPDATE mascotas SET mas_nombre = '$this->mas_nombre', mas_raza = '$this->mas_raza', mas_fecha_nacimiento = '$this->mas_fecha_nacimiento' where mas_codigo = $this->mas_codigo";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function eliminar()
    {
        $sql = "UPDATE mascotas SET mas_situacion = 0 where mas_codigo = $this->mas_codigo";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }
}

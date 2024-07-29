<?php
require_once 'Conexion.php';

class cliente extends Conexion
{
    public $cli_codigo;
    public $cli_nombre;
    public $cli_sexo;
    public $cli_telefono;
    public $cli_pais;
    public $cli_situacion;

    public function __construct($args = [])
    {
        $this->cli_codigo = $args['cli_codigo'] ?? null;
        $this->cli_nombre = $args['cli_nombre'] ?? '';
        $this->cli_sexo = $args['cli_sexo'] ?? '';
        $this->cli_telefono = $args['cli_telefono'] ?? '';
        $this->cli_pais = $args['cli_pais'] ?? '';

    }

    public function guardar()
    {
        $sql = "INSERT INTO clientes (cli_nombre, cli_sexo, cli_telefono, cli_pais) 
        values('$this->cli_nombre','$this->cli_sexo','$this->cli_telefono','$this->cli_pais')";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function buscar()
    {
        $sql = "SELECT * from clientes where cli_situacion = 1 ";

        if ($this->cli_nombre != '') {
            $sql .= " and cli_nombre like '%$this->cli_nombre%'";
        }

        if ($this->cli_sexo != '') {
            $sql .= " and cli_sexo like '%$this->cli_sexo%'";
        }
        if ($this->cli_telefono != '') {
            $sql .= " and cli_telefono = $this->cli_telefono ";
        }

        if ($this->cli_pais != '') {
            $sql .= " and cli_pais like '%$this->cli_pais%'";
        }
        

        if ($this->cli_codigo != null) {
            $sql .= " and cli_codigo = $this->cli_codigo ";
        }

        $resultado = self::servir($sql);
        return $resultado;
    }

    public function modificar()
    {
        $sql = "UPDATE clientes SET cli_nombre = '$this->cli_nombre', cli_sexo = '$this->cli_sexo', cli_telefono = '$this->cli_telefono', cli_pais = '$this->cli_pais' WHERE cli_codigo = $this->cli_codigo";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }

    public function eliminar()
    {
        $sql = "UPDATE clientes SET cli_situacion = 0 where cli_codigo = $this->cli_codigo";

        $resultado = self::ejecutar($sql);
        return $resultado;
    }
}

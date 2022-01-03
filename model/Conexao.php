<?php

class Conexao
{
    public static function selectById($colunas, $tabela, $id)
    {
        $sql = "SELECT $colunas FROM $tabela WHERE id=$id;";
        $recurso = self::getConexao()->prepare($sql);
        $recurso->execute();

        return $recurso->fetchAll();
    }

    public static function update($tabela, $parametros, $id)
    {
        $sql = "UPDATE $tabela SET $parametros WHERE id=$id;";
        $recurso = self::getConexao()->prepare($sql);
        $recurso->execute();
    }

    public static function select($colunas, $tabela)
    {
        $sql = "SELECT $colunas FROM $tabela;";
        $recurso = self::getConexao()->prepare($sql);
        $recurso->execute();

        return $recurso->fetchAll();
    }

    public static function insert($tabela, $colunas, $valores)
    {
        $sql = "INSERT INTO " . $tabela . " (" . $colunas . ") VALUES  (" . $valores . ");";
        self::getConexao()->exec($sql);
        echo $sql;
    }

    public static function delete($tabela, $id)
    {
        $sql = "DELETE FROM $tabela WHERE id=$id;";
        self::getConexao()->exec($sql);
        echo $sql;
    }

    private static function getConexao()
    {
        try {
            $conexao = new PDO(
                "mysql:host=localhost;dbname=ppi4v_guloseimas",
                "ppi4v",
                "ppi42@ifrn"
            );
            $conexao->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            //echo "Deu bom";
            return $conexao;
        } catch (PDOException $e) {
            echo "Deu ruim" . $e->getMessage();
        }
    }
}

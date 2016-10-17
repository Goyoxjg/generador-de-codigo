<?php
class Database extends PDO
{
    private $_transaction;
    private $_sql;
    private $_query;
    
    public function __construct()
    {
        try 
        {
            parent::__construct(
                DB_DRIVER.':host='.DB_HOST.';
                port='.DB_PORT.';
                dbname='.DB_NAME.';
                user='.DB_USER.';
                password='.DB_PASS);
            
            //$mbd = new PDO('mysql:host=localhost;dbname=prueba', $usuario, $contraseña);
        } 
        catch(PDOException $e) 
        {
            echo 'Error al conectarse con la base de datos: ' . $e->getMessage(); 
        }
    }
    
    public function consultar($sql)
    {            
        if($this->_transaction)
            parent::beginTransaction();

        $this->_sql = $sql;
        if(!$this->_query = parent::prepare($this->_sql))
        {
            $this->getError();
        }
        else 
        {
            try
            {
                $this->_query->execute();
                if($this->_transaction)
                    parent::commit();
            }
            catch(PDOException $e) 
            {
                echo 'Error al ejecutar la consulta: ' . $e->getMessage(); 
                if($this->_transaction)
                    parent::rollBack();
            }
        }

    }

    public function getResultObj()
    {            
        if($this->getRow())
        {
            if($this->getRow() == 1)
            {
                $datos = $this->_query->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                while ($fila = $this->_query->fetch(PDO::FETCH_OBJ)) 
                {
                    $datos[]=$fila;
                }
            }
            return $datos;
        }
        else 
        {
            return false;
        }
    }

    public function getResultAssoc()
    {            
        if($this->getRow())
        {
            if($this->getRow() == 1)
            {
                $datos = $this->_query->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                while ($fila = $this->_query->fetch(PDO::FETCH_OBJ)) 
                {
                    $datos[]=$fila;
                }
            }
            return $datos;
        }
        else 
        {
            return false;
        }
    }

    public function getResult()
    {            
        if($this->getRow())
        {
            if($this->getRow() == 1)
            {
                $datos = $this->_query->fetch(PDO::FETCH_OBJ);
            }
            else
            {
                while ($fila = $this->_query->fetch(PDO::FETCH_OBJ)) 
                {
                    $datos[]=$fila;
                }
            }
            return $datos;
        }
        else 
        {
            return false;
        }
    }

    function getRow()
    {
        return $this->_query->rowCount();
    }

    function lastId($name = null)
    {
        if($name)
        {
            return parent::lastInsertId($name);
        }
        else 
        {
            return parent::lastInsertId();
        }
    }

    function begin()
    {
        $this->_transaction = true;
        //parent::beginTransaction();
    }

    function commit()
    {
        parent::commit();
    }

    function rollback()
    {
        parent::rollBack();
    }

    function statusTransaction()
    {
        return parent::inTransaction();
    }
    
    function getSql()
    {
        Herramientas::debug($this->_sql);
    }

    function codError()
    {
        echo "\nPDO::errorCode(): ", parent::errorCode();
    }
    /*
     * 0	Código de error SQLSTATE (un identificador de cinco caracteres alfanuméricos definidos según el estándar ANSI SQL).
     * 1	Código de error específico del driver.
     * 2	Mensaje del error específico del driver.
     */
    function getError()
    {
        echo "\nPDO::errorInfo():\n";
        print_r(parent::errorInfo());
    }

    public function disconnect()
    {
        $this->_db = NULL;
    }
}
?>

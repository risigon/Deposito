<?php

class Conexao 
{
    
    private static $instance = null;
    
    private static $dbType = "mysql";
     private static $host = "localhost";
    private static $user = "root";
    private static $senha = "";
    private static $db = "deposito";
    
    protected static $persistent = false;
        
    public static function getInstance() 
    {
        if(self::$persistent != FALSE)
            self::$persistent = TRUE;
        
        if(!isset(self::$instance)){
            try {            
                
                self::$instance = new \PDO(self::$dbType . ':host=' . self::$host . ';dbname=' . self::$db
                        , self::$user
                        , self::$senha
                        , array(\PDO::ATTR_PERSISTENT => self::$persistent));
                
            } catch (\PDOException $ex) {
                exit ("Erro ao conectar com o banco de dados: " . $ex->getMessage());
            }
        }
        
        return self::$instance;
        
    }
    
    public static function close() 
    {
        if (self::$instance != null)
            self::$instance = null;
    }
    
    
}
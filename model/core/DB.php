<?php
/**
 * DB
 * 
 * @package    Models
 * @subpackage Core
 */
class DB extends AutoClass
{

    private $host;
    private $user;
    private $pass;
    private $db;
    private $con;
    private $affected_rows;

    private $result_set = null;
    private $row = null;

    function __construct($host, $user, $pass, $db)
    {

        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;

        $this->con = mysql_pconnect($host, $user, $pass) or die (mysql_error());
        mysql_selectdb($db) or die (mysql_error());

    }

    function change_db($novoDB)
    {
        $this->db = $novoDB;
        mysql_selectdb($this->db) or die (mysql_error());
    }

    function query($sql)
    {
        $this->affected_rows = 0;
        $this->row = null;

        $this->result_set = mysql_query($sql) or die (mysql_error());

        $this->affected_rows = mysql_affected_rows();

        return $this->result_set;
    }

    function update($table, $fields, $values, $condition)
    {

        $f = "";
        $i = 0;
        foreach ($fields as $field)
        {
            $f .= $field."='".$values[$i++]."',";
        }
        $f = substr($f, 0, strlen($f)-1);
        
        $this->query("update $table set $f where $condition");
        return $this->affected_rows();

    }

    function insert($tabela, $campos, $valores, $retorno = null)
    {

        $i = 0;

        $c = implode(",", $campos);
        $v = "'".implode("','", $valores)."'";

        $sql = "insert into $tabela ($c) values ($v)";
        $this->query($sql);
        $n = $this->affected_rows();

        if ($retorno)
        {
            $sql = "select $retorno from $tabela order by $retorno desc limit 0,1";
            $this->query($sql);
            return $this->fetch($retorno);
        } else
        {
            return $n;
        }

    }

    function start_transaction()
    {
        $this->query("start transaction;");
    }

    function commit()
    {
        $this->query("commit;");
    }

    function rollback()
    {
        $this->query("rollback;");
    }

    function fetch($value = null)
    {
        if ($value == null)
        {
            return mysql_fetch_assoc($this->result_set);
        } else
        {
            if ($this->row == null)
                $this->row = mysql_fetch_assoc($this->result_set);
            return $this->row[$value];
    	}
	}

	function fetch_array()
	{
	    return mysql_fetch_array($this->result_set);
	}
	
	function num_rows()
	{
	    return mysql_num_rows($this->result_set);
	}
	
	function affected_rows()
	{
	    return mysql_affected_rows();
	}
	
	function result($modo = 1)
	{ //1 = ASSOC, 2 = ARRAY
	
	    $rows = array ();
		if ($modo == 1)
		{
		    $i = 0;
		while ($i < $this->num_rows())
		{
		    $rows[] = $this->fetch();
		$i++;
		}
		return $rows;
		} else
		{
		    $i = 0;
		while ($i < $this->num_rows())
		{
		    $rows[] = $this->fetch_array();
		$i++;
		}
		return $rows;
		}
	
	}
	
	function select($tabela, $parametros, $limite = array (0, 0))
	{
	
	    $where = "";
	
		$sql = "SELECT * FROM ".$tabela;
		
		foreach ($parametros as $param=>$valor)
		{
		    $where += " $param='$valor' and";
		}
		
		$where += " 1=1";
		
		//echo $limit = " limit ".$limite[0].(isset($limite[1]))?",".$limite[1]:";";
		
		echo $sql = $sql.$where;
		
		$sql;
		//Query($sql);
	
	}
	
	//retorna o �ltimo ID da tabela passada como par�metro.
	function get_last_id($tabela)
	{
	
	    $this->query("select id from $tabela order by id desc limit 0,1");
	
	return $this->fetch("id");
	
	}

}

?>

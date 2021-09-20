<?php
/**
 * @package	Database connection
 * @subpackage	Database Library
 * @author	Dibya Mitra
 */
class Database
{
	/**
	 * @var string
	 */
	private $con;

	/**
	 * @var	pointer
	 */
	private $file;

	/**
	 * @var	object
	 */
	private $config;

	/**
	 * @var	object
	 */
	private $configobj;

	/**
	 * @var	string
	 */
	private $host;

	/**
	 * @var	string
	 */
	private $databasename;

	/**
	 * @var	string
	 */
	private $username;

	/**
	 * @var	string
	 */
	private $password;

	/**
	 * @var	string
	 */
	private $url;

	/**
	 * @var	string
	 */
	private $imgurl;
	
	/**
	 * Database Constructor
	 * @param	NULL
	 * @return	string
	 */
	public function __construct()
	{
		global $con;
		global $file;
		global $config;
		global $configobj;
		global $host;
		global $databasename;
		global $username;
		global $password;
		global $url;

		$file=fopen(__DIR__.'/../config.json','r');
		$config=fgets($file);
		$configobj=json_decode($config);

		$host=$configobj->host;
		$databasename=$configobj->database;
		$username=$configobj->user;
		$password=$configobj->password;
		$url=$configobj->url;
		$con = mysqli_connect($host,$username,$password,$databasename);
	}

	/*******************************************
	 * Methods with Protected Access Modifiers *
	 *******************************************/

	/**
	 * Method to fetch Single Row from DB by generating query
	 * @param	array
	 * @param	string
	 * @param	array
	 * @return	object
	 */
	protected function selSingleRow($arr=NULL,$tablename,$where=NULL)
	{
		$res=$this->_selSingleRow($arr,$tablename,$where);
		return $res;
	}

	/**
	 * Method to fetch Single Row from DB
	 * @param	string
	 * @return	object
	 */
	protected function selSingleRowCustom($sql)
	{
		$res=$this->_selSingleRowCustom($sql);
		return $res;
	}

	/**
	 * Method to fetch Multiple Rows from DB by generating query
	 * @param	array
	 * @param	string
	 * @param	array
	 * @return	array
	 */
	protected function selMultipleRow($arr=NULL,$tablename,$where=NULL)
	{
		$res=$this->_selMultipleRow($arr,$tablename,$where);
		return $res;
	}

	/**
	 * Method to fetch Multiple Rows from DB
	 * @param	string
	 * @return	array
	 */
	protected function selMultipleRowCustom($sql)
	{
		$res=$this->_selMultipleRowCustom($sql);
		return $res;
	}

	/**
	 * Method to insert/update/delete by generating query
	 * @param	array
	 * @param	string
	 * @param	array
	 * @param	char
	 * @return	bool
	 */
	protected function userQuery($fieldvar=NULL,$tablename,$condition=NULL,$task)
	{
		$res=$this->_userQuery($fieldvar,$tablename,$condition,$task);
		return $res;
	}

	/**
	 * Method to insert/update/delete
	 * @param	string
	 * @return	bool
	 */
	protected function userQueryCustom($sql)
	{
		$res=$this->_userQueryCustom($sql);
		return $res;
	}

	/**
	 * Method to run procedure
	 * @param	string
	 * @return	string
	 */
    protected function runAnyProcedure($sql)
    {
		$res=$this->_runAnyProcedure($sql);
		return $res;
    }

    /**
     * Method to fetch the baseurl from config
     * @param   string
     * @return  string
     */
	protected static function baseurl($path=NULL)
    {
		$res=self::base_url($path);
		return $res;
    }

	/*****************************************
	 * Methods with Private Access Modifiers *
	 *****************************************/

	/**
	 * Method to fetch Single Row from DB by generating query
	 * @param	array
	 * @param	string
	 * @param	array
	 * @return	object
	 */
	private function _selSingleRow($arr=NULL,$tablename,$where=NULL)
	{
		global $con;
		if(!empty($arr))
		{
			$selstr=implode(",",$arr);
		}
		else
		{
			$selstr="*";
		}
		if(!empty($where))
		{
			$wherearr=array();
			foreach($where as $wherekey=>$whereval)
			{
				$wherearr[] = $wherekey."='".$whereval."'";
			}
			$wherestr=" where ".implode(' AND ',$wherearr);
		}
		else
		{
			$wherestr="";
		}
		$sql="select ".$selstr." from `".$tablename."`".$wherestr;
		$query=mysqli_query($con,$sql);

		$result=mysqli_fetch_object($query);
		if(!empty($result))
		{
			return $result;
		}
		else
		{
			return;
		}
	}

	/**
	 * Method to fetch Single Row from DB
	 * @param	string
	 * @return	object
	 */
	private function _selSingleRowCustom($sql)
	{
		global $con;
		$query=mysqli_query($con,$sql);

        $result=mysqli_fetch_object($query);
        mysqli_free_result($query);
        if(mysqli_more_results($con))
        {
            mysqli_next_result($con);
        }
		if(!empty($result))
		{
			return $result;
		}
		else
		{
			return;
		}
	}

	/**
	 * Method to fetch Multiple Rows from DB by generating query
	 * @param	array
	 * @param	string
	 * @param	array
	 * @return	array
	 */
	private function _selMultipleRow($arr=NULL,$tablename,$where=NULL)
	{
		global $con;
		if(!empty($arr))
		{
			$selstr=implode(",",$arr);
		}
		else
		{
			$selstr="*";
		}
		if(!empty($where))
		{
			$wherearr=array();
			foreach($where as $wherekey=>$whereval)
			{
				$wherearr[] = $wherekey."='".$whereval."'";
			}
			$wherestr=" where ".implode(' AND ',$wherearr);
		}
		else
		{
			$wherestr="";
		}
		$sql="select ".$selstr." from `".$tablename."`".$wherestr;
		$query=mysqli_query($con,$sql);

		$result=array();
		while($res=mysqli_fetch_object($query))
		{
			$result[]=$res;
		}
		if(!empty($result))
		{
			return $result;
		}
		else
		{
			return;
		}
	}

	/**
	 * Method to fetch Multiple Rows from DB
	 * @param	string
	 * @return	array
	 */
	private function _selMultipleRowCustom($sql)
	{
		global $con;
        $query=mysqli_query($con,$sql);
		
		$result=array();
		while($res=mysqli_fetch_object($query))
		{
			$result[]=$res;
        }
        mysqli_free_result($query);
        if(mysqli_more_results($con))
        {
            mysqli_next_result($con);
        }
		
		if(!empty($result))
		{
			return $result;
		}
		else
		{
			return;
		}
	}

	/**
	 * Method to insert/update/delete by generating query
	 * @param	array
	 * @param	string
	 * @param	array
	 * @param	char
	 * @return	bool
	 */
	private function _userQuery($fieldvar=NULL,$tablename,$condition=NULL,$task)
	{
		global $con;

		if(!empty($fieldvar))
		{
			$fieldvararr=array();
			foreach($fieldvar as $fieldvarkey=>$fieldvarval)
			{
				$fieldvararr[]=$fieldvarkey."='".$fieldvarval."'";
			}
			$fieldvarstr=implode(",",$fieldvararr);
		}

		if(!empty($condition))
		{
			$conditionarr=array();
			foreach($condition as $conditionkey=>$conditionval)
			{
				$conditionarr[]=$conditionkey."='".$conditionval."'";
			}
			$conditionstr=" where ".implode(" AND ",$conditionarr);
		}
		else
		{
			$conditionstr="";
		}

		if($task=="i" or $task=="I")
		{
			//insert
			$sql="insert into `".$tablename."` set ".$fieldvarstr;
		}
		if($task=="u" or $task=="U")
		{
			//update
			$sql="update `".$tablename."` set ".$fieldvarstr.$conditionstr;
		}
		if($task=="d" or $task=="D")
		{
			//delete
			$sql="delete from `".$tablename."`".$conditionstr;
		}
		$query=mysqli_query($con,$sql);
		if(!empty($query))
		{
			if($task=="I" or $task=="i")
			{
				$lastid=mysqli_insert_id($con);
				return $lastid;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			return;
		}
	}

	/**
	 * Method to insert/update/delete
	 * @param	string
	 * @return	bool
	 */
	private function _userQueryCustom($sql)
	{
		global $con;
        $query=mysqli_query($con,$sql);
        mysqli_free_result($query);
        if(mysqli_more_results($con))
        {
            mysqli_next_result($con);
        }
		if(!empty($query))
		{
			$lastid=mysqli_insert_id($con);
			if(!empty($lastid))
			{
				return $lastid;
			}
			else
			{
				return 1;
			}
		}
		else
		{
			return;
		}
	}

	/**
	 * Method to run procedure
	 * @param	string
	 * @return	string
	 */
    private function _runAnyProcedure($sql)
    {
        global $con;
        $query=mysqli_query($con,$sql);
        $result=mysqli_fetch_object($query);
        mysqli_free_result($query);
        if(mysqli_more_results($con))
        {
            mysqli_next_result($con);
        }
		if(!empty($result))
		{
			return $result;
		}
		else
		{
			return;
		}
    }	

	/**
     * Method to fetch the baseurl from config
     * @param   string
     * @return  string
     */
	private static function base_url($path=NULL)
    {
		global $url;
        $fullurl=$url.$path;
        return $fullurl;
	}

	/**
	 * Database Destructor
	 */
	public function __destruct()
	{
		global $con;
		$con->close();
	}
}
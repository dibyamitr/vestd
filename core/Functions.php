<?php
require_once 'Database.php';
/**
 * @package Custom Method Library
 * @subpackage  Library extending Database
 * @author  Dibya Mitra
 */
class Functions extends Database
{
    /**
	 * Method to fetch Single Row from DB by generating query
	 * @param	array
	 * @param	string
	 * @param	array
	 * @return	object
	 */
    public function selSingleRow($arr=NULL,$tablename,$where=NULL)
    {
        $res=parent::selSingleRow($arr,$tablename,$where);
        return $res;
    }

    /**
	 * Method to fetch Single Row from DB
	 * @param	string
	 * @return	object
	 */
    public function selSingleRowCustom($sql)
    {
        $res=parent::selSingleRowCustom($sql);
        return $res;
    }

    /**
	 * Method to fetch Multiple Rows from DB by generating query
	 * @param	array
	 * @param	string
	 * @param	array
	 * @return	array
	 */
    public function selMultipleRow($arr=NULL,$tablename,$where=NULL)
    {
        $res=parent::selMultipleRow($arr,$tablename,$where);
        return $res;
    }

    /**
	 * Method to fetch Multiple Rows from DB
	 * @param	string
	 * @return	array
	 */
    public function selMultipleRowCustom($sql)
    {
        $res=parent::selMultipleRowCustom($sql);
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
    public function userQuery($fieldvar=NULL,$tablename,$condition=NULL,$task)
    {
        $res=parent::userQuery($fieldvar,$tablename,$condition,$task);
        return $res;
    }

    /**
	 * Method to insert/update/delete
	 * @param	string
	 * @return	bool
	 */
    public function userQueryCustom($sql)
    {
        $res=parent::userQueryCustom($sql);
        return $res;
    }

    /**
	 * Method to run procedure
	 * @param	string
	 * @return	string
	 */
    public function runAnyProcedure($sql)
    {
		$res=parent::runAnyProcedure($sql);
		return $res;
    }

    /**
     * Method to call api
     * @param   string
     * @param   string
     * @param   array
     * @return  json
     */
    public function curlResponse($method, $url, $data)
    {
        $curl = curl_init();

        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, "POST");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
                break;
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
    }

    /**
     * Method to pint array in formatted way
     * @param   array
     * @return  string
     */
    public static function pr($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    /**
     * Method to redirect to an url
     * @param   string
     */
    public static function redirect($url)
    {
        header("location:".$url);
        exit;
    }

    /**
     * Method to redirect or to return previous page url
     * @param   string
     * @return  string
     */
    public static function prevurl($chk=NULL)
    {
        $url=$_SERVER['HTTP_REFERER'];
        if(!isset($chk))
        {
            header("location:".$url);
            exit;
        }
        else
        {
            return $url;
        }
    }

    /**
     * Method to return the baseurl
     * @param   string
     * @return  string
     */
    public static function baseurl($path=NULL)
    {
        $res=parent::baseurl($path);
        return $res;
    }

    /**
     * Method for Ajax Response
     * @param   string
     * @param   string
     * @param   string
     * @param   array
     * @return   object
     */
    public static function sendAjaxResponse($resptype,$msg,$url=NULL,$param=array())
    {
        $response=array('status'=>$resptype,'msg'=>$msg);
        if(isset($url) and !empty($url))
        {
            $response['url']=$url;
        }
        if(isset($param) and !empty($param))
        {
            $response['param']=$param;
        }
        echo json_encode($response);
        exit;
    }
}
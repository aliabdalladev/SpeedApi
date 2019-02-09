<?php


class DBase  {


    private $db_host;
    private $db_user;
    private $db_pass;
    private $db_driver;
    private $db_name;


    public $dbconn;

    function  __construct()
    {
        // connet to db
        $this->handel_db_vars();
        $this->connect();

    }


    function  __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->close_connection();
    }




    private function handel_db_vars(){

        $this->db_host = env("DB_HOST");
        $this->db_user = env("DB_USER");
        $this->db_pass = env("DB_PASS");
        $this->db_driver = env("DB_DRIV");
        $this->db_name = env("DB_NAME");
    }



    private function connect(){


        $this->dbconn = new PDO($this->db_driver.':host='.$this->db_host.';dbname='.$this->db_name, $this->db_user, $this->db_pass);




        if($this->dbconn->errorCode()!=null){
            return false;
        }

        $this->dbconn->exec("set names utf8 ");

    }



    private  function  close_connection(){
        $this->dbconn = null;
    }




    protected function DB_Query($sql,$params = []){


    }



    protected function DB_Fetch_Grid($table = "users", $orderBy = ["clm"=>"id","case"=>"desc"], $colums = "*"){
        $stmt = $this->dbconn->prepare("SELECT {$colums} FROM {$table} ORDER BY {$orderBy['clm']} {$orderBy['case']}");
        $stmt->execute();

        $resposne = [];
        if($stmt->rowCount()>=1){
            foreach ($stmt->fetch() as $item) {
                $resposne[] = $item;

            }
        }


        return $resposne;
    }

}

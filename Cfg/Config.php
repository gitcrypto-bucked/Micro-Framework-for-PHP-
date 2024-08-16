<?php
declare(strict_types=1);

namespace Cfg;

ini_set('allow_url_fopen','1');
date_default_timezone_set('America/Sao_Paulo');
define("ROOT", dirname(__DIR__,1).DIRECTORY_SEPARATOR);  
header("Access-Control-Allow-Origin: *");

use \App\Controller\Maintenance as Maintenance;

class Config
{ 
	const DEBUG			= false;
	const SHOW_ERRORS	= true;
	const LOG_ERRORS	= false;

    const KEY_64 = 'wK0dNhSrcgcyrOwbg7JN8BIituVTiq9O2wL2Ze7xZ5w=';

    const MAINTENANCE = 100;
    const NORMAL= 200;
    const DEPLOY = 150;

    const SESSION = 3; //value in hours

    const DOMAIN = 'http://localhost';

    const FOLDER = 'fmk';

    const PATH = 'C:'. DIRECTORY_SEPARATOR .'xampp'. DIRECTORY_SEPARATOR .'htdocs'. DIRECTORY_SEPARATOR .self::FOLDER. DIRECTORY_SEPARATOR ;

    const ASSETS = "assets";

    const CSS='css';

    const SERVER = self::DOMAIN.'/'.self::FOLDER.'/';

    const ASSETS_PATH = self::FOLDER. DIRECTORY_SEPARATOR .self::ASSETS.DIRECTORY_SEPARATOR ;

    const ASSETS_URL = self::DOMAIN.'/'.self::FOLDER.'/'.'App/Views'."/".self::ASSETS;

    const REQ_URL=self::DOMAIN.':'.self::PORT.'/'.self::FOLDER;

	const PORT= 8080;

    const DATABASE_DRIVER ='mysql';

    const DB_HOST ='127.0.0.1';

    const DB_NAME ='cdbi';

    const DB_USER ='root';

    const DB_PASSWORD ='fast9002';

    const RESULTS_PER_PAGE = 18;

    const TEMPLATE ='.nano.php';


    final function bootstrap($init)
    {       
        switch($init)
        {
            case self::MAINTENANCE:
                new Maintenance(); exit;
            break;
            case self::DEPLOY:  case self::NORMAL:
                if(self::SHOW_ERRORS ==true)
                {
                    ini_set('display_errors', '1');
                    ini_set('display_startup_errors', '1');
                    error_reporting(E_ALL);
                }
                else
                {
                    ini_set('display_errors', '0');
                    ini_set('display_startup_errors', '0');
                    error_reporting(0);
                }
            break;
        }
    }

    public function __construct($init)
    {      
        $this->bootstrap($init);
    }
	

}


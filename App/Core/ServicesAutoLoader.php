<?php

namespace Timino\App\Core;

use PHPMailer\PHPMailer\Exception;
use Timino\App\Core\Abstraction\ServiceProviderInterface;
use Timino\App\Services\Template\ErrorTemplator;

class ServicesAutoLoader implements ServiceProviderInterface
{
    /**
     * @var array services to be registered
     */
    private $services = array();

    /**
     * ServiceLoader constructor.
     * start the Service aoto loader
     */
    public function __construct()
    {
        $this->set();
    }

    /**
     * @return array scan services directory
     */
    private function scanServices()
    {
        $rii = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator(APP . "Services" . DS));

        $files = array();
        foreach ($rii as $file)
            if (!$file->isDir())
                $files[] = $file->getPathname();
        return $files;
    }


    /**
     * set()
     * register services
     * single tone with instantiate()
     * simple services with the new keyword
     */
    public function set()
    {
        // remove php extension
        $services = array_map(function($elem){
            return preg_replace("/\.php$/", NULL, $elem);
        }, $this->scanServices());

        // explode services to an array and remove base directories /var/www
        for($i = 0; $i < sizeof($services); $i++)
        {
            $explodeServices[] = explode("/", $services[$i]);
            // unset var & www
            unset($explodeServices[$i][0],$explodeServices[$i][1],$explodeServices[$i][2]);
        }

        // set each service with name and
        // replace directory separator with namespace separator
        foreach($explodeServices as $service)
        {
            $ucfirstServices = array_map( function($elem){ return ucfirst($elem); } ,array_values($service));

            $servicesNames[]   = $ucfirstServices[count($ucfirstServices) -1];

            $srv[] =  implode("/",$ucfirstServices);
            $servicesNamespaces = array_map(function($elem){
                $elem = preg_replace("#\/#", "\\", $elem);
                return "\\".$elem;
            }, $srv);
        }

        // each service with name as key and namespace as value
        $services = array_combine($servicesNames, $servicesNamespaces);


        /**
         * check for single tone classes and normal classes with reflection class
         * set instantiate single tone with ::instantiate() and normal with new
         * and save services to $this->services array;
         */
        foreach($services as $srvName => $service)
        {
            try{

                if(!class_exists($service)) throw new  \Exception("Error <b>$service</b> Service <b>class</b> doesn't exists !");

                $class = new \ReflectionClass($service);

                 if($class->hasMethod("instantiate"))
                 {
                     $this->services[$srvName] = (!isset($this->services[$srvName])) ? $this->services[$srvName] = $service::instantiate
                     () : NULL;

                 }else{

                     $this->services[$srvName] = (!isset($this->services[$srvName])) ? $this->services[$srvName] = new $service() : NULL;
                 }


            }catch(\Exception $e)
            {
                die(ErrorTemplator::exceptionError($e->getMessage()));
            }

        }

    }

    /**
     * @param $serviceName
     * @return mixed
     */
    public function get($serviceName)
    {
        try{
            $serviceName = ucfirst($serviceName);
            if(!isset($this->services[$serviceName]))  throw new Exception("Error service <b>$serviceName</b> Doesn't exists !");
            return $this->services[$serviceName];
        }catch(\Exception $e){

            die(ErrorTemplator::exceptionError($e->getMessage()));
        }
    }
}
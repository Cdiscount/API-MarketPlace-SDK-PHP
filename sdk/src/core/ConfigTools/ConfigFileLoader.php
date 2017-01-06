<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 22/09/2016
 * Time: 15:10
 */

namespace Sdk\ConfigTools;

use Zend\Config\Exception\InvalidArgumentException;

class ConfigFileLoader
{

    #region Private attributes

    /**
     * @var Singleton $instance
     */
    private static $_instance = null;

    /**
     * @var Data in the config file
     */
    private $_fileData = null;

    /**
     * @var String Api mode to load the specific environnement config file (recette,preprod,prod)
     */
    private $_apiMode = null;


    /**
     * @var \Zend\Validator\NotEmpty for string
     */
    private $_zendValidator = null;

    #endregion Private attributes

    #region Constructor

    private function __construct() {

        $this->_zendValidator = new \Zend\Validator\NotEmpty();
        $this->_loadConfFile();
    }

    #endregion Constructor

    #region Singleton

    /**
     * Return a unique instance of the token class, initiate it if needed
     * @return ConfigFileLoader
     */
    public static function getInstance() {

        if (is_null(self::$_instance)) {
            self::$_instance = new ConfigFileLoader();
        }
        return self::$_instance;
    }

    #endregion Singleton

    #region LoadConfigFile

    /**
     * Load the default config file and after load the environnement config file
     */
    private function _loadConfFile() {

        $reader = new \Zend\Config\Reader\Ini();

        $configFile = $reader->fromFile(__DIR__ . '/../../../../config/config.ini');

        //TODO gestion des erreurs
        $this->_apiMode = $configFile['api']['mode'];

        $this->_fileData = $reader->fromFile(__DIR__ . '/../../../../config/' . $this->_apiMode . '.config.ini');

        //echo $this->_fileData['api']['username'];
    }

    #endregion LoadConfigFile

    #region public methods

    public function getConfAttribute($attr) {
        return $this->_fileData['api'][$attr];
    }

    #endregion public methods

}
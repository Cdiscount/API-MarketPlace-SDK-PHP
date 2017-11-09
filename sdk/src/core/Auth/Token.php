<?php
/**
 * Created by CDiscount
 * User: CDiscount
 * Date: 22/09/2016
 * Time: 12:09
 */

namespace Sdk\Auth;

use Sdk\ConfigTools\ConfigFileLoader;
use Sdk\HttpTools\CDSApiRequest;
use Zend\Db\Sql\Ddl\Column\Datetime;

/**
 * Class Token
 *
 * @package Auth
 */
class Token
{
    #region Private attributes

    /**
     * @var Singleton $instance
     */
    private static $_instance = null;

    /**
     * @var bool true if the token is valid
     */
    private $_isValid = false;

    /**
     * @var \DateTime date and time of the token request
     */
    private $_initdate = null;

    /**
     * @var string Token to communicate with the API
     */
    private $_token = null;

    #endregion Private attributes

    #region Constructor

    /**
     * Token constructor.
     */
    private function __construct()
    {
        $this->_isValid = false;
        $this->_initdate = false;
    }

    #endregion Constructor

    #region Singleton

    /**
     * Return a unique instance of the token class, initiate it if needed
     * @return Token
     */
    public static function getInstance()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new Token();
        }
        return self::$_instance;
    }

    #endregion Singleton

    #region Private methods

    private function _generateNewToken()
    {
        $username = ConfigFileLoader::getInstance()->getConfAttribute('username');
        $password = ConfigFileLoader::getInstance()->getConfAttribute('password');
        $urlToken = ConfigFileLoader::getInstance()->getConfAttribute('urltoken');

        $request = new CDSApiRequest($username, $password, $urlToken);

        libxml_use_internal_errors(true);
        $xmlResult = simplexml_load_string($request->execute());

        //TODO gestion erreur token

        if ($xmlResult !== false && isset($xmlResult[0]) && ctype_alnum(strval($xmlResult[0]))) {
            $this->_token = $xmlResult[0];

            if ($this->_token != null && $this->_token) {
                $this->_isValid = true;
                $this->_initdate = new Datetime();
            }
        }
    }

    #endregion Private methods

    #region Public methods

    /**
     * Generate a new token or return the actual active token
     */
    public function getToken()
    {
        //TODO vérifier la date

        if (!$this->_isValid) {
            $this->_generateNewToken();
        }
        return $this->_token;
    }

    /**
     * @return bool
     */
    public function isTokenValid()
    {
        return $this->_isValid;
    }

    #endregion Public methods
}
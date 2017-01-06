<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 03/11/2016
 * Time: 09:26
 */

namespace Sdk\Common;


class Filter
{
    private $_beginCreationDate = null;

    /**
     * @return 'AAAA-MM-DDTHH:MM:SS' $beginCreationDate
     */
    public function getBeginCreationDate()
    {
        return $this->_beginCreationDate;
    }

    /**
     * @param 'AAAA-MM-DDTHH:MM:SS' $beginCreationDate
     */
    public function setBeginCreationDate($beginCreationDate)
    {
        $this->_beginCreationDate = $beginCreationDate;
    }

    /**
     * @var null
     */
    private $_beginModificationDate = null;

    /**
     * @return null
     */
    public function getBeginModificationDate()
    {
        return $this->_beginModificationDate;
    }

    /**
     * @param null $beginModificationDate
     */
    public function setBeginModificationDate($beginModificationDate)
    {
        $this->_beginModificationDate = $beginModificationDate;
    }

    private $_endCreationDate = null;

    /**
     * @return null
     */
    public function getEndCreationDate()
    {
        return $this->_endCreationDate;
    }

    /**
     * @param null $endCreationDate
     */
    public function setEndCreationDate($endCreationDate)
    {
        $this->_endCreationDate = $endCreationDate;
    }

    private $_endModificationDate = null;

    /**
     * @return null
     */
    public function getEndModificationDate()
    {
        return $this->_endModificationDate;
    }

    /**
     * @param null $endModificationDate
     */
    public function setEndModificationDate($endModificationDate)
    {
        $this->_endModificationDate = $endModificationDate;
    }
}
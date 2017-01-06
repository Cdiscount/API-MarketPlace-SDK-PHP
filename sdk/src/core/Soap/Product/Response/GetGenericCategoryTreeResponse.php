<?php
/**
 * Created by CDiscount
 * Created by CDiscount
 * Date: 16/11/2016
 * Time: 16:26
 */

namespace Sdk\Soap\Product\Response;


use Sdk\Product\CategoryTree;
use Sdk\Soap\Common\iResponse;

class GetGenericCategoryTreeResponse extends iResponse
{
    /**
     * @var array
     */
    protected $_dataResponse = null;

    /**
     * @var \Sdk\Product\CategoryTree
     */
    private $_rootCategoryTree = null;

    /**
     * @return \Sdk\Product\CategoryTree
     */
    public function getRootCategoryTree()
    {
        return $this->_rootCategoryTree;
    }

    /**
     * @param $categoryTree
     */
    protected function _addRootCategoryTree($categoryTree) {

        $this->_rootCategoryTree = new CategoryTree();
        $this->_rootCategoryTree->setCode($categoryTree['Code']);
        $this->_rootCategoryTree->setName($categoryTree['Name']);

        foreach ($categoryTree['ChildrenCategoryList']['CategoryTree'] as $childTree) {

            $child = $this->_setChildrenCategoryList($childTree);
            $this->_rootCategoryTree->addChild($child);
        }
    }

    /**
     * @param $categoryTree
     * @return CategoryTree
     */
    private function _setChildrenCategoryList($categoryTree)
    {
        $categoryTreeObj = new CategoryTree();
        $categoryTreeObj->setCode($categoryTree['Code']);
        $categoryTreeObj->setName($categoryTree['Name']);

        if ($categoryTree['AllowOfferIntegration'] == 'true') {
            $categoryTreeObj->setAllowOfferIntegration(true);
        }
        if ($categoryTree['AllowProductIntegration'] == 'true') {
            $categoryTreeObj->setAllowProductIntegration(true);
        }

        if (is_array($categoryTree['ChildrenCategoryList']) && isset($categoryTree['ChildrenCategoryList']['CategoryTree'])) {

            if (isset($categoryTree['ChildrenCategoryList']['CategoryTree']['AllowOfferIntegration'])) {
                $child = $this->_setChildrenCategoryList($categoryTree['ChildrenCategoryList']['CategoryTree']);
                $categoryTreeObj->addChild($child);
            }
            else {
                foreach ($categoryTree['ChildrenCategoryList']['CategoryTree'] as $childTree) {
                    $child = $this->_setChildrenCategoryList($childTree);
                    $categoryTreeObj->addChild($child);
                }
            }
        }

        return $categoryTreeObj;
    }
}
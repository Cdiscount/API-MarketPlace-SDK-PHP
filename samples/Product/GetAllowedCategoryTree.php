<?php
/**
 * Created by guillaume.cochard.
 * Mail: guillaume.cochard@ext.cdiscount.com
 * Date: 20/10/2016
 * Time: 14:42
 */

require '../../vendor/autoload.php';
require '../../sdk/autoload.php';

error_reporting(-1);

$client = new \Sdk\ApiClient\CDSApiClient();
$token = $client->init();

if ($token == null || !$client->isTokenValid()) {
    echo "Oups, souci lors de la génération du token";
    die;
}

$productPoint = $client->getProductPoint();

/******* GET ALLOWED CATEGORY TREE *******/

$getAllowedCategoryTreeResponse = $productPoint->getAllowedCategoryTree();

function displayCategoryTree($categoryTreeRoot, $level, $client, $productPoint) {

    echo "<br/>";

    $cnt = 0;

    while ($cnt <= $level) {
        echo "....";
        ++$cnt;
    }

    /** @var \Sdk\Product\CategoryTree $categoryTreeRoot */
    echo "Level : " . $level .
        " Code : " . $categoryTreeRoot->getCode() .
        " - Name : " . $categoryTreeRoot->getName() .
        " - AllowOfferIntegration:  " . ($categoryTreeRoot->isAllowOfferIntegration() ? 'true' : 'false') .
        " - AllowProductIntegration:  " . ($categoryTreeRoot->isAllowProductIntegration() ? 'true' : 'false') .
        "<br/>";

    /** @var \Sdk\Product\CategoryTree $catTree */
    foreach ($categoryTreeRoot->getChildrenCategoryList() as $catTree) {
        displayCategoryTree($catTree, (int)$level + 1, $client, $productPoint);
    }

}

if ($getAllowedCategoryTreeResponse->hasError()) {
    echo "Error : " . $getAllowedCategoryTreeResponse->getErrorMessage();
}
else {

    $categoryTreeRoot = $getAllowedCategoryTreeResponse->getRootCategoryTree();

    /**
     * Display category tree
     */
    displayCategoryTree($categoryTreeRoot, 0, $client, $productPoint);
}

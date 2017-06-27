<?php
/* 
 * Created by Cdiscount
 * Date : 24/04/2017
 * Time : 15:02
 */
namespace Sdk\Fulfilment;

abstract class FbcReferencementFilter
{
    const All = 'All';
    const OnlyReferenced = 'OnlyReferenced';
    const OnlyNotReferenced = 'OnlyNotReferenced';
}
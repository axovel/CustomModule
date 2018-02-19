<?php
/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Custom\Disclaimer\Controller\Currency;

class SwitchAction extends \Magento\Directory\Controller\Currency\SwitchAction
{
    /**
     * @return void
     */
    public function execute()
    {
        /** @var \Magento\Store\Model\StoreManagerInterface $storeManager */
        $storeManager = $this->_objectManager->get('Magento\Store\Model\StoreManagerInterface');
        $currency = (string)$this->getRequest()->getParam('currency');
        if ($currency) {
            $storeManager->getStore()->setCurrentCurrencyCode($currency);
        }
        $storeUrl = $storeManager->getStore()->getBaseUrl();

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $catalogSession = $objectManager->create('Magento\Catalog\Model\Session');
        $catalogSession->setCurrencyDisclaimer('set');
        $this->getResponse()->setRedirect($this->_redirect->getRedirectUrl($storeUrl));
    }
}

<?php
namespace Casestudy\Greeting\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Index extends Action
{
    protected $scopeConfig;

    public function __construct(Context $context, ScopeConfigInterface $scopeConfig)
    {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
    }

    public function execute()
    {
        $greetingText = $this->scopeConfig->getValue('casestudy/general/greeting_text', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->set(__('Casestudy Greeting'));
        $block = $resultPage->getLayout()->getBlock('casestudy_greeting');
        if ($block) {
            $block->setData('greeting_text', $greetingText);
        }
        return $resultPage;
    }
}
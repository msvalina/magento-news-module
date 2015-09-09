<?php

class Inchoo_Newwssii_Model_News extends Mage_Core_Model_Abstract

{

    protected function _construct()
    {
        $this->_init('inchoo_newwssii/news');
        Mage::log("lets log something", null, 'news.log', true);
    }


    public function getNewsComments()
    {
        return $this->getResource()->getNewsComments($this->getId());

    }


    public function sendAdminNotificationEmail()
    {
        $helper = Mage::helper('inchoo_newwssii/email');

        try {
            // Set all required params and send emails
            /** @var $mailer Mage_Core_Model_Email_Template_Mailer */
            $emailInfo = Mage::getModel('core/email_info');
            $emailInfo->addTo('m@n.loc', 'testni test');

            $emailQueue = Mage::getModel('core/email_queue');
            $emailQueue->setEntityId($this->getId())
                ->setEntityType('news')
                ->setEventType('new_news')
                ->setIsForceCheck(true);

            $mailer = Mage::getModel('core/email_template_mailer');
            $mailer->addEmailInfo($emailInfo);
            $mailer->setSender([
                'email' => 'noreply@magento.loc',
                'name' => 'automated'
            ]);
            $mailer->setStoreId(Mage::app()->getStore()->getId());
            $mailer->setTemplateId($helper->getEmailTemplate());
            $mailer->setTemplateParams(array(
                'comment' => Mage::registry('current_comment')
            ));

            $mailer->setQueue($emailQueue)->send();

        } catch (Exception $e) {
            Mage::logException($e);
        }
    }
}
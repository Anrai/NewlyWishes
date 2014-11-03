<?php
namespace NW\PaypalExpressCheckoutBundle\Controller;

use NW\PaymentBundle\Model\PaymentDetails;
use Payum\Core\Security\GenericTokenFactoryInterface;
use Payum\Paypal\ExpressCheckout\Nvp\Api;
use Payum\Core\Registry\RegistryInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Extra;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\HttpFoundation\Response;

class PurchaseController extends Controller
{
    /**
     * @Extra\Route(
     *   "/prepare_purchase",
     *   name="nw_paypal_express_checkout_prepare_purchase"
     * )
     * 
     * @Extra\Template("NWPaypalExpressCheckoutBundle:Purchase:nwprepare.html.twig")
     */
    public function preparePurchaseAction(Request $request)
    {
        $paymentName = 'paypal_express_checkout_and_doctrine_orm';
        
        $form = $this->createPurchaseForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $data = $form->getData();

            $storage = $this->getPayum()->getStorage('NW\PaymentBundle\Entity\PaymentDetails');

            /** @var $paymentDetails PaymentDetails */
            $paymentDetails = $storage->createModel();
            $paymentDetails['PAYMENTREQUEST_0_CURRENCYCODE'] = $data['currency'];
            $paymentDetails['PAYMENTREQUEST_0_AMT'] = $data['amount'];

            $paymentDetails['L_PAYMENTREQUEST_0_NAME0'] = "Ejemplo de artículo";
            $paymentDetails['L_PAYMENTREQUEST_0_QTY0'] = 1;
            $paymentDetails['L_PAYMENTREQUEST_0_AMT0'] = 1;

            $storage->updateModel($paymentDetails);

            $captureToken = $this->getTokenFactory()->createCaptureToken(
                $paymentName,
                $paymentDetails,
                'nw_payment_details_view'
            );

            $paymentDetails['RETURNURL'] = $captureToken->getTargetUrl();
            $paymentDetails['CANCELURL'] = $captureToken->getTargetUrl();
            $paymentDetails['INVNUM'] = $paymentDetails->getId();
            $storage->updateModel($paymentDetails);

            return $this->redirect($captureToken->getTargetUrl());
        }

        return array(
            'form' => $form->createView(),
            'paymentName' => $paymentName
        );
    }

    /**
     * @return \Symfony\Component\Form\Form
     */
    protected function createPurchaseForm()
    {
        return $this->createFormBuilder()
            ->add('amount', null, array(
                'data' => 1,
                'constraints' => array(new Range(array('max' => 2)))
            ))
            ->add('currency', null, array('data' => 'USD'))
            ->getForm()
        ;
    }

    /**
     * @return RegistryInterface
     */
    protected function getPayum()
    {
        return $this->get('payum');
    }

    /**
     * @return GenericTokenFactoryInterface
     */
    protected function getTokenFactory()
    {
        return $this->get('payum.security.token_factory');
    }
}
<?php
namespace NW\PaymentBundle\Controller;

use Payum\Bundle\PayumBundle\Controller\PayumController;
use Payum\Core\Exception\RequestNotSupportedException;
use Payum\Core\Model\OrderInterface;
use Payum\Core\Request\GetHumanStatus;
use Payum\Core\Request\Sync;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DetailsController extends PayumController
{
    public function viewAction(Request $request)
    {
        // Seguridad, token y estado
        $token = $this->getHttpRequestVerifier()->verify($request);
        
        $payment = $this->getPayum()->getPayment($token->getPaymentName());

        try {
            $payment->execute(new Sync($token));
        } catch (RequestNotSupportedException $e) {}
        
        $payment->execute($status = new GetHumanStatus($token));

        // Qué hacer según el estado
        if ($status->isCaptured()) {

            $details = iterator_to_array($status->getModel());

            $em = $this->getDoctrine()->getEntityManager();

            // Se tiene que iterar cada regalo comprado
            $cantidadDeRegalos = $details["PAYMENTREQUEST_0_CUSTOM"];
            for ($i=0; $i < $cantidadDeRegalos; $i++) {

                // Para cada uno se multiplica la cantidad por el precio del regalo
                $cantidad = $details["L_PAYMENTREQUEST_0_QTY".$i];
                $precio = $details["L_PAYMENTREQUEST_0_AMT".$i];
                $amount = $cantidad * $precio;

                // A ese dato se le resta el 3.5%
                $aumentoSaldo = $amount * 0.965;

                // Se obtiene el usuario dueño del objeto
                $itemId = $details["L_PAYMENTREQUEST_0_NUMBER".$i];

                
                $mesaRegalosEntity = $em->getRepository('NWPrincipalBundle:MesaRegalos');
                $regaloObject = $mesaRegalosEntity->find($itemId);
                $usuarioObject = $regaloObject->getUser();

                // Se obtiene el saldo del usuario y se le suma la cantidad final
                $saldoViejo = $usuarioObject->getSaldo();
                $saldoNuevo = $saldoViejo + $aumentoSaldo;
                $usuarioObject->setSaldo($saldoNuevo);

                // Se persiste el usuario
                $em->persist($usuarioObject);
                $em->flush();
            }

            $this->get('session')->getFlashBag()->set(
                'notice',
                'Pago realizado con éxito. El saldo de los regalos ha sido entregado.'
            );

            /*return $this->render('NWPaymentBundle:Details:view.html.twig', array(
                'status' => $status->getValue(),
                'details' => $details,
                'paymentTitle' => ucwords(str_replace(array('_', '-'), ' ', $token->getPaymentName()))
            ));*/

        } else if ($status->isPending()) {
            $this->get('session')->getFlashBag()->set(
                'notice',
                'Payment is still pending. Credits were not added'
            );
        } else {
            $this->get('session')->getFlashBag()->set('error', 'Payment failed');
        }

        return $this->redirect($this->generateURL('nw_principal_homepage'));
    }

    public function viewOrderAction(Request $request)
    {
        $token = $this->getHttpRequestVerifier()->verify($request);

        $payment = $this->getPayum()->getPayment($token->getPaymentName());

        try {
            $payment->execute(new Sync($token));
        } catch (RequestNotSupportedException $e) {}

        $payment->execute($status = new GetHumanStatus($token));

        /** @var OrderInterface $order */
        $order = $this->getPayum()->getStorage($token->getDetails()->getClass())->findModelById(
            $token->getDetails()->getId()
        );

        return $this->render('NWPaymentBundle:Details:viewOrder.html.twig', array(
            'status' => $status->getValue(),
            'order' => array(
                'client' => array(
                    'id' => $order->getClientId(),
                    'email' => $order->getClientEmail(),
                ),
                'number' => $order->getNumber(),
                'description' => $order->getCurrencyCode(),
                'total_amount' => $order->getTotalAmount(),
                'currency_code' => $order->getCurrencyCode(),
                'currency_digits_after_decimal_point' => $order->getCurrencyDigitsAfterDecimalPoint(),
                'details' => $order->getDetails(),
            ),
            'paymentTitle' => ucwords(str_replace(array('_', '-'), ' ', $token->getPaymentName()))
        ));
    }
}
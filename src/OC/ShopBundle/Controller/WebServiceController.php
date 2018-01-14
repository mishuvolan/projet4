<?php
namespace OC\ShopBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class WebServiceController extends Controller
{
    /**
     * 
     *
     * @param Request $request
     * @return mixed
     */

    public function quotaAction(Request $request){
        if ($request->isXmlHttpRequest()) {
            $date                   = new \DateTime($request->get('date'));
            $booking                = (int) $request->get('booking');
            if($this->get('louvre_shop.webservice')->checkCapacity($date, $booking)){
                $remainingPurchaseItemOnDate = $this->get('louvre_shop.webservice')->getRemainingBooking($date);
                $response = ['availability' => true, 'remaining_purchase_item' => $remainingPurchaseItemOnDate ];
            }else{
                $response =  ['availability' => false];
            }
        }else{
            $response = array(
                'errorCode' => 400,
                'errorMsg'  => 'Bad Request'
            );
        }
        return new JsonResponse($response);
    }
}
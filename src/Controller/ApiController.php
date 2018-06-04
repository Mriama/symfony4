<?php

namespace App\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as FOSRest;
use App\Entity\Client;
use App\Entity\Bien;
use App\Entity\Localite;
use App\Entity\Typebien;
use App\Entity\Reservation;
use App\Entity\Contrat;
use App\Entity\Paiement;
use App\Entity\Proprietaire;







class ApiController extends Controller
{
    /**
     * @Route("/api", name="api")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiController.php',
        ]);
    }


    /**
     * Lists all Biens.
     * @FOSRest\Get("/bien" , name="bien")
     *
     * @return array
     */
    public function getBienAction()
    {
        $repository = $this->getDoctrine()->getRepository(Bien::class);
        $biens = $repository->findall();
        foreach($biens as $key=>$values){
            foreach($values->getImages() as $key=>$images){
                $images->setImage(base64_encode(stream_get_contents($images->getImage())));
            }
        }

        if(!count($biens)){
            $response =array(
                "code"=>false,
                "msg"=>"liste des biens",
                "error"=>null,
                "data"=>null,

            );
            return new JsonResponse($response);
        }

        $data = $this->get('jms_serializer')->serialize($biens, 'json');

            $response =array(
                "code"=>true,
                "msg"=>"liste des biens",
                "error"=>null,
                "data"=>json_decode($data)
            );
            return new JsonResponse($response,Response::HTTP_OK  );

}




    /**
     * @FOSRest\Post("/reservation/{id}" , name="reservation")
     *
     * @return array
     */
    public function addReservAction(Request $request,$id)
    {

        $idbien = $request->get('id');
        $idclient = $request->get('idclient');
        if(empty($idclient))
        {
             $data=$request->getContent();
             $clients=$this->get('jms_serializer')->deserialize($data,'App\Entity\Client','json');
            var_dump($clients->getTelclient('telclient'));

            if(!empty($clients))
            {
                $newClient = new Client();
                $newClient->setNumeropiece($clients->getNumeropiece('numeropiece'));
                $newClient->setNomclient($clients->getNomclient('nomclient'));
                $newClient->setTelclient($clients->getTelclient('telclient'));
                $newClient->setAdressclient($clients->getAdressclient('adressclient'));
                $newClient->setMailclient($clients->getMailclient('mailclient'));
                $newClient->setPassword($clients->getPassword('password'));
                $em = $this->getDoctrine()->getManager();
                $em->persist($newClient);
                $em->flush();
                $idclient = $newClient->getId();
            }
        }

        if (empty($idbien))
        {
            $response = array(
                'code' => 0,
                'Message' => 'error',
                'error' => null,
                'result' => null,
            );

            return new JsonResponse($response, Response::HTTP_BAD_REQUEST);
        }

        $em = $this->getDoctrine()->getManager();
        $idbien = $em->getRepository(Bien::class)->find($idbien);
        $user = $em->getRepository(Client::class)->find($idclient);

        if (empty($user) || empty($idbien))
        {
            $response = array(
                'code' => 0,
                'Message' => 'error',
                'error' => null,
                'result' => null,
            );
            return new JsonResponse($reponse, Response::HTTP_BAD_REQUEST);
        }


        $reserv = new Reservation();
        $reserv->setDatereserv(new \DateTime());
        $reserv->setEtat(0);
        $reserv->setClient($user);
        $reserv->setBien($idbien);
        $em = $this->getDoctrine()->getManager();
        $em->persist($reserv);
        $em->flush();

        $response = array(
            'code' => 0,
            'Message' => 'success',
            'error' => null,
            'result' => null,
        );

        return new JsonResponse($response, Response::HTTP_CREATED);

    }

  /**
     * List un Bien.
     * @FOSRest\Get("/bien/{id}" , name="bienid")
     *
     * @return array
     */
    public function getUnBienAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Bien::class);
        $bien = $repository->find($id);

                foreach($bien->getImages() as $key=>$images){
                $images->setImage(base64_encode(stream_get_contents($images->getImage())));
            }

        if($bien==null){
            $response =array(
                "code"=>false,
                "msg"=>"Detail du bien",
                "error"=>"null",
                "data"=>null,

            );
            return new JsonResponse($response);
        }

        $data = $this->get('jms_serializer')->serialize($bien, 'json');

            $response =array(
                "code"=>true,
                "msg"=>"Detail du bien",
                "error"=>null,
                "data"=>json_decode($data)
            );
            return new JsonResponse($response,Response::HTTP_OK  );

}



    /**
     * search a bien.
     *
     * @FOSRest\Post("/search" ,name="search")
     *
     * @return array
     */
    public function serchAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Bien::class);
        $biens = $repository->findByValues($request->get("localite"), $request->get("type"), $request->get("prix"));

        if (empty($biens)) {
            $reponse = array(
                'code' => 1,
                'Message' => 'Pas de resultat',
                'error' => null,
                'result' => null,
            );

            return new JsonResponse($reponse, Response::HTTP_NOT_FOUND);
        }

        // foreach ($biens as $key => $value) {
        //     foreach ($value->getImages() as $key1 => $images) {
        //         $images->setImage(base64_encode(stream_get_contents($images->getImage())));
        //     }
        // }

        $data = $this->get('jms_serializer')->serialize($biens, 'json');

        $response = array(
            'code' => 0,
            'Message' => 'success',
            'error' => null,
            'result' => json_decode($data),
        );

        return new JsonResponse($response, 201);
    }




    /**
     * Lists all localite.
     * @FOSRest\Get("/localite" , name="localite")
     *
     * @return array
     */
    public function getLocaliteAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Localite::class);
        $localite = $repository->findall();

        if(!count($localite)){
            $response =array(
                "code"=>false,
                "msg"=>"aucune localite",
                "error"=>null,
                "data"=>null,

            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }

        $data = $this->get('jms_serializer')->serialize($localite, 'json');

            $response =array(
                "code"=>true,
                "msg"=>"liste des localite",
                "error"=>null,
                "data"=>json_decode($data)
            );
            return new JsonResponse($response,201);

}



   /**
     * Lists all typebien.
     * @FOSRest\Get("/type" , name="type")
     *
     * @return array
     */
    public function gettypeAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Typebien::class);
        $type = $repository->findall();

        if(!count($type)){
            $response =array(
                "code"=>false,
                "msg"=>"aucun type",
                "error"=>null,
                "data"=>null,

            );
            return new JsonResponse($response, Response::HTTP_NOT_FOUND);
        }

        $data = $this->get('jms_serializer')->serialize($type, 'json');

            $response =array(
                "code"=>true,
                "msg"=>"liste des type",
                "error"=>null,
                "data"=>json_decode($data)
            );
            return new JsonResponse($response,201);

}
 /**
     * Lists all typebien.
     * @FOSRest\Post("/connexion/{id}" , name="connexion")
     *
     * @return array
     */     
    public function ConnexionAction( Request $request,$id){
    $idbien= $request->get('id');
    $emailclient=$request->get('mailclient');
    $password=$request->get('password');

    $em=$this->getDoctrine()->getManager();
    $client=$em->getRepository(Client::class)->findBy(array('mailclient'=>$emailclient,'password'=>$password));
    if(!$client){
        $response=array(
            'code'=>0,
            'message'=>'votre reservation n\'a pas été prise en charge ',
            'error'=>null,
            'type'=>null,
        );

        return new JsonResponse($response,200);
    }

$idbien=$em->getRepository(Bien::class)->find($id);
$reserve=new Reservation();
$reserve->setDatereserv(new \DateTime());
$reserve->SetEtat(0);
$reserve->SetBien($idbien);
$reserve->SetClient($client[0]);
$em->persist($reserve);
$em->flush();
$response=array(

    'code'=>0,
    'message'=>'success ',
    'error'=>null,
    'type'=>json_decode($this->get('jms_serializer')->serialize($client,'json'))
);
return new JsonResponse($response,Response::HTTP_CREATED);
    }
        

    /**
     * Lists all Biens.
     * @FOSRest\Get("/Reservation" , name="Reservation")
     *
     * @return array
     */
    public function getReservation(){
        $repository = $this->getDoctrine()->getRepository(Reservation::class);
        $reservation = $repository->findBy(['etat'=>0]);
        $repository = $this->getDoctrine()->getRepository(Bien::class);
        $bien = $repository->findall();

    
        foreach($bien as $key=>$values){
            foreach($values->getImages() as $key=>$images){
                $images->setImage(base64_encode(stream_get_contents($images->getImage())));
            }
        }
    
        if(!count( $reservation )){
            $response =array(
                "code"=>false,
                "msg"=>"liste des biens",
                "error"=>null,
                "data"=>null,

            );
            return new JsonResponse($response);
        }

        $data = $this->get('jms_serializer')->serialize( $reservation , 'json');

            $response =array(
                "code"=>true,
                "msg"=>"liste des biens",
                "error"=>null,
                "data"=>json_decode($data)
            );
            return new JsonResponse($response,Response::HTTP_OK  );

    }

     /**
     * lister une reservation.
     * @FOSRest\Get("/ReservationId/{id}" , name="ReservationId")
     *
     * @return array
     */
    public function getOneReservation($id){
        $repository = $this->getDoctrine()->getRepository(Reservation::class);
        $reservation = $repository->find($id);
        $repository = $this->getDoctrine()->getRepository(Bien::class);
        $bien = $repository->findall();

    
        foreach($bien as $key=>$values){
            foreach($values->getImages() as $key=>$images){
                $images->setImage(base64_encode(stream_get_contents($images->getImage())));
            }
        }
    
        if( $reservation ==''){
            $response =array(
                "code"=>false,
                "msg"=>"liste des biens",
                "error"=>null,
                "data"=>null,

            );
            return new JsonResponse($response);
        }

        $data = $this->get('jms_serializer')->serialize( $reservation , 'json');

            $response =array(
                "code"=>true,
                "msg"=>"liste des biens",
                "error"=>null,
                "data"=>json_decode($data)
            );
            return new JsonResponse($response,Response::HTTP_OK  );

    }
/**
     * save contrat
     * @FOSRest\Post("/saveContrat/{id}" ,name="saveContrat")
     *
     * @return array
     */
    public function saveContrat(Request $request,$id){
        $idbien = $request->get('id');
        $idclient = $request->get('idclient');
        var_dump($idbien);
        $repository = $this->getDoctrine()->getRepository(Reservation::class); 
        $reserve = $repository->find($id); 

        
        $repository = $this->getDoctrine()->getRepository(Bien::class)->find($idbien); 

       
        //    $total=$request->get('prix_loc');
        
        $data = $request->getContent();
        $contrat= $this->get('jms_serializer')
        ->deserialize($data, 'App\Entity\Contrat','json'); 
        
        $bien= new Bien();
        $contrat= new Contrat();
        $contrat->setDateContrat(new \DateTime());
        $contrat->setCaution($reserve->getBien()->getPrix());
        $contrat->setDuree('1 ans renouvable');
        $contrat->setBien($reserve->getBien());
        $contrat->setClient($reserve->getClient());  
        $em = $this->getDoctrine()->getManager();           
        $em->persist($contrat);
        $em->flush();

       
        if($contrat){
            $paiement = new Paiement();
            $paiement->setDatePaiement('datepaiement');
            $paiement->setMontant($contrat->getCaution());
            $paiement->setPeriode("Avril 2018");
            $paiement->setContrat($contrat);
            $em->persist($paiement);
            $em->flush();
            $update=$this->getDoctrine()
            ->getManager()
            ->getRepository(Bien::class)
            ->updateEtatBien($idbien);
       
            $response = array(
                'code' => 0,
                'Message' => 'success',
                'error' => null,
                'result' => null,
            );
    
            return new JsonResponse($response, Response::HTTP_CREATED);
            
        }
        $reserve->setEtat("1");
        $em->persist($reserve);
        $em->flush();
        }
    
}

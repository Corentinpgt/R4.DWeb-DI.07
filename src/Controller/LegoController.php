<?php



/* indique où "vit" ce fichier */
namespace App\Controller;


/* indique l'utilisation du bon bundle pour gérer nos routes */

use stdClass;
use App\Entity\Lego as Lego;
use App\Service\CreditsGenerator;
use App\Service\DatabaseInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/* le nom de la classe doit être cohérent avec le nom du fichier */
class LegoController extends AbstractController
{
   private $legos = [];
    


    #[Route('/', )]
    public function homeAll(DatabaseInterface $lego): Response
    {  
        return $this->render("lego.html.twig", [
            'legos' => $lego->getAllLegos(),
        ]);
    }
    
    // #[Route('/creator', )]
    // public function homeCreator(): Response
    // {

    //     $this->legos = array_filter($this->legos, function ($var) {
    //         return $var->collection == "Creator";
    //     });

    //     return $this->render("lego.html.twig", [
    //         'legos' => $this->legos,
    //     ]);
    // }

    // #[Route('/star_wars', )]
    // public function homeStarWars(): Response
    // {

    //     $this->legos = array_filter($this->legos, function ($var) {
    //         return $var->collection == "Star Wars";
    //     });

    //     return $this->render("lego.html.twig", [
    //         'legos' => $this->legos,
    //     ]);
    // }

    // #[Route('/creator_expert', )]
    // public function homeCreatorExpert(): Response
    // {

    //     $this->legos = array_filter($this->legos, function ($var) {
    //         return $var->collection == "Creator Expert";
    //     });

    //     return $this->render("lego.html.twig", [
    //         'legos' => $this->legos,
    //     ]);
    // }


    #[Route('/{collection}', 'filter_by_collection', requirements: ['collection' => 'Creator|Star Wars|Creator Expert'])]
    public function filter($collection, DatabaseInterface $lego): Response
    {

        $collection = str_replace("% %", )

        return $this->render("lego.html.twig", [
            'legos' => $lego->getLegosByCollection($collection),
        ]);
    }

    #[Route('/credits', 'credits')]
    public function credits(CreditsGenerator $credits): Response
    {
        return new Response($credits->getCredits());
    }



}




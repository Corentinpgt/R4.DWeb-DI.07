<?php



/* indique où "vit" ce fichier */
namespace App\Controller;


/* indique l'utilisation du bon bundle pour gérer nos routes */

use stdClass;
use App\Entity\Lego as Lego;
use App\Entity\LegoCollection;
use App\Repository\LegoCollectionRepository;
use App\Repository\LegoRepository;
use App\Service\CreditsGenerator;
use App\Service\DatabaseInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/* le nom de la classe doit être cohérent avec le nom du fichier */
class LegoController extends AbstractController
{

    public function __construct(private LegoRepository $legoRepository, private LegoCollectionRepository $legoCollectionRepository) {}

    #[Route('/', )]
    public function homeAll(): Response
    {  

        // $this->coll = $lego->getAllCollection();
        // dump($this->coll);
        // dd($this->legoRepository->findAll());
        return $this->render("lego.html.twig", [
            'legos' => $this->legoRepository->findAll(),
            'collection' =>$this->legoCollectionRepository->findAll(),
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


    #[Route('/{name}', 'filter_by_name', requirements: ['name' => 'Creator|Star Wars|Creator Expert|Harry Potter'])]
    public function filter($name, LegoCollection $legoCollection): Response
    {

        // dd($this->legoRepository->findByCollection($name));
        return $this->render("lego.html.twig", [
            'legos' => $legoCollection->getLegos(),
            'collection' =>$this->legoCollectionRepository->findAll(),
        ]);
    }

    #[Route('/credits', 'credits')]
    public function credits(CreditsGenerator $credits): Response
    {
        return new Response($credits->getCredits());
    }

    // #[Route('/test', 'test')]
    // public function test(EntityManagerInterface $entityManager): Response
    // {
    //     $l = new Lego(1234);
    //     $l->setName("un beau Lego");
    //     $l->setCollection("Lego espace");
    //     $l->setPrice(32.00);
    //     $l->setPieces(122);
    //     $l->setDescription("Lego espace");
    //     $l->setLegoImage("Lego espace");
    //     $l->setBoxImage("Lego espace");
    //     $entityManager->persist($l);
    //     $entityManager->flush();
    //     dd($l);
    // }

    #[Route('/test/{name}', 'test')]
    public function test(LegoCollection $collection): Response
    {
        dd($collection);
    }






}




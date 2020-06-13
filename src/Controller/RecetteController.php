<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RecetteSiteController
 * @package App\Controller
 *
 * @Route(path="/recette")
 */

class RecetteController
{
    private $recetteRepository;

    public function __construct(RecetteRepository $recetteRepository)
    {
        $this->recetteRepository = $recetteRepository;
    }

    /**
     * @Route("/add/", name="add_recette", methods={"POST"})
     */
    public function add(Request $request): JsonResponse
    {
       
        $data = json_decode($request->getContent(), true);

        $titre = $data['titre'];
        $soustitre = $data['soustitre'];
        $ingredients = $data['ingredients'];

        if (empty($titre) || empty($soustitre) || empty($ingredients)){
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->recetteRepository->saveRecette($titre, $soustitre, $ingredients);

        return new JsonResponse(['status' => 'Recipe created!'], Response::HTTP_CREATED);
    }
/**
 * @Route("/searchAll", name="get_all_recette", methods={"GET"})
 */
public function getAll(): JsonResponse
{
    $recettes = $this->recetteRepository->findAll();
    $data = [];
if ($recettes) {
    foreach ($recettes as $recette) {
        $data[] = [
            'id' => $recette->getId(),
            'titre' => $recette->getTitre(),
            'soustitre' => $recette->getSoustitre(),
            'ingredients' => $recette->getIngredients(),
        ];
    }
}

    return new JsonResponse($data, Response::HTTP_OK);
}

/**
 * @Route("/searchById/{id}", name="get_one_recette", methods={"GET"})
 */
public function get($id): JsonResponse
{
    $recette = $this->recetteRepository->findOneBy(['id' => $id]);
    if($recette){
        $data = [
            'id' => $recette->getId(),
            'titre' => $recette->getTitre(),
            'soustitre' => $recette->getSoustitre(),
            'ingredients' => $recette->getIngredients()
             ];

    return new JsonResponse($data, Response::HTTP_OK);
    }
else{
    return new JsonResponse(['status' => 'recette not found!'], Response::HTTP_NOT_FOUND);
}
}

/**
 * @Route("/update/{id}", name="update_recette", methods={"PUT"})
 */
public function update($id, Request $request): JsonResponse
{
    $recette = $this->recetteRepository->findOneBy(['id' => $id]);
    $data = json_decode($request->getContent(), true);

    if($recette){
    empty($data['titre']) ? true : $recette->setTitre($data['titre']);
    empty($data['soustitre']) ? true : $recette->setSoustitre($data['soustitre']);
    empty($data['ingredients']) ? true : $recette->setIngredients($data['ingredients']);

    $updatedRecette = $this->recetteRepository->updateRecette($recette);

     return new JsonResponse(['status' => 'recette updated!']);
    }
    else{
        return new JsonResponse(['status' => 'recette not found!'],Response::HTTP_NOT_FOUND);
    }
}

/**
     * @Route("/remove/{id}", name="delete_recette", methods={"DELETE"})
     */
    public function deleteRecette($id): JsonResponse
    {
        $recette = $this->recetteRepository->findOneBy(['id' => $id]);

if($recette){
        $this->recetteRepository->removeRecette($recette);

        return new JsonResponse(['status' => 'recette deleted']);
    }
     else{
 return new JsonResponse(['status' => 'recette not found!'],Response::HTTP_NOT_FOUND);
    }
}


}
<?php

namespace App\Http\Controllers;

use App\Cases\Pet\AddPet;
use App\Cases\Pet\DestroyPet;
use App\Cases\Pet\ListPets;
use App\Cases\Pet\ShowPet;
use App\Cases\Pet\UpdatePet;
use App\Models\Pet;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        try {
            $list_pets = new ListPets();
            $name = $request->get('name', ' ');
            return new Response($list_pets->action($name), Response::HTTP_OK);
        } catch (Exception $exception) {
            return new Response([$exception->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $add_pet = new AddPet();
        $pet = $add_pet->action($request->all());
        return new Response($pet, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Pet $pet
     * @return Response
     */
    public function show(int $pet_id)
    {
        $show = new ShowPet();
        $pet = $show->action($pet_id);
        return new Response($pet, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $pet_id
     * @return Response
     */
    public function update(Request $request, int $pet_id): Response
    {
        $update_pet = new UpdatePet();
        $pet = $update_pet->action($pet_id, $request->all());
        if ($pet) {
            return new Response($pet, Response::HTTP_OK);
        }
        return new Response("", Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $pet_id
     * @return Response
     */
    public function destroy(int $pet_id)
    {
        $destroy = new DestroyPet();
        if ($destroy->action($pet_id)) {
            return new Response("", Response::HTTP_NO_CONTENT);
        }
        return new Response("", Response::HTTP_NOT_FOUND);
    }
}

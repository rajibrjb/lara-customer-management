<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\BaseController;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class UserController extends BaseController
{

    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $fields = [
                "name",
                'email',
                ];
                $users = $this->userRepository->all([],request()->all());
            return parent::sendResponse(UserResource::collection($users,$fields), "User List");
        } catch (Exception $e) {
            return parent::sendError();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        try {
            $fields = [
                "name",
                'email',
                ];

            return parent::sendResponse(new UserResource($user,$fields));
        } catch (Exception $e) {
            return parent::sendError($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUser()
    {
        try {
            $fields = [
                "name",
                'email',
                ];

                $user = auth()->user();
            return parent::sendResponse(new UserResource($user,$fields));
        } catch (Exception $e) {
            return parent::sendError($e);
        }
    }


}

<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Transformers\UserTransformer;
use App\Http\Requests\Api\UserRequest;
use App\Http\Requests\Api\ImageRequest;

class UsersController extends Controller
{
    public function me()
    {
        return $this->response->item($this->user(), new UserTransformer())->setStatusCode(200);
    }

    public function update(UserRequest $request)
    {
        $user = $this->user();

        $attributes = $request->only(['name', 'email']);

        $user->update($attributes);

        return $this->response->item($user, new UserTransformer())->setStatusCode(200);
    }

    public function avatar(ImageRequest $request)
    {
        $user = $this->user();

        $attributes = $request->only(['avatar']);

        $user->update($attributes);

        return $this->response->item($user, new UserTransformer())->setStatusCode(200);
    }

    public function index()
    {
        $users = User::paginate(10);
        return $this->response->paginator($users,new UserTransformer());
    }


}

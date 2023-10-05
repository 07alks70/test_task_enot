<?php

namespace App\Http\Controllers\User;

use App\Contracts\User\UserEditContract;
use App\Contracts\User\UserEditTaskAddContract;
use App\DTO\User\UserDTO;
use App\Enums\SendingServiceEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserConfirmationTaskRequest;
use App\Http\Requests\UserEditTaskRequest;
use App\Models\User;
use App\Models\UserEditTask;
use App\Rules\SendingServiceValidationRule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserEditTaskController extends Controller
{

    private UserEditTaskAddContract $userEditTaskContract;
    public UserEditContract $userEditContract;

    public function __construct(UserEditTaskAddContract $userEditTaskContract, UserEditContract $userEditContract)
    {
        $this->userEditTaskContract = $userEditTaskContract;
        $this->userEditContract = $userEditContract;
    }

    public function add(UserEditTaskRequest $request, User $user): JsonResponse
    {
        $editTaskId = $this->userEditTaskContract->handler(
            userDTO: $request->toUserDTO($user),
            sendingServiceEnum: SendingServiceEnum::from($request->json("message_service"))
        );

        return Response::json([
            "task_id" => $editTaskId
        ], \Symfony\Component\HttpFoundation\Response::HTTP_CREATED);
    }

    public function confirmation(UserConfirmationTaskRequest $request, UserEditTask $task): JsonResponse
    {
        // Тут можно добавить обработоку ошибок и тд (можно расширить)
        if (!$this->userEditContract->handler($task)){
            return Response::json([
                "errors" => ["Системная ошибка"]
            ], 400);
        }

        return Response::json([
            "success" => "true"
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Contracts\User\UserEditContract;
use App\Contracts\User\UserEditTaskAddContract;
use App\Enums\SendingServiceEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserConfirmationTaskRequest;
use App\Http\Requests\UserEditTaskRequest;
use App\Models\User;
use App\Models\UserEditTask;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

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
            sendingServiceEnum: SendingServiceEnum::from($request->json('message_service'))
        );

        return Response::json([
            'task_id' => $editTaskId,
        ], SymfonyResponse::HTTP_CREATED);
    }

    public function confirmation(UserConfirmationTaskRequest $request, UserEditTask $task): JsonResponse
    {
        // Тут можно добавить обработоку ошибок и тд (можно расширить)
        if (! $this->userEditContract->handler($task)) {
            return Response::json([
                'errors' => ['Системная ошибка'],
            ], SymfonyResponse::HTTP_BAD_REQUEST);
        }

        return Response::json([
            'success' => 'true',
        ], SymfonyResponse::HTTP_OK);
    }
}

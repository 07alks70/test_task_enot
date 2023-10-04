<?php

namespace App\Http\Controllers\User;

use App\Contracts\User\UserEditContract;
use App\Contracts\User\UserEditTaskAddContract;
use App\DTO\User\UserDTO;
use App\Enums\SendingServiceEnum;
use App\Http\Controllers\Controller;
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

    public function add(Request $request, User $user): JsonResponse
    {
        $validator = Validator::make($request->json()->all(), [
            "name" => "string",
            "email" => "string",
            "city" => "string",
            "citizenship" => "string",
            "password" => "string",
            "message_service" => ["required", "numeric", new SendingServiceValidationRule()]
        ], [
            "name.string" => "Свойство должно иметь тип строки",
            "email.string" => "Свойство должно иметь тип строки",
            "city.string" => "Свойство должно иметь тип строки",
            "citizenship.string" => "Свойство должно иметь тип строки",
            "password.string" => "Свойство должно иметь тип строки",
            "message_service.string" => "Свойство обязательное",
            "message_service.numeric" => "Свойство должно быть числом",
        ]);

        if ($validator->fails()){
            return Response::json([
                "errors" => $validator->errors()
            ], 400);
        }

        if ($request->json("password")){
            if (Hash::check($request->json("password"), $user->password)){
                $password = $request->json("password");
            }else{
                $password = $user->password;
            }
        }else{
            $password = $user->password;
        }

        $userDTO = new UserDTO(
            name: (!$request->json("name")) ? $user->name : $request->json("name"),
            userId: $user->id,
            password: $password,
            city: (!$request->json("city")) ? $user->city : $request->json("city"),
            email: (!$request->json("email")) ? $user->email : $request->json("email"),
            citizenship: (!$request->json("citizenship")) ? $user->citizenship : $request->json("citizenship"),
        );

        $editTaskId = $this->userEditTaskContract->handler(
            userDTO: $userDTO,
            sendingServiceEnum: SendingServiceEnum::from($request->json("message_service"))
        );

        return Response::json([
            "task_id" => $editTaskId
        ], 201);
    }

    public function confirmation(Request $request, UserEditTask $task): JsonResponse
    {
        $validator = Validator::make($request->json()->all(), [
            "code" => ["required", "numeric", "digits:4"]
        ], [
            "code.string" => "Свойство обязательное",
            "code.numeric" => "Свойство должно быть числом",
            "code.digits" => "Свойство должно иметь 4 цифры",
        ]);

        if ($validator->fails()){
            return Response::json([
                "errors" => $validator->errors()
            ], 400);
        }

        if ($request->json("code") != $task->confirmation_code){
            return Response::json([
                "errors" => ["Код неверный"]
            ], 400);
        }

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

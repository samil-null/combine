<?php

namespace App\Http\Controllers\Api\Events\Properties;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Events\Properties\StoreRequest;
use App\Http\Requests\Api\Events\Properties\UpdateRequest;
use App\Models\Event;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class PropertyController extends Controller
{
    /**
     * @param Event $event
     * @return JsonResponse
     */
    public function index(Event $event): JsonResponse
    {
        return responder()->success($event->properties)->respond();
    }

    /**
     * @param Event $event
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(Event $event, StoreRequest $request): JsonResponse
    {
        $property = $event->properties()->create($request->validated());

        return responder()->success($property)->respond(Response::HTTP_CREATED);
    }

    /**
     * @param UpdateRequest $request
     * @param Property $property
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Event $event, Property $property): JsonResponse
    {
        $property->update($request->validated());

        return responder()->success()->respond();
    }

    /**
     * @param Event $event
     * @param Property $property
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(Event $event, Property $property): JsonResponse
    {
        $property->deleteOrFail();

        return responder()->success()->respond();
    }
}

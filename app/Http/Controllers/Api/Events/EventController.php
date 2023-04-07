<?php

namespace App\Http\Controllers\Api\Events;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Events\StoreRequest;
use App\Http\Requests\Api\Events\UpdateRequest;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class EventController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $events = Event::query()->paginate(config('app.pagination.per_page'));

        return responder()->success($events)->respond();
    }

    /**
     * @param  StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $event = Event::create($request->validated());

        return responder()->success($event)->respond(Response::HTTP_CREATED);
    }

    /**
     * @param  Event  $event
     * @return JsonResponse
     */
    public function show(Event $event): JsonResponse
    {
        return responder()->success($event)->respond();
    }

    /**
     * @param  UpdateRequest  $request
     * @param  Event  $event
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Event $event): JsonResponse
    {
        $event->update($request->validated());

        return responder()->success()->respond();
    }

    /**
     * @param  Event  $event
     * @return JsonResponse
     *
     * @throws Throwable
     */
    public function destroy(Event $event): JsonResponse
    {
        $event->deleteOrFail();

        return responder()->success()->respond();
    }
}

<?php

namespace App\Http\Services\panel;

use App\Models\Request;
use App\Models\RequestPayment;
use App\Repositories\panel\RequestRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class RequestPanelService
{
    private Filesystem $storage;
    public function __construct()
    {
        $this->storage = Storage::disk('public');
    }
    public function listRequests(string $status, string $type, ?string $search = null)
    {
        $searchList = [];
        if ($search) {
            $searchList = preg_split('/\s+/', $search);
        }
        $list = RequestRepository::list($status, $type, $searchList);
        return $list->setCollection($list->getCollection()->transform(function ($item) use ($type, $status) {
            $presenter = [
                'paymentFile' => isset($item->file) ? $this->getUrlByPath($item->file) : null,
                'typeLabel' => Request::TYPES_TRANSLATE[$type],
                'patronymic' => $item->patronymic ?? 'Нет',
                'created_at' => Carbon::parse($item->created_at)->translatedFormat('j F Y'),
                'status' => Request::STATUSES[$item->status],
                'actions' => Request::ACTIONS[$item->status],
                'semester' => $item->semester ?? null,
                'typeDocument' => $item->typeDocument ?? null,
                'school' => $item->school ?? null,
                'endSchool' => $item->endSchool ?? null,
                'startMpt' => $item->startMpt ?? null,
                'responsibilities' => $item->responsibilities ?? null,
                'whereNeeded' => $item->whereNeeded ?? null,
                'birthDate' => isset($item->birthDate) ? Carbon::parse($item->created_at)->translatedFormat('d.m.Y') : null,
            ];
            return array_merge(json_decode(json_encode($item), true), $presenter);
        }));
    }

    private function getUrlByPath(string $path)
    {
        return $this->storage->exists($path) ? $this->storage->url($path) : null;
    }

    public function accept(Request $request)
    {
        if ($request->request_type === RequestPayment::class) {
            $status = Request::ARCHIVE;
        } else {
            $status = Request::WAIT_SEND;
        }
        $request->changeStatus($status);
        $request->save();
        $type = Request::getTypeStatement($request->request_type);
        return $request->second_name . ' ' . $request->first_name . ',  Ваше заявление "' . $type . '" принято';
    }

    public function reject(Request $request, string $cause)
    {
        $request->changeStatus(Request::ARCHIVE);
        $request->save();
        $type = Request::getTypeStatement($request->request_type);
        return $request->second_name . ' ' . $request->first_name . ',  Ваше заявление "' . $type . '" отклонено. <br/> Причина: '.$cause;
    }

    public function confirm(Request $request)
    {
        $request->changeStatus(Request::ARCHIVE);
        $request->save();
        $type = Request::getTypeStatement($request->request_type);
        return $request->second_name . ' ' . $request->first_name . ',  Ваше заявление "' . $type . '" обработано. Документ готов и ожидает получения в канцелярии техникума';
    }
}

<?php

namespace App\Http\Services\panel;

use App\Models\Request;
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
    public function listRequests(string $status, string $type)
    {
        $list = RequestRepository::list($status, $type);
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

    private function makeDate(string $crated_at)
    {

    }
}

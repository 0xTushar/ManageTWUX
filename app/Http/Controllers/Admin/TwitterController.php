<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Twitter;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TwitterController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('twitter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.twitter.index');
    }

    public function create()
    {
        abort_if(Gate::denies('twitter_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.twitter.create');
    }

    public function edit(Twitter $twitter)
    {
        abort_if(Gate::denies('twitter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.twitter.edit', compact('twitter'));
    }

    public function show(Twitter $twitter)
    {
        abort_if(Gate::denies('twitter_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $twitter->load('token');

        return view('admin.twitter.show', compact('twitter'));
    }

    public function __construct()
    {
        $this->csvImportModel = Twitter::class;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Token;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TokenController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('token_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.token.index');
    }

    public function create()
    {
        abort_if(Gate::denies('token_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.token.create');
    }

    public function edit(Token $token)
    {
        abort_if(Gate::denies('token_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.token.edit', compact('token'));
    }

    public function show(Token $token)
    {
        abort_if(Gate::denies('token_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.token.show', compact('token'));
    }

    public function __construct()
    {
        $this->csvImportModel = Token::class;
    }
}

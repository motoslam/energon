<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function store(Request $request)
    {
        if(!$request->type) return response()->json(['status' => 'error'], 404);
        $type = $request->type;
        if(function_exists($this->$type)) {
            $this->$type($request);
        }
    }

    public function comment(Request $request)
    {
        $company = Company::find($request->company)->first();
        $event = $company->events()->create([
            'user_id' => $request->user()->id,
            'title' => 'Комментарий',
        ]);

        $comment = Comment::create([
            'company_id' => $request->company,
            'user_id' => $request->user()->id,
            'contact_id' => $request->contact ?? null,
            'data' => $request->data
        ]);

        $event->attachable()->associate($comment);
        $event->save();

        return '';
    }
}

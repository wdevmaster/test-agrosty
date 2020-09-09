<?php

namespace App\Http\Controllers;

use App\Mail;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MailController extends Controller
{
    /**
     * Display a listing of the mails.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax())
            return response()->json(['data' => [
                [
                    'id' => 1,
                    'hid' => '1akjsdhkjs',
                    'to' => 'email@email',
                    'subject' => 'subject',
                    'por_spam' => 50,
                ],
                [
                    'id' => 2,
                    'hid' => '2akjsdhkjs',
                    'to' => 'email@email',
                    'subject' => 'subject',
                    'por_spam' => 50,
                ],
                [
                    'id' => 3,
                    'hid' => '3akjsdhkjs',
                    'to' => 'email@email',
                    'subject' => 'subject',
                    'por_spam' => 50,
                ]
            ]]);

        return view('mail.index');
    }

    /**
     * Show the form for creating a new mail data.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        return view('mail.form');
    }

    /**
     * Store a newly created mail in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        try {
            DB::beginTransaction();

            Mail::create($request->all());

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('mail has been send'),
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'errors' => [[
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ]],
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        sleep(1);
        return response()->json([
            'to' => 'email@email',
            'subject' => 'subject',
            'format_body' => 'Hola <i class="text-muted">mundo A</i>',
            'por_spam' => 50,
            'num_words' => 2,
            'num_spam_words' => 1
        ]);

        /*
        try {
            return response()->json($this->findModel($id));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'errors' => [[
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ]],
            ], 500);
        }
        */
    }

    public function findModel($code)
    {
        $hashids = (new Hashids(env('APP_KEY'), 15))->decode($code);
        $id = is_array($hashids) ? (isset($hashids[0]) ? $hashids[0] : null ): $code;
        if (!$id || null == $model = Mail::find($id)) 
            throw new ModelNotFoundException(
                __('The mail was not found')
            );

        return $model;
    }
}

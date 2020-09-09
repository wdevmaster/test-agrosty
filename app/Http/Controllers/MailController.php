<?php

namespace App\Http\Controllers;

use App\Mail;
use Hashids\Hashids;
use App\MailSubject;
use App\AnalyzeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Resources\MailResource;
use App\Exports\MailsExport;
use Maatwebsite\Excel\Excel;

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
            return MailResource::collection(Mail::all());
        
        return view('welcome') ->with([
            'subjects' => MailSubject::all(),
            'analyzes' => AnalyzeMail::all(),
            'mails' => Mail::all()
        ]);
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

            $data = [];
            foreach ($request->all() as $row) 
                $data[$row['name']] = $row['value']; 

            Mail::create($data);

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
    }

    public function findModel($code)
    {
        $hashids = (new Hashids(env('APP_KEY'), 15))->decode($code);
        $id = is_array($hashids) ? (isset($hashids[0]) ? $hashids[0] : null ): $code;
        if (!$id || null == $model = Mail::find($id)) 
            throw new ModelNotFoundException(
                __('The mail was not found')
            );

        return new MailResource($model);
    }

    public function export($type)
    {
        if ($type == "excel")
            return (new MailsExport)->download('mails.xlsx', Excel::XLSX);
        elseif ($type == "pdf")
            return (new MailsExport)->download('mails.pdf', Excel::DOMPDF);
    }
}

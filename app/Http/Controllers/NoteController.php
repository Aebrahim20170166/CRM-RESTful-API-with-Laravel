<?php

namespace App\Http\Controllers;

use App\Crm\Customer\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NoteController extends Controller
{
    public function index(Request $request, $customerId)
    {
        return Note::where('customer_id', $customerId)->get();
    }

    public function show($customerId, $noteId)
    {
        $note = Note::find($noteId);
        if (! $note)
        {
            return response()->json(['status' => 'Not Found'], Response::HTTP_NOT_FOUND);
        }
        $customerId = (int) $customerId;
        if ( $note -> customer_id !== $customerId){
            return response() -> json(['status' => 'Invalid Data'], Response::HTTP_BAD_REQUEST);
        }

        return $note;
    }
    public function  create(Request $request, $customerId)
    {

        $note = new Note();
        $note->note = $request->get('note');
        $note->customer_id = $customerId;
        $note->save();
        return $note;
    }

    public function  update(Request $request, $customerId, $noteId)
    {
        $note = Note::find($noteId);
        if (! $note)
        {
            return response()->json(['status' => 'Not Found'], Response::HTTP_NOT_FOUND);
        }
        $customerId = (int) $customerId;
        if ( $note -> customer_id !== $customerId){
            return response() -> json(['status' => 'Invalid Data'], Response::HTTP_BAD_REQUEST);
        }

        $note -> note = $request -> get('note');
        $note -> save();

        return $note;
    }

    public function  delete(Request $request, $customerId, $noteId)
    {
        $note = Note::find($noteId);
        if (! $note)
        {
            return response()->json(['status' => 'Not Found'], Response::HTTP_NOT_FOUND);
        }
        $customerId = (int) $customerId;
        if ( $note -> customer_id !== $customerId){
            return response() -> json(['status' => 'Invalid Data'], Response::HTTP_BAD_REQUEST);
        }

        $note->delete();
        return response()->json(['status' => 'deleted'], Response::HTTP_OK);
    }
}

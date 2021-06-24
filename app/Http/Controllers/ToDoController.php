<?php

namespace App\Http\Controllers;

use App\Models\ToDoItems;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ToDoController extends Controller
{
    //
    public function create (Request $request)
    {
        $todo = ToDoItems::create([
            'content' => $request->input('content'),
            'status' => $request->input('status'),
            'user_id' => $request->input('userid')
        ]);
        return \response($todo , Response::HTTP_CREATED);
    }
    public function edititems (Request $request)
    {

        $id = $request->input('id');
        $userinfo = ['content' => $request->input('content') , 'status' => $request->input('status')];
        DB::table('todoitems')->where('id' , $id)->update($userinfo);
        return ("Items Updated");
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $items = ToDoItems::findOrFail($id);
        $items->delete();
        return ("Deleted Successfully");

    }
    public function getpublicItems()
    {
        $items = DB::select('select * from todoitems where status="Public" or status="public"');
        return \response($items);


    }
    public function getprivateItems(Request $request)
    {
        $items = User::find($request->input('id'))->getItems;
        return \response($items);

    }

}

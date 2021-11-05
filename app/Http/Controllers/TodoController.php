<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoReqeust;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use http\Client\Response;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\DependencyInjection\ResettableServicePass;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $allTodos = Todo::all();
        //$records = User::with('addresses', 'location', 'role', 'phones')->get();

        //$allTodos = Todo::with('title','content')->get();

        //$allTodos = Todo::query('title')->get();

        $filteredTodos = TodoResource::collection($allTodos);

        return $filteredTodos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoReqeust $request)
    {
        //
        $userInputData = $request->all();

        //$input = $request->all();

        $newTodo = Todo::create($userInputData);

        //return response()->json($todo);

        return new TodoResource($newTodo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $fetchedTodo)
    {
        //
        //$fetchedTodo = Todo::find($id);

        $filterdTodo = new TodoResource($fetchedTodo);

        return $filterdTodo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //public function update(Request $request, $id)
    public function update(TodoReqeust $request, Todo $todo)
    {
        //
        //$fetchedTodo = Todo::find($id);
        $todo->update($request->all());

        $updatedTodo = new TodoResource($todo);

        return $updatedTodo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function destroy($id)
    public function destroy(Todo $todo)
    {
        //$fetchedTodo = Todo::find($id);
        $todo->delete();
        return response(null, \Symfony\Component\HttpFoundation\Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers\Admin\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Service\StoreServiceRequest;
use App\Models\Service\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{

    public function getServices()
    {
        $services = Service::select('id','title')->get();

        return response()->json(['data'=>$services]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::orderBy('id', 'desc')->paginate(30);
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Admin\Service\StoreServiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        $service = new Service();
        $service->title = $request->title;
        $service->meta_title = $request->meta_title ?? null;
        $service->meta_description = $request->meta_description ?? null;
        $service->slug = $request->slug;
        $service->content = $request->html_content;
        $service->additional_js = $request->additional_js ?? null;
        $service->script = $request->script ?? null;
        $service->additional_css = $request->additional_css ?? null;
        $service->styles = $request->styles ?? null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = trim($file->getClientOriginalName());
            $folder = date('Y-m-d');
            $file->storeAs("public/services/{$folder}", $name);
            $service->image = "/public/services/{$folder}/{$name}";
        }
        $service->save();
        return redirect()->back()->withSuccess('Запись успешно добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Admin\Service\StoreServiceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreServiceRequest $request, $id)
    {
        $service = Service::find($id);
        $service->title = $request->title;
        $service->meta_title = $request->meta_title ?? null;
        $service->meta_description = $request->meta_description ?? null;
        $service->slug = $request->slug;
        $service->content = $request->html_content;
        $service->additional_js = $request->additional_js ?? null;
        $service->script = $request->script ?? null;
        $service->additional_css = $request->additional_css ?? null;
        $service->styles = $request->styles ?? null;
        if($request->hasFile('image')){
            $file = $request->file('image');
            $name = trim($file->getClientOriginalName());
            $folder = date('Y-m-d');
            $file->storeAs("public/services/{$folder}", $name);
            $service->image = "/public/services/{$folder}/{$name}";
        }
        $service->save();
        return redirect()->back()->withSuccess('Запись успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();
        return response()->json([
            'status' => 'Delete service ' . $service->title,
            'success' => true,
            ]);} 
}

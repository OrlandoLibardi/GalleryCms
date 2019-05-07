<?php 

namespace OrlandoLibardi\GalleryCms\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use OrlandoLibardi\GalleryCms\app\Http\Requests\GalleryRequest;
use OrlandoLibardi\GalleryCms\app\Gallery;
use OrlandoLibardi\GalleryCms\app\GalleryItem;
use OrlandoLibardi\GalleryCms\app\ServiceGallery;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list');
        $this->middleware('permission:create', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit', ['only' => ['edit', 'update', 'status']]);
        $this->middleware('permission:delete', ['only' => ['destroy']]);                
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {  
     
     $galleries = Gallery::paginate(10);
     return view('admin.gallery.index', compact('galleries'));      
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        return view('admin.gallery.create');       
    }
    public function show($id)
    {
      
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request) {
        
        Gallery::create($request->all());
        return response()
        ->json(array(
            'message' => __('messages.create_success'),
            'status'  =>  'success'
        ), 200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) 
    {
       $gallery = Gallery::find($id);
       return view('admin.gallery.edit', compact('gallery'));  

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, $id) 
    {
        
        Gallery::find($id)->update($request->all());
        return response()
        ->json(array(
            'message' => __('messages.update_success'),
            'status'  =>  'success'
        ), 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleryRequest $request, $id) {
        
        foreach(json_decode($request->id) as $item)
        {
            Gallery::find($item)->delete();            
        }
        
        return response()
        ->json(array(
            'message' => __('messages.update_success'),
            'status'  =>  'success'
        ), 201);
    }

    
}
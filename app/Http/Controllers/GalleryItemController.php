<?php 

namespace OrlandoLibardi\GalleryCms\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use OrlandoLibardi\GalleryCms\app\Http\Requests\GalleryItemRequest;

use OrlandoLibardi\GalleryCms\app\Gallery;
use OrlandoLibardi\GalleryCms\app\GalleryItem;
use OrlandoLibardi\GalleryCms\app\ServiceGallery;

class GalleryItemController extends Controller
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
                
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
          
    }
    public function show($alias)
    {
      $gallery  = Gallery::where('alias', $alias)->first();
      $pages    = Page::select('id', 'name', 'alias')->orderBy('name','ASC')->get();
      $items    = GalleryItem::items($gallery->id)
                    ->orderBy('order_at', 'ASC')
                    ->get();
               
       return view('admin.gallery.items.index', compact('gallery', 'items', 'pages'));         
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryItemRequest $request) {
        
        GalleryItem::create( $request->all() );

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
    public function edit(Request $request,$id) 
    {
       $selected = GalleryItem::find($id);
       $pages = Page::select('id', 'name', 'alias')->orderBy('name','ASC')->get();       
       $items = GalleryItem::items($selected->Gallery->id)
                ->orderBy('order_at', 'ASC')
                ->get();

       return view('admin.gallery.items.edit', compact('selected', 'pages', 'items'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryItemRequest $request, $id) 
    {
        GalleryItem::find($id)
                 ->update( $request->all() );

        return response()
        ->json(array(
            'message' => __('messages.update_success'),
            'status'  =>  'success'
        ), 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function reOrder(GalleryItemRequest $request) 
    {
        GalleryItem::find( $request->id )
                ->update(['order_at' => $request->order ]);

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
    public function destroy(GalleryItemRequest $request, $id) {

        foreach(json_decode($request->id) as $item)
        {
            GalleryItem::find($item)->delete();            
        }

        return response()
        ->json(array(
            'message' => __('messages.destroy_success'),
            'status'  =>  'success'
        ), 201);
    }
    

    
}
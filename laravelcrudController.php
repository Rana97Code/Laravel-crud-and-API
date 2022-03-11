<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Model\Publication;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Image;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publication = Publication::orderBy('id', 'desc')->get();
        return view('backend.publication.index', compact('publication'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.publication.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();

        $this->validate($request, [
            'publication_name'  => 'required',
        ]);

        $publication = new Publication();

        $publication->publication_name = $request->publication_name;
       

        if ($request->hasFile('publication_image')) {
            //insert that image
            $publicationImage = $request->file('publication_image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $publicationImage->getClientOriginalExtension();
            $location = public_path('frontend/images/publicationImage/' . $imgName);
            Image::make($publicationImage)->save($location);


            $publication->publication_image = $imgName;
        }

        $publication->save();

        Toastr::success('publication Successfully Created', 'Success');

          return redirect()->route('admin.publication.index');
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
        $publication = publication::find($id);

        return view('backend.publication.edit', compact('publication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $this->validate($request, [

            'publication_name'  => 'required',
        ]);
        
        $publication = publication::find($id);

        $publication->publication_name = $request->publication_name;


        if ($request->publication_image > 0) {

            // if (file_exists(public_path('frontend/images/publicationImage/' . $publication->image))) {
            //     unlink(public_path('frontend/images/publicationImage/' . $publication->image));
            // }

            //insert that image
            $publicationImage = $request->file('publication_image');
            $imgName = rand(1111, 9999) . date('.d-m-y.') . '.' . $publicationImage->getClientOriginalExtension();
            $location = public_path('frontend/images/publicationImage/' . $imgName);
            Image::make($publicationImage)->save($location);


            $publication->publication_image = $imgName;
        }

        $publication->save();

        Toastr::success('publication Successfully Updated', 'Success');

        return redirect()->route('admin.publication.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function publicationDelete($id)
    {
         $publication = publication::find($id);
         
      

        if (!is_null($publication)) {

            // if (file_exists(public_path('frontend/images/publicationImage/' . $publication->publication_image))) {
            //     unlink(public_path('frontend/images/publicationImage/' . $publication->publication_image));
            // }

            $publication->delete();
        }

        Toastr::success('publication Successfully Deleted', 'Success');

        return redirect()->route('admin.publication.index');
    }
    public function destroy($id)
    {
         
    }

    public function inactive(Request $request)
    {
        $publication = publication::findOrFail($request->id);
        $publication->status = $request->status;

        // if ($publication->status === 0) {
        //     return 0;
        // }

        $publication->save();
        //Toastr::success('Status Successfully Changed', 'Success');
        return 1;
    }
}

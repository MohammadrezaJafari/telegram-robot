<?php

namespace App\Domain\User\Controller\Resource;

use App\Domain\DomainBus;
use App\Domain\User\Model\User;
use App\Http\Controllers\BaseResourceController;
use App\Domain\User\Form\User as UserForm;
use Chumper\Datatable\Facades\DatatableFacade as Datatable;

use App\Http\Requests;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class UserController extends BaseResourceController
{
    public function __construct(User $model, UserForm $form){
        $this->model = $model;
        $this->form = $form;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datatable = Datatable::table()
            ->addColumn('id', 'Gallery Title', 'Position')
            ->addColumn('actions')
            ->setUrl(URL::to('domain/api/galleries'))
            ->render();
        return view('list')->with(['table' => $datatable, 'url' => "gallery/create"]);
    }

    public function getTable()
    {
        $query = DB::table('galleries')
            ->select('galleries.id', 'galleries.title','galleries.image');
        return Datatable::query($query)
            ->showColumns('id')
            ->addColumn('Gallery Title',function($query){
                return $query->title;
            })
            ->addColumn('Image',function($query){
                $imagePath = config('ui.uploadPath'). "/$query->image";
                return "<img src='$imagePath' width='105'>";
            })

            ->addColumn('actions',function($query){
                $token = csrf_field();
                $buttons  = "<a href='gallery/$query->id/edit' class='btn btn-success'>Edit</a>";
                $buttons .=
                    "<form method='post' style=\"display: inline;\"action=\"gallery/$query->id\">
                    $token
                    <input name=\"_method\" type=\"hidden\" value=\"DELETE\">".
                    '<input type="submit" value="Delete" class="btn btn-danger" onclick="var r = confirm(\'آیا از حذف مطمئن هستید؟\'); if(r == false){return false;}">';
                $buttons .=   "</form>";
                return $buttons;
            })
            ->searchColumns(['title'])
            ->orderColumns('id','title')
            ->make();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $domainBus = new DomainBus(new Filesystem);

        var_dump($domainBus->getDomainResources()['content']['controller']['resource']['action']['create']['item']);
        return parent::create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        parent::store($request);
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
    public function edit($id, $model = null)
    {
        return parent::edit($id, get_class($this->model));
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
        return parent::update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return parent::destroy($id);
    }
}

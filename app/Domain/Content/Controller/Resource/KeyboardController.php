<?php

namespace App\Domain\Content\Controller\Resource;

use App\Backend\Core\Base\Controller\BaseResourceController;
use App\Domain\Content\Content;
use App\Domain\Content\Form\Keyboard as KeyboardForm;
use App\Domain\Content\Model\Command;
use App\Domain\Content\Model\Keyboard;
use App\Http\Requests;

use Chumper\Datatable\Facades\DatatableFacade as Datatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Module\UI\Element\Select;

class KeyboardController extends BaseResourceController
{
    public function __construct(Keyboard $keyboard, Keyboard $form){
        $this->model = $keyboard;
        $this->form  = $form;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datatable = Datatable::table()
            ->addColumn('id', 'Description', 'Image')
            ->addColumn('actions')
            ->setUrl(route('content.keyboard.table'))
            ->render();
        return view('list')->with(['table' => $datatable, 'url' => "keyboard/create"]);
    }

    public function getTable()
    {
        $query = DB::table('keyboards')
            ->select('keyboards.id', 'keyboards.name');
        return Datatable::query($query)
            ->showColumns('id')
            ->addColumn('En Title',function($query){
                return $query->description;
            })
            ->addColumn('Fa Title',function($query){
                $imagePath = config('ui.uploadPath'). "/$query->image";
                return "<img src='$imagePath' width='105'>";
            })
            ->addColumn('actions',function($query){
                $token = csrf_field();
                $buttons  = "<a href='keyboard/$query->id/edit' class='btn btn-success'>Edit</a>";
                $buttons .=
                    "<form method='post' style=\"display: inline;\"action=\"keyboard/$query->id\">
                     $token
                    <input name=\"_method\" type=\"hidden\" value=\"DELETE\">".
                    '<input type="submit" value="Delete" class="btn btn-danger" onclick="var r = confirm(\'آیا از حذف مطمئن هستید؟\'); if(r == false){return false;}">';
                $buttons .=   "</form>";
                return $buttons;
            })
            ->searchColumns(['title'])
            ->orderColumns('id','description')
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = new KeyboardForm();
        $commands  = json_encode(Command::all());
        $options = [];
        $keyboard = Keyboard::where('command_id',request('cid'))->first();
        return view('keyboard', ['form' =>$form->getForm(null)->render(), 'commands' => $commands,'command_id' =>request('cid'),'keyboard' =>$keyboard]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $keyboard = Keyboard::where('command_id',$request->get('command_id'))->first();
        if($keyboard != null){
            $this->model = $keyboard;
        }
        $request->offsetSet('data',json_encode($request->get('keyboard')));
        $request->offsetUnset('keyboard');
        $this->model->user_id = auth()->user()->id;
        return parent::store($request);
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
    public function edit($id,$model=null)
    {
        return parent::edit($id,$model);
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
        return parent::update($request, $id);
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

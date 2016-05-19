<?php

namespace App\Domain\Content\Controller\Resource;

use App\Backend\Core\Base\Controller\BaseResourceController;
use App\Domain\Content\Model\Command;
use App\Domain\Content\Form\Command as CommandForm;

use App\Http\Requests;

use Chumper\Datatable\Facades\DatatableFacade as Datatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Module\UI\Element\Button;
use Module\UI\Element\File;
use Module\UI\Element\FileCustom;
use Module\UI\Element\Hidden;
use Module\UI\Element\Textarea;

class TelegramController extends BaseResourceController
{
    public function __construct(Command $telegram, CommandForm $form){
        $this->model = $telegram;
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
            ->addColumn('id', 'Command Name')
            ->addColumn('Actions')
            ->setUrl(route('content.telegram.table'))
            ->render();
        return view('list')->with(['table' => $datatable, 'url' => "telegram/create"]);
    }

    public function getTable()
    {
        $query = DB::table('commands')
            ->select('commands.id', 'commands.name')
            ->where('commands.user_id', auth()->user()->id);
        return Datatable::query($query)
            ->showColumns('id')
            ->addColumn('Command Name',function($query){
                return $query->name;
            })
            ->addColumn('Actions',function($query){
                $token = csrf_field();
                $buttons  = "<a href='telegram/$query->id/edit' class='btn btn-success'>Edit</a>";
                $buttons .=
                    "<form method='post' style=\"display: inline;\"action=\"telegram/$query->id\">
                     $token
                    <input name=\"_method\" type=\"hidden\" value=\"DELETE\">".
                    '<input type="submit" value="Delete" class="btn btn-danger" onclick="var r = confirm(\'آیا از حذف مطمئن هستید؟\'); if(r == false){return false;}">';
                $buttons .= "<a href='keyboard/create?cid=$query->id' class='btn btn-success'>Add Keyboard</a>";
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
        $form  =new CommandForm();
        return view('telegram', ['form' =>$form->getForm(null)->render()]);        //return parent::create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [];
        if(isset($request->all()['command'])){
            $data = $request->all()['command'];
        }
        $this->model->name = $request->get('name');
        foreach ($data as $key => $value) {
            if(key($value) != "text"){
                $file = new File([]);
                $file->setValue($value[key($value)]['data']);

                $data[$key][key($value)]['data'] = $file->getValue();
                $data[$key][key($value)]['description'] = $value[key($value)]['description'];
            }
        }
        $this->model->name = $request->get('name');
        $this->model->user_id = auth()->user()->id;
        $this->model->data = json_encode($data);
        $this->model->save();
        return redirect()->back();
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
        $formIn  =new CommandForm();
        $command = Command::find($id);
        $form = $formIn->getForm($command);

        $commandData = json_decode($command->data,true);
//                var_dump($commandData);die;

        foreach($commandData as $key => $value){
            $form->removeChild('submit');
            if(key($value) == 'text'){
                    $form->addChild(new Textarea([
                    'name' => "command[$key][text]",
                    'value' => $value[key($value)],
                        'label' => 'Text',
                        'placeholder' => '',
                        'removeable' => true
                ]));
            }

            else{
                $form->addChild(new FileCustom([
                    'name' => "command[$key][".key($value)."]",
                    'value' => $value[key($value)],
                    'label' => key($value),
                    'removeable' => true
                ]));
            }
            $form->addChild(new Hidden(['name' => 'order', 'value'=> count($commandData)]));
            $form->addChild(new Button(['name' => 'submit', 'value'=> 'Submit']));
        }
        return view('telegram', ['form' =>$form->render()]);
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
        $this->model = Command::find($id);
        $data = $request->all()['command'];
        $this->model->name = $request->get('name');
        foreach ($data as $key => $value) {
            if(key($value) != "text"){
                $file = new File([]);
                $file->setValue($value[key($value)]['data']);

                $data[$key][key($value)]['data'] = $file->getValue();
                $data[$key][key($value)]['description'] = $value[key($value)]['description'];
            }
        }
        $this->model->name = $request->get('name');
        $this->model->user_id = auth()->user()->id;
        $this->model->data = json_encode($data);
        $this->model->save();
        return redirect()->back();
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

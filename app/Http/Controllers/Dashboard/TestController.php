<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\TestRequest;
use App\Http\Requests\Dashboard\CSVRequest;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = Test::orderBy('id', 'DESC')->paginate(25);
        return view('dashboard.test.index',compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.test.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestRequest $request)
    {
        $data = $request->all();
        if($request->hasFile('image'))
        {
            $data['image'] = upload_image($request->file('image'), 'image');
        }
        Test::create($data);
        return redirect()->route('tests.index')
        ->with(['success' => trans('admin.added')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = Test::find($id);
        return view('dashboard.test.show',compact('test'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $test = Test::find($id);
        if (!$test)
        return redirect()->route('countries.index')
        ->with(['error' => trans('admin.coun_not_found')]);
        return view('dashboard.test.edit', compact('test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestRequest $request, $id)
    {
        $test = Test::find($id);
        $data = $request->all();
        if($request->hasFile('image'))
        {
            $data['image'] = upload_image($request->file('image'), 'image');
        }
        else
        {
            $data['image'] = $test->image;
        }
        $test->fill($data)->save();
        return redirect()->route('tests.index')
        ->with(['success' => trans('admin.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            //get specific categories and its translations
            $test = Test::find($id);

            if (!$test)
                return redirect()->route('tests.index')
                ->with(['error' => trans('admin.coun_not_found')]);

            $test->delete();

            return redirect()->route('tests.index')
            ->with(['success' => trans('admin.detelted_sucess')]);

        } catch (\Exception $ex) {
            return redirect()->route('tests.index')
            ->with(['error' => trans('admin.try_again')]);
        }
    }

    public function upload_csv(){
        return view('dashboard.test.csv');
    }

    public function save_csv(CSVRequest $request){
        $url = upload_image($request->file('csv_file'), 'csv_file');
        $this->store_in_db( url($url));

    }
    function store_in_db($filename = '', $delimiter = ';')
    {
        header("Content-Type: text/html; charset=utf-8");
    
        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
    
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                 $data[] = $row;
            }
            fclose($handle);
        }
        dd($data);
        array_shift($data);
       foreach($data as $da ){
           $product = new Product();
           $product->description = $this->stripAccents($da[0]) ;
           if($product->description[0] == 'b'){
              $product->Pièce ="boîte" ;
           }elseif($product->description[0] == 'm'){
              $product->Pièce ="moteur" ;
           }
          $product->Marque = $this->stripAccents($da[1]);
          $product->Modèle = $this->stripAccents($da[2]);
          $product->Energie = $this->stripAccents($da[3]);
          $product->MiseEnCirculation = $this->stripAccents($da[4]);
          $product->CodeMoteur = $this->stripAccents($da[5]);
          $product->TypeMine = $this->stripAccents($da[6]);
          $product->Finition = $this->stripAccents($da[7]);
          $product->status = "normal";
          $product->save();
       }
        return count($data);
    }
    

}

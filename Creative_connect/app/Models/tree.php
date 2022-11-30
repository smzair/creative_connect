<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class tree extends Model
{
    use HasFactory;

    protected $fillable=[
        'entry_id',
        'parent_entry_id'
    ];

    protected $table = 'tree_entry';


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }


////-- joining both the table with inner join---/////

    public static function getTreeInfo($filter = []){
        $wheerArr = [];
        if(isset($filter['parent_entry_id'])){
            $wheerArr[] = ['tree_entry.parent_entry_id', '=' , $filter['parent_entry_id']];
        }  
        $result = DB::table('tree_entry')
        ->join('tree_entry_lang','tree_entry_lang.entry_id','=','tree_entry.entry_id')
        ->select('tree_entry_lang.entry_id', 'tree_entry_lang.lang', 'tree_entry_lang.name', 'tree_entry.parent_entry_id')
        ->where($wheerArr)
        ->orderBy('tree_entry_lang.name', 'asc')
        ->orderBy('tree_entry_lang.entry_id', 'asc');

        return $result->get();
    }

///--- identifying the parent & all other node --------/////

    public static function getTree(){

        $allTree = tree::getTreeInfo();

        $rootTrees = $allTree->where('parent_entry_id','=','0');

        self::allTree($rootTrees,$allTree);

        return $rootTrees;
    }



///--- implementing self recuirsive functionally by passing the above all tree object and parent node --------/////


    private static function allTree($rootTrees,$allTree){

     foreach($rootTrees as $rootTree){
        $rootTree->children= $allTree->where('parent_entry_id',$rootTree->entry_id)->values();

        if($rootTree->children->isNotEmpty()){

            self::allTree($rootTree->children,$allTree);
        
        }
    }

}









}

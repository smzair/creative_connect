<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tree;

class TestController extends Controller
{


public function assignmentajax(){
$tree = tree::getTree();

    return view('extra.assignmentajax',compact('tree'));

}


public function getList(Request $request){
    $parent_entry_id = $request->parent_id;

$tree = tree::getTreeInfo(['parent_entry_id'=>$parent_entry_id]);

$html = view('extra.list',compact('tree'));

return $html;

}



public function getChildList(Request $request){
    $parent_entry_id = $request->parent_id;

$child = tree::getTreeInfo(['parent_entry_id'=>$parent_entry_id]);

$html = view('extra.ChildList',compact('child'));

return $html;

}



public function getSubList(Request $request){

$parent_entry_id = $request->parent_id;

$subchild = tree::getTreeInfo(['parent_entry_id'=>$parent_entry_id]);

$html = view('extra.subchild',compact('subchild'));

return $html;

}

public function assignment(){
$tree = tree::getTree();


// pr($tree,1);
    return view('extra.assignment',compact('tree'));

}

}




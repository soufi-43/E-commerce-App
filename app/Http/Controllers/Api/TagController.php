<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TagResource;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index(){
        return TagResource::collection(Tag::paginate(5));
    }
    public function show($id){
        return new TagResource(Tag::find($id));
    }
}

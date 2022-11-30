    
@extends('layouts.admin')
@section('title')
Assignment
@endsection
@section('content')

<style>
    /* List Accordian Style */

    .menu-accor-list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: block;
        color: #fff;
    }

    .drop-menu-accor-list {
        display: none;
    }

    .menu-accor-list > li {
        display: block;
        width: 100%;
    }

    .menu-accor-list li:not(:last-child) {
        margin-bottom: 10px;
    }

    .menu-accor-list > li.has-accor-item .menu-accor-text {
        position: relative;
        cursor: pointer;
    }

    .menu-accor-list li.has-accor-item > .menu-accor-text {
        padding-left: 15px;
    }

    .menu-accor-list > li .menu-accor-text {
        display: inline-block;
    }

    .menu-accor-list ul {
        list-style: none;
        padding-left: 30px;
        margin: 0;
        padding-top: 10px;
    }

    .menu-accor-list li.has-accor-item > .menu-accor-text:before {
        position: absolute;
        left: 0;
        width: 10px;
        height: 2px;
        background-color: #fff;
        content: "";
        top: 9px;
        transform: rotate(90deg);
        line-height: 1;
    }

    .menu-accor-list li.has-accor-item > .menu-accor-text:after {
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 10px;
        height: 2px;
        background-color: #fff;
        content: "";
    }

    .menu-accor-list li.has-accor-item > .menu-accor-text.accor-child-open::before {
        display: none;
    }

    /* End of List Accordian Style */
</style>


<!-- List Accordian HTMl  -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card card-transparent">
                <div class="card-header">
                    <h3 class="card-title">List</h3>
                    <a href="{{route('extra.assignmentajax')}}" class="btn btn-warning float-right" id="acBTN">Change to ajax based data fetch</a>
                </div>
                <div class="card-body">
                    <div class="child-acco-dropdown">
                        <ul class="menu-accor-list">
                            <li class="menu-accor-item has-accor-item">
                                <span class="menu-accor-text">Test Project</span>
                                <ul class="drop-menu-accor-list"> @foreach($tree as $trees)
                                    <li class="menu-accor-item has-accor-item">
                                        <span class="menu-accor-text">{{$trees->name}} |id {{$trees->entry_id}} |parent_id {{$trees->parent_entry_id}}</span>
                                        <ul class="drop-menu-accor-list">

                                           @foreach($trees->children as $child)
                                    <li class="menu-accor-item has-accor-item">
                                                <span class="menu-accor-text">{{$child->name}}|id {{$child->entry_id}} |parent_id {{$child->parent_entry_id}}</span>

                                                <ul class="drop-menu-accor-list">
                                                     @foreach($child->children as $subchild)
                                                    <li class="menu-accor-item has-accor-item">
                                                        <span class="menu-accor-text">{{$subchild->name}}|id {{$subchild->entry_id}} |parent_id {{$subchild->parent_entry_id}}</span>
                                                       
 
                         @if(empty($subchild->children))
<span class="text-danger" >No child found</span>
@endif

                                                        <ul class="drop-menu-accor-list">
                                                            @foreach($subchild->children as $subschild)
                                                            <li class="menu-accor-item"><span class="menu-accor-text">{{$subschild->name}} |id {{$subschild->entry_id}} |parent_id {{$subschild->parent_entry_id}}</span>


                         @if($subschild->children == Null)
<span class="text-danger" >No child found</span>
@endif
                                                            </li>@endforeach
                                                            
                                                        </ul>
                                                    </li>@endforeach
                                                </ul>
                                            </li>@endforeach
                                        
                                        </ul>
                                    </li>@endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of List Accordian HTML  -->

<script type="application/javascript" src="plugins/jquery/jquery.min.js"></script>
<script type="application/javascript" src="plugins/jquery-ui/jquery-ui.min.js"></script>

<script>
    // List Accordian JS 

    $(document).on('click', '.menu-accor-text', function () {
        $(this).parent().siblings(".has-accor-item").find(".drop-menu-accor-list").slideUp(250);
        $(this).next(".drop-menu-accor-list").slideToggle(250);
        $(this).next(".drop-menu-accor-list").children(".has-accor-item").find(".drop-menu-accor-list").slideUp(250);
        $(this).toggleClass("accor-child-open");
        $(this).parent('.menu-accor-item').siblings().find('.menu-accor-text').removeClass("accor-child-open");
        $(this).next('.drop-menu-accor-list').children('.has-accor-item').find('.menu-accor-text').removeClass("accor-child-open");
    });

    // End of List Accordian JS
</script>

<!---- for changing the view the view --->



<!-- You must need to include Jquery and Bootstrap  -->
@endsection
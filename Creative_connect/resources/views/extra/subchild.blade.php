   @foreach($subchild as $subschild)
            <li class="menu-accor-item">
            <span class="menu-accor-text">{{$subschild->name}} |id {{$subschild->entry_id}} |parent_id {{$subschild->parent_entry_id}}</span></li>
                                                            @endforeach
                                                            
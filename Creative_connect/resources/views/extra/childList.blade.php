 @foreach($child as $subchild)
        <li class="menu-accor-item has-accor-item">
            <span class="menu-accor-text" data-parent_id="{{$subchild->entry_id}}" onclick="getSubList(this)">{{$subchild->name}}|id {{$subchild->entry_id}} | parent_id {{$subchild->parent_entry_id}}</span>
                        
   <ul class="drop-menu-accor-list" id="subchild_{{$subchild->entry_id}}">
                                </ul>
                                                    </li>
                                                    @endforeach

<script type="text/javascript">

 function getSubList(obj) {

        var parent_id = $(obj).data('parent_id');
        $.ajax({
            url: "/get-sub-list",
            method: 'GET',
            dataType: "html",
            data: {parent_id: parent_id},
            success: function (htmlData) {
                $('#subchild_'+ parent_id).html(htmlData);
            }
        });
    }

    </script>
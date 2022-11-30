                                           @foreach($tree as $child)
                                    <li class="menu-accor-item has-accor-item">
                                    <span class="menu-accor-text" data-parent_id="{{$child->entry_id}}" onclick="getChildList(this)">{{$child->name}}|id {{$child->entry_id}} |parent_id {{$child->parent_entry_id}}</span>

                                                <ul class="drop-menu-accor-list" id="infochild_{{$child->entry_id}}">
                                                    
                                                </ul>
                                            </li>@endforeach
                                        

<script type="text/javascript">
    

 function getChildList(obj) {

        var parent_id = $(obj).data('parent_id');
        $.ajax({
            url: "/get-child-list",
            method: 'GET',
            dataType: "html",
            data: {parent_id: parent_id},
            success: function (htmlData) {
                $('#infochild_'+ parent_id).html(htmlData);
            }
        });
    }
</script>
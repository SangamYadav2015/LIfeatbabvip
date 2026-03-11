@extends('admin.layout.app')
<style>
    #sortable {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    #sortable>li {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        margin-bottom: 5px;
        padding: 10px;
        cursor: move;
    }

    .handle {
        cursor: move;
        display: inline-block;
        width: 100%;
        line-height: 20px;
    }

    #sortable ul {
        list-style-type: none;
        padding: 0;
        margin: 5px 0 0 20px;
    }

    #sortable ul li {
        background-color: #f5f5f5;
        border: 1px solid #ddd;
        margin-bottom: 3px;
        padding: 8px;
        cursor: move;
    }
</style>
@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">{{ Auth::user()->name }} Welcome ! To {{ Auth::user()->designation }} Dashboard</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Menu Sorting List</a></li>
                        <li class="breadcrumb-item active">Welcome </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Menu Sorting List</h4>

                </div>
                <div class="card-body">
                    <ul id="sortable" class="sortable-list">
                        @foreach($menuList as $menu)
                        @php
                        displayMenuSorting($menu);
                        @endphp
                        @endforeach
                    </ul>

                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
</div>
<!-- container-fluid -->
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {
        $(".sortable-list").sortable({
            connectWith: ".sortable-list",
            handle: ".handle",
            update: function(event, ui) {
                console.log("Sortable updated");
                saveMenuSortingOrder();
            }
        }).disableSelection();
    });

    function saveMenuSortingOrder() {
        var itemIds = [];

        function collectItemIds($list, parentId) {
            var items = [];

            $list.children("li").each(function() {
                var itemId = $(this).data("item-id");
                var subitems = [];
                var $nestedSortable = $(this).children(".nested-sortable");
                if ($nestedSortable.length > 0) {
                    subitems = collectItemIds($nestedSortable, itemId);
                }

                items.push({
                    id: itemId,
                    parent_id: parentId,
                    children: subitems
                });
            });

            return items;
        }

        itemIds = collectItemIds($("#sortable"), null);

        console.log("Sending data to server:", itemIds);  // Log the data being sent

        $.ajax({
            url: "{{ route('admin.updateSortMenu')}}",
            method: 'POST',
            data: {
                items: itemIds
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                location.reload();
                console.log("Updated successfully.");
            },
            error: function(xhr, status, error) {
                console.error("Failed to update: " + error);
            }
        });
    }
</script>

@endsection
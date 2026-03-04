@extends('layouts.app')
@section('content')
<?php
function enToBnDate($datetime){
    $en = ['0','1','2','3','4','5','6','7','8','9','AM','PM','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯','এএম','পিএম','জানুয়ারি','ফেব্রুয়ারি','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর'];
    return str_replace($en, $bn, $datetime);
}
?>
<div class="col-lg-12">
    
    <div class="main-card mb-3 card">
        @include('admin/card_head',[
            'title'=>'News rundown',
            'info'=>'Manage rundown from this page, image size should be 900x600px',
            'links'=>[
                0=>['text'=>'Create new','link'=>'/admin/news/create'],
                ]  
            ])
        <div class="card-body">
            <form id="" action="/admin/news/update-seq" method="POST">
            @csrf
                <ul id="sortableList" class="space-y-2">
                    @foreach($contents as $content)

                     <li class="sortable-item flex items-center justify-between p-4 bg-gray-50 rounded-lg shadow
                               hover:bg-blue-50 transition"
                        data-id="{{ $content->id }}">
                        
                        <div class="flex items-center gap-3">
                            <input type="hidden" name="items[{{ $loop->iteration }}][id]" value="{{ $content->id }}">
                            <a class="py-2 px-3 text-red-600 border rounded-full" href="/admin/news/rundown_remove/{{ $content->id }}">x</a>
                            <input class="w-20 seq-label bg-gray-300 text-gray-700 px-3 py-1 rounded-full" type="" name="items[{{ $loop->iteration }}][seq]" value="{{ $content->seq }}">
                            <span class="font-medium text-gray-700">📄 {{ $content->name }}</span>
                            
                        </div>
                        

                    </li>
                    @endforeach
                    <!-- Item 1 -->
                </ul>
                <button type="submit"
                        class="mt-6 py-3 border px-4 rounded-xl font-semibold transition">
                    💾 Save Rundown
                </button>

            </form>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">


    <script>
        $(function () {
    $("#sortableList").sortable({
        placeholder: "ui-sortable-placeholder",

        update: function () {

            // Loop through all LI items
            $("#sortableList .sortable-item").each(function (index) {

                // Get content ID
                let id = $(this).data('id');

                // Update hidden ID input name
                $(this).find('input[name*="[id]"]').attr("name", `items[${index}][id]`).val(id);

                // Update hidden SEQ input name + value
                $(this).find('input[name*="[seq]"]').attr("name", `items[${index}][seq]`).val(index + 1);

                // Update badge UI
                $(this).find(".seq-label").text(index + 1);
            });
        }
    });
});

   

    </script>
    <style>
        .ui-sortable-placeholder {
            background: #bfdbfe !important; /* Tailwind blue-200 */
            visibility: visible !important;
            height: 3.5rem !important;
            border-radius: 0.5rem;
        }
        .sortable-item { cursor: grab; }
        .sortable-item:active { cursor: grabbing; }
    </style>
    
@endsection
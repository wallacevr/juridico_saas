@if(!empty($categoryChild->children[0]))
@foreach($categoryChild->children as $subCategoryChild)
<li id="{{'category-'. $subCategoryChild->id }}" data-id="{{ $subCategoryChild->id }}"
    data-name="{{ $subCategoryChild->title }}" data-url="{{ $subCategoryChild->url }}">

    <span class="subcategory-title">{{ $subCategoryChild->title }}</span>

    <div class="float-right">
        @include('tenant.categories.subcategory-edit-buttons')
    </div>

    <ol>
        @include('tenant.categories.subcategory-child', [ 'categoryChild' => $subCategoryChild])
    </ol>
</li>
@endforeach
@endif
